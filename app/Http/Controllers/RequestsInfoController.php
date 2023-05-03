<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RequestsInfoController extends Controller
{

    public function getRequestsInfos(){
        if(request('id') != null){
           $allRequests = RequestsInfo::withTrashed()->where('id', 'like', '%'.request('id').'%')->get();
        }else if(request('type') == null || request('type') == 'All'){
            $allRequests = RequestsInfo::withTrashed()->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        }else{
            $allRequests = RequestsInfo::withTrashed()->where('type', 'like',  '%'.request('type').'%')->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        }

        $responses = [];
        $ongoing = [];
        $completed = [];
        $cancelled = [];
        
        for($i=0;$i<count($allRequests);$i++){
            $singleRequest = RequestsInfo::withTrashed()->where('id', $allRequests[$i]['id'])->first();
            $userDetails = User::withTrashed()->where('id', $singleRequest->userId)->first();
            $requestResponse = Response::withTrashed()->where('requestId', $allRequests[$i]['id'])->first();

            $requestDate = date("Y-m-d H:i:s",strtotime($userDetails->created_at));
            if(!empty($requestResponse)){
                $responder = Responder::where('id', $requestResponse->responderId)->first();
                $responderUserDetails = User::where('id', $responder->userId)->first();
                
                array_push($responses, [
                    'requestID' => $singleRequest->id,
                    'responderID' => $responder->id,
                    'requesterUserID' => $userDetails->id,
                    'responderUserID' => $responder->userId,
                    'requesterfname' => $userDetails->fname,
                    'requesterlname' => $userDetails->lname,
                    'responderfname' =>  $responderUserDetails->fname,
                    'responderlname' => $responderUserDetails->lname,
                    'location' => $singleRequest->location,
                    'requestType' => $singleRequest->type,
                    'requestStatus' => $singleRequest->status,
                    'created_at' => $requestDate,
                ]);
                
                if($singleRequest->status !== 'Completed' && $singleRequest->status !== 'Cancelled'){
                    array_push($ongoing, [
                        'requestID' => $singleRequest->id,
                        'responderID' => $responder->id,
                        'requesterUserID' => $userDetails->id,
                        'responderUserID' => $responder->userId,
                        'requesterfname' => $userDetails->fname,
                        'requesterlname' => $userDetails->lname,
                        'responderfname' =>  $responderUserDetails->fname,
                        'responderlname' => $responderUserDetails->lname,
                    'location' => $singleRequest->location,
                    'requestType' => $singleRequest->type,
                    'requestStatus' => $singleRequest->status,
                    'created_at' => $requestDate,
                    ]);

                }
                else if($singleRequest->status === 'Completed'){
                    array_push($completed, [
                        'requestID' => $singleRequest->id,
                        'responderID' => $responder->id,
                        'requesterUserID' => $userDetails->id,
                        'responderUserID' => $responder->userId,
                        'requesterfname' => $userDetails->fname,
                        'requesterlname' => $userDetails->lname,
                        'responderfname' =>  $responderUserDetails->fname,
                        'responderlname' => $responderUserDetails->lname,
                        'location' => $singleRequest->location,
                        'requestType' => $singleRequest->type,
                        'requestStatus' => $singleRequest->status,
                        'created_at' => $requestDate,
                        ]);

                }else if($singleRequest->status === 'Cancelled'){
                    array_push($cancelled, [
                        'requestID' => $singleRequest->id,
                        'responderID' => $responder->id,
                        'requesterUserID' => $userDetails->id,
                        'responderUserID' => $responder->userId,
                        'requesterfname' => $userDetails->fname,
                        'requesterlname' => $userDetails->lname,
                        'responderfname' =>  $responderUserDetails->fname,
                        'responderlname' => $responderUserDetails->lname,
                        'location' => $singleRequest->location,
                        'requestType' => $singleRequest->type,
                        'requestStatus' => $singleRequest->status,
                        'created_at' => $requestDate,
                        ]);
                }
                
            }else{
                array_push($responses, [
                    'requestID' => $singleRequest->id,
                    'responderID' => 'N/A',
                    'requesterUserID' => $userDetails->id,
                    'responderUserID' => 'N/A',
                    'requesterfname' => $userDetails->fname,
                    'requesterlname' => $userDetails->lname,
                    'responderfname' =>  'Not',
                    'responderlname' => 'Assigned',
                    'location' => $singleRequest->location,
                    'requestType' => $singleRequest->type,
                    'requestStatus' => $singleRequest->status,
                    'created_at' => $requestDate,
                    
                ]);
                if($singleRequest->status !== 'Completed' && $singleRequest->status !== 'Cancelled'){
                    array_push($ongoing, [
                        'requestID' => $singleRequest->id,
                        'responderID' => 'N/A',
                        'requesterUserID' => $userDetails->id,
                        'responderUserID' => 'N/A',
                        'requesterfname' => $userDetails->fname,
                        'requesterlname' => $userDetails->lname,
                        'responderfname' =>  'Not',
                        'responderlname' => 'Assigned',
                        'location' => $singleRequest->location,
                        'requestType' => $singleRequest->type,
                        'requestStatus' => $singleRequest->status,
                        'created_at' => $requestDate,
                    ]);
                }
                else if($singleRequest->status === 'Completed'){
                    array_push($completed, [
                        'requestID' => $singleRequest->id,
                        'responderID' => 'N/A',
                        'requesterUserID' => $userDetails->id,
                        'responderUserID' => 'N/A',
                        'requesterfname' => $userDetails->fname,
                        'requesterlname' => $userDetails->lname,
                        'responderfname' =>  'Not',
                        'responderlname' => 'Assigned',
                        'location' => $singleRequest->location,
                        'requestType' => $singleRequest->type,
                        'requestStatus' => $singleRequest->status,
                        'created_at' => $requestDate,
                        ]);

                }else if($singleRequest->status === 'Cancelled'){
                    array_push($cancelled, [
                        'requestID' => $singleRequest->id,
                        'responderID' => 'N/A',
                        'requesterUserID' => $userDetails->id,
                        'responderUserID' => 'N/A',
                        'requesterfname' => $userDetails->fname,
                        'requesterlname' => $userDetails->lname,
                        'responderfname' =>  'Not',
                        'responderlname' => 'Assigned',
                        'location' => $singleRequest->location,
                        'requestType' => $singleRequest->type,
                        'requestStatus' => $singleRequest->status,
                        'created_at' => $requestDate,
                    ]);
                }
            }
        }

        return view('/requests', [
            'responses' => $responses,
            'ongoingRequests' => $ongoing,
            'completedRequests' => $completed,
            'cancelledRequests' => $cancelled,
            'ongoingCount' => count($ongoing),
            'completedCount' => count($completed),
            'cancelledCount' => count($cancelled),
            'requestsCount' => count($responses),
        ]);
    }

    public function getSingleRequestInfo($id){
        $singleRequest = RequestsInfo::withTrashed()->where('id', $id)->first();
        $responseExist = Response::withTrashed()->where('requestId', $id)->first();
        
        $requestcreateDate = date("Y-m-d H:i",strtotime($singleRequest->created_at));
        
        if($responseExist == null){
            $user = User::withTrashed()->find($singleRequest->userId);
            $user_created_at = date("Y-m-d H:i",strtotime($user->created_at));
            return response([
                'message' => 'No responder assigned.',
                'request' => $singleRequest,
                'request_created_at' => $requestcreateDate,
                'response' => $responseExist,
                'responder' => null,
                'responderUserDetails' => null,
                'user' => $user,
                'user_created_at' => $user_created_at
            ], 200);
        }else{
            $responder = Responder::withTrashed('id', $responseExist->responderId)->first();
            $responderUserDetails = User::withTrashed()->find($responder->userId);
            $user = User::withTrashed()->find($singleRequest->userId);
            $user_created_at = date("Y-m-d H:i",strtotime($user->created_at));

            return response([
                'message' => 'Found request response',
                'request' => $singleRequest,
                'request_created_at' => $requestcreateDate,
                'response' => $responseExist,
                'responder' => $responder,
                'responderUserDetails' => $responderUserDetails,
                'user' => $user,
                'user_created_at' => $user_created_at
            ], 200);
        }
    }

    public function getRequestInfoWithResponses($id){
        $request = RequestsInfo::withTrashed()->where('id', $id)->first();
        $requestCreateDateTime = date("Y-m-d H:i",strtotime($request->created_at));
        
        $responses = Response::withTrashed()->where('requestId', $id)->get();
        
        $responseList = [];
        foreach ($responses as $response) {
            $responder = Responder::withTrashed()->find($response->responderId);
            $responderUserDetails = User::withTrashed()->find($responder->userId);
            $responseCreateDateTime = date("Y-m-d H:i",strtotime($response->created_at));
            $responseList[] = [
                'responseId' => $response->id,
                'responder' => $responder,
                'responderUserDetails' => $responderUserDetails,
                'response_created_at' => $responseCreateDateTime

            ];
        }
        
        return response([
            'message' => 'Found request responses',
            'request' => $request,
            'request_created_at' => $requestCreateDateTime,
            'responses' => $responseList,
    
        ], 200);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RequestsInfo::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllRequests()
    {
        return response([
            'requests' => RequestsInfo::withTrashed()->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAvailable()
    {
        return RequestsInfo::where('status', 'like', '%'.'Searching'.'%')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(RequestsInfo::where('userId', $request['userId'])->get()->isNotEmpty()){
            return response([
                'message' => 'A user already has an ongoing request.',
            ], 205);
        }
        $fields = $request->validate([
            'userId' => ['required'],
            'type' => ['required'],
            'location' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'status' => ['required'],
        ]);
        $fields['status'] = 'Searching Responder';
        $user = User::where('id', $request['userId'])->first();
        (int)$fields['userId'] = $user->id;
        
        if($user->role == 'User' || $user->role == 'user'){
            $requestInfo = RequestsInfo::create($fields);
        
            return response([
                'message'=> 'Request Created',
                'request' => $requestInfo], 201);
        }else{
            return response([
                'message'=> 'Only user accounts may create requests'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestsInfo  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $req = RequestsInfo::find($id);

        if(!$req){
            return response([
                'message' => 'Not Found'
            ], 404);
        }else{
            return response([
                'message' => 'Found',
                'requestInfo' => $req
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $req = RequestsInfo::find($id);
        $bool = $req->update($request->all());

        if(!$req){
            return response([
                'message' => 'Not Found',
                'requestInfo' => $bool,
            ], 404);
        }else{
            return response([
                'message' => 'Request Updated!',
                'requestInfo' => $req
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
            $responseExist = Response::where('requestId', $id)->first();
            $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Cancelled']);
            if($requestUpdated){
                if(RequestsInfo::where('id', $id)->delete()){
                    if($responseExist){
                        $responseExist->delete();
                    }
                    $message = "Request is cancelled and is moved to archives.";
                }
            }else{
            $message = "Something went wrong. Cannot update.";
        }

        return response([
            'message' => $message
        ], 200);
        
    }

    /**
     * Filter the specified resource from storage.
     * @param  str  $type
     * @return \Illuminate\Http\Response
     */
    public function searchType($type)
    {
        return RequestsInfo::where('type', 'like', '%'.$type.'%')->get();
    }

     /**
     * Search the specified status resource from storage.
     * @param  str  $status
     * @return \Illuminate\Http\Response
     */
    public function searchStatus($status)
    {
        return RequestsInfo::where('status', 'like', '%'.$status.'%')->get();
    }

    /**
     * Search the specified status resource from storage.
     * @param  str  $location
     * @return \Illuminate\Http\Response
     */
    public function searchLocation($location)
    {
       
        return RequestsInfo::withTrashed()->where('location', 'like', '%'.$location.'%')->get();
        
    }

}
