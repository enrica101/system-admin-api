<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UserController;

class ResponseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = Response::all();
        return $responses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    //has to pass requestId and responderId
    public function store(Request $request)
    {

        // if(Response::where('requestId', $request['requestId'])->first()){
        //     return response([
        //         'message' => 'Request is already assigned to a first responder.',
        //     ], 205);

        // }else 
        if(Response::where('responderId', $request['responderId'])->first()){
            return response([
                'message' => 'Responder is already assigned to a request.',
            ], 205);
        }
        
        $requestInfo = RequestsInfo::find($request['requestId']);
        $responder = Responder::find($request['responderId']);
        
        if(empty($requestInfo) || empty($responder)){
            return response([
                'message' => 'Request or Responder does not exist.',
            ], 205);
        }

        $user = User::find($requestInfo->userId);

        if($requestInfo->type === $responder->type){
            $fields = $request->validate([
                'requestId' => 'required',
                'responderId' => 'required',
                'location' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'status' => 'required',
            ]);
            $fields['status'] = 'Received Request';
            $responseInfo = Response::create($fields);
            RequestsInfo::where('id', $request->requestId)->update(['status' => 'Responder Found']);

            return response([
                'message' => 'Response for Request Created!',
                'response' => $responseInfo,
                'responder' => $responder,
                'requestInfo' => $requestInfo,
            ], 201);
        }else{
            return response([
                'message' => 'Request and Responder should be of the same type.',
            ], 205);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
        public function show($id)
    {
        $responseInfo = Response::where('requestId',$id)->first();
        if($responseInfo === null){
            return response([
                'message' => 'Not Found'
            ], 204);
        }else{
            $requestInfo = RequestsInfo::find($responseInfo->requestId);
            $responder = Responder::find($responseInfo->responderId);
            $userResponderDetails = User::find($responder->userId);

            return response([
                'message' => 'Found',
                'response' => $responseInfo,
                'requestInfo' => $requestInfo,
                'escalation' => $responseInfo->escalation,
                'responder' => [
                    'type' => $responder->type,
                    'responderFname' => $userResponderDetails->fname,
                    'responderLname' => $userResponderDetails->lname,
                ]
            ], 200);
        }
    }
// ID passed must be of Request ID.
    public function escalateResponse(Request $request){
        $responses = Response::where('requestId',$request->id)->get()->count();
        if($responses == 1){
            $message = 'First Alert';
        }else if($responses == 2){
            $message = 'Second Alert';
        }else{
            $message = 'Third Alert';
        }

        return response(
            [
                'response' => $message
            ], 200
        );
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {   
        //should receive a requestId to serach through responses table 
        if(RequestsInfo::find($id)){
        $trigger = $request->trigger;
        switch($trigger){
            case '1':
                $responseUpdated = Response::where('requestId', $id)->update(['status' => "Searching Responder..."]);
                if($responseUpdated){

                    $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Searching Responder...']);
                    //check first if request type is Fire
                    $requestHandle = RequestsInfo::find($id);
                    
                    if($requestUpdated){
                        $message = "Succesfully updated request and response statuses.";
                    }
                }else{
                    $message = "Something went wrong. Cannot update.";
                }
                break;
            case '3':
                $responseUpdated = Response::where('requestId', $id)->update(['status' => "You're on the way!"]);
                if($responseUpdated){
                    $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Responder is on the way!']);
                    if($requestUpdated){
                        $message = "Succesfully updated request and response statuses.";
                    }
                }else{
                    $message = "Something went wrong. Cannot update.";
                }
                
                break;
            case '4':
                $responseUpdated = Response::where('requestId', $id)->update(['status' => "You're almost there"]);
                if($responseUpdated){
                    $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Responder is almost there.']);
                    if($requestUpdated){
                        $message = "Succesfully updated request and response statuses.";
                    }
                }else{
                    $message = "Something went wrong. Cannot update.";
                }
                break;
            case '5':
                $responseUpdated = Response::where('requestId', $id)->update(['status' => "You've arrived!"]);
                if($responseUpdated){
                    $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Responder has arrived!']);
                    if($requestUpdated){
                        $message = "Succesfully updated request and response statuses.";
                    }
                }else{
                    $message = "Something went wrong. Cannot update.";
                }
                break;
            case '6':
                $responseUpdated = Response::where('requestId', $id)->update(['status' => "Completed"]);
                if($responseUpdated){
                    $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Completed']);
                    if($requestUpdated){
                        if(RequestsInfo::where('id', $id)->delete()){
                            Response::where('requestId', $id)->delete();
                            $message = "Request is completed and is moved to archives.";
                        }
                    }
                }else{
                    $message = "Something went wrong. Cannot update.";
                }
                break;
            case '7':
                $responseUpdated = Response::where('requestId', $id)->update(['status' => "Bogus"]);
                if($responseUpdated){
                    $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => "Bogus"]);
                    $requestinfo = RequestsInfo::where('id', $id)->first();
                    
                    if($requestUpdated){
                        if(RequestsInfo::where('id', $id)->delete()){
                            Response::where('requestId', $id)->delete();
                            $user = User::where('id', $requestinfo->userId)->first();
                            $to_name = $user->fname;
                            $to_email = $user->email;
                            $data = array('name'=>$to_name, "id"=> $user->id);
                            Mail::send('emails.restorationEmail', $data, function($message) use ($to_email, $to_name){
                                $message->to($to_email, $to_name)->subject('Your account is temporarily banned.');
                                $message->from('91watch@uylcph.org', '91Watch Support Team');
                            });
                            $user->delete();
                            $message = "Request is set to bogus and is moved to archives.";
                        }
                    }
                }else{
                    $message = "Something went wrong. Cannot update.";
                }
                break;
            case '0':
                $responseUpdated = Response::where('requestId', $id)->update(['status' => "Cancelled"]);
                if($responseUpdated){
                    $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Cancelled']);
                    if($requestUpdated){
                        if(RequestsInfo::where('id', $id)->delete()){
                            Response::where('requestId', $id)->delete();
                            $message = "Request is cancelled and is moved to archives.";
                        }
                    }
                }else{
                    $message = "Something went wrong. Cannot update.";
                }
                break;
            default:
            $message = "Something went wrong. Invalid trigger input";
         
            }
            $responseInfo = Response::where('requestId', $id)->first();
            $requestInfo = RequestsInfo::find($id);
            return response([
                'message' => $message,
                'response' => $responseInfo,
                'requestInfo' => $requestInfo
            ], 200);
        }else{
            return response([
                'message' => 'Not Found',
            ], 204);
        }
    }

       /**
     * Update the specified location resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Request
     */
   public function updateLocation(Request $request, $id)
    {
        if($req=RequestsInfo::find($id)){
            $fields = $request->validate([
                'location' => ['required'],
                'lat' => ['required'],
                'lng' => ['required']
            ]);
    
            if(Response::where('requestId', $req->id)->update($fields)){
                $response = Response::where('requestId', $req->id)->first();
                return response([
                    'message' => 'Update Succesful',
                    'response' => $response,
                    'request' => $req
                ], 200);
            }else{
                return response([
                    'message' => 'Unable to update.',
                ], 400);
            }
        }else{
            return response([
                'message' => 'Not Found',
            ], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response, $id){

        $responseInfo = Response::where('responderId', $id)->delete();
        if($responseInfo){
            return response([
                'message' => 'Response deleted.'
            ], 200);
        }else{
            return response([
                'message' => 'Something went wrong. Cannot delete unknown'
            ], 400);
        }
    }

    
}
