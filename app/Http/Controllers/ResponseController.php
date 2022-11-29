<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;

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
        $requestInfo = RequestsInfo::find($request['requestId']);
        $responder = Responder::find($request['responderId']);
        $user = User::find($requestInfo->userId);

        if(empty($requestInfo) || empty($responder)){
            return response([
                'message' => 'Request or Responder does not exist.',
            ], 400);
        }

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
            RequestsInfo::where('id', $requestInfo->id)->update(['status' => 'Responder Found']);

            return response([
                'message' => 'Response for Request Created!',
                'response' => $responseInfo,
                'responder' => $responder,
                'requestInfo' => $requestInfo,
            ], 201);
        }else{
            return response([
                'message' => 'Request and Responder should be of the same type.',
            ], 406);
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
        $responseInfo = Response::where('requestId',$id)->get();
        
        if(empty($responseInfo)){
            return response([
                'message' => 'Not Found'
            ], 400);
        }else{
            // dd($responseInfo['requestId']);
            $requestInfo = RequestsInfo::find($responseInfo->requestId);

            return response([
                'message' => 'Found',
                'response' => $responseInfo,
                'requestInfo' => $requestInfo
            ], 200);
        }
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
        $trigger = $request->trigger;
        switch($trigger){
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
                $responseUpdated = Response::where('requestId', $id)->update(['status' => "Completed!"]);
                if($responseUpdated){
                    $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Completed!']);
                    if($requestUpdated){
                        $message = "Succesfully updated request and response statuses.";
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
                        $message = "Succesfully updated request and response statuses.";
                    }
                }else{
                    $message = "Something went wrong. Cannot update.";
                }
                break;
            default:
            $message = "Something went wrong. Invalid trigger input";
         
        }
        $responseInfo = Response::where('requestId', $id)->first();
        $requestInfo = RequestsInfo::find($id)->first();
        return response([
            'message' => $message,
            'response' => $responseInfo,
            'requestInfo' => $requestInfo
        ], 200);
    }

       /**
     * Update the specified location resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Request
     */
    public function updateLocation(Request $request, $id)
    {
        $responseInfo = Response::find($id);

        $fields = $request->validate([
            'location' => ['required'],
            'lat' => ['required'],
            'lng' => ['required']
        ]);

        if($responseInfo->update($fields)){

            $requestInfo = RequestsInfo::find($responseInfo->requestId);

            return response([
                'message' => 'Update Succesful',
                'response' => $responseInfo,
                'request' => $requestInfo
            ], 200);
        }else{
            return response([
                'message' => 'Unable to update.',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response, $id)
    {
        $responseInfo = Response::destroy($id);

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
