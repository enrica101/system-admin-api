<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;

class ResponderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userDetails = User::where('role', 'Responder')->get();
        $responders = Responder::all();
        $userResponders = [];
        $count = 0;
        $max = count($responders);
        if($userDetails){
            foreach($userDetails as $userDetail){
                if($count != $max){
                    array_push($userResponders, [
                    'responder' => $responders[$count],
                    'user' => $userDetail,
                    ]);
                    $count++;
                } 
            }
            $message = 'Found';
        }else{
            $message = 'No record.';
        }
        return response([
            'message' => $message,
            'responders' => $userResponders
        ]);
    }

    public function getRoleResponders(){
        if(request('name')!=null){
            $allResponders = User::where('fname', 'like', '%'.request('name').'%')->where('role', 'Responder')->get('id');
        }else if(request('type') == null || request('type') == 'All'){
            $allResponders = Responder::all('userId');
        }else{
            $allResponders = Responder::where('type', 'like', '%'.request('type').'%')->get('userId');
        }
        
        $usersContainer = [];
        for($j=0;$j<count($allResponders);$j++){
            if($allResponders[$j]['userId']){
            $users = User::where('id', $allResponders[$j]['userId'])->first()->toArray();
            array_push($usersContainer, $users);
        }else if($allResponders[$j]['id']){
            $users = User::where('id', $allResponders[$j]['id'])->first()->toArray();
            array_push($usersContainer, $users);
        }
        }
        
        $responses = [];
        $handlers = [];
        $idlers = [];
        for($i=0; $i<count($usersContainer);$i++){
            $responder = Responder::where('userId', $usersContainer[$i]['id'])->first()->toArray();
            
            $responderHasRequest = Response::where('responderId', $responder['id'])->first();
            if(!empty($responderHasRequest)){
                array_push($responses, [
                    'responderID' => $responder['id'],
                    'userID' => $usersContainer[$i]['id'],
                    'fname' => $usersContainer[$i]['fname'],
                    'lname' => $usersContainer[$i]['lname'],
                    'responderType' => $responder['type'],
                    'requestID' => $responderHasRequest['requestId'],
                    'status' => $responderHasRequest['status'],
                    'created_at' => $responderHasRequest['created_at'],
                ]);
                array_push($handlers, [
                    'responderID' => $responder['id'],
                    'userID' => $usersContainer[$i]['id'],
                    'fname' => $usersContainer[$i]['fname'],
                    'lname' => $usersContainer[$i]['lname'],
                    'responderType' => $responder['type'],
                    'requestID' => $responderHasRequest['requestId'],
                    'status' => $responderHasRequest['status'],
                    'created_at' => $responderHasRequest['created_at'],
                ]);
            }else{
                array_push($responses,[
                    'responderID' => $responder['id'],
                    'userID' => $usersContainer[$i]['id'],
                    'fname' => $usersContainer[$i]['fname'],
                    'lname' => $usersContainer[$i]['lname'],
                    'responderType' => $responder['type'],
                    'requestID' => 'No request',
                    'status' => 'No status',
                    'created_at' => 'No record',
                ]);
                array_push($idlers,[
                    'responderID' => $responder['id'],
                    'userID' => $usersContainer[$i]['id'],
                    'fname' => $usersContainer[$i]['fname'],
                    'lname' => $usersContainer[$i]['lname'],
                    'responderType' => $responder['type'],
                    'requestID' => 'No request',
                    'status' => 'No status',
                    'created_at' => 'No record',
                ]);
            }
        }
            return view('/responders')->with([
                'responses' => $responses,
                'idleResponders' => $idlers,
                'handlingRequests' => $handlers,
            ]);
    }

    public function getAccountResponder($id){
        $responder = Responder::find($id);
        $userDetails = User::where('id', $responder->userId)->first();
        $respondersInfo = [];
        $today = date("Y-m-d");

        
            $requestsFromArchive = Response::onlyTrashed()->where('responderId', $responder->id)->get();
            
            $completed = 0;
            $cancelled = 0;

            if(!empty($requestsFromArchive)){
                for($j=0;$j<count($requestsFromArchive);$j++){
                    if($requestsFromArchive[$j]->status == 'Cancelled'){
                        $cancelled++;
                    }else if($requestsFromArchive[$j]->status == 'Completed'){
                        $completed++;
                    }
                }
            }

            $ongoingRequest = Response::where('responderId', $responder->id)->first();
            if($ongoingRequest){
                $ongoing = 1;
            }else{
                $ongoing = 0;
            }
            
            $diff = date_diff(date_create($userDetails->birthdate), date_create($today));
            $age = $diff->format('%y');

            $createDate = date("Y-m-d H:i",strtotime($userDetails->created_at));
            // dd($users[$i]['fname']);
            array_push($respondersInfo, [
                'responderId' => $responder->id,
                'type' => $responder->type,
                'email' => $userDetails->email,
                'fname' => $userDetails->fname,
                'mname' => $userDetails->mname,
                'lname' => $userDetails->lname,
                'gender' => $userDetails->gender,
                'birthdate' => $userDetails->birthdate,
                'age' => $age,
                'contactNumber' => $userDetails->contactNumber,
                'created_at' => $createDate,
                'completedRequests' => $completed,
                'cancelledRequests' => $cancelled,
                'ongoingRequest' => $ongoing,
                'joined' => $createDate,
            ]);
        // dd($respondersInfo);
        return response([
            'message' => 'Found',
            'responder' => $respondersInfo,
            'ongoing' => $ongoingRequest
        ]);
    }

    /**
     * Display the specified resource.
     *

     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $responder = Responder::find($id);
        if(!$responder){
            return response([
                'message' => 'Not Found'
            ], 404);
        }else{
            $userDetails = User::find($responder->userId);
            return response([
                'message' => 'Found',
                'responder' => $responder,
                'user' => $userDetails,
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
        $accountInputs = $request->validate([
            'email' => 'nullable',
            'fname' => 'nullable',
            'mname' => 'nullable',
            'lname' => 'nullable',
            'gender' => 'nullable',
            'birthdate' => 'nullable',
            'contactNumber' => 'nullable'
        ]);

        $repsonderInputs = $request->validate([
            'type' => 'nullable',
        ]);

        $responder = Responder::find($id);

        if($responder == []){
            return response([
                'message' => 'Not Found',
            ], 404);
        }else{
            $userResponderDetails = User::find($responder->userId);

            $userDetailsUpdated = $userResponderDetails->update($accountInputs);
            $responderDetailsUpdated = $responder->update($repsonderInputs);

            // dd($userDetailsUpdated);

            if($userDetailsUpdated == false || $userResponderDetails == false){
                return response([
                    'message' => 'Something went wrong during the update. Please check your parameters.'
                ], 400);
            }
            return response([
                'message' => 'Succesfully updated.',
                'responder' => $responder,
                'user' => $userResponderDetails,
            ], 200);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Responder  $responder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responder = Responder::find($id);
        $user = User::find($responder->userId);

        if($responder == []){
            return response([
                'message' => 'Not Found',
            ], 404);
        }

        $responder->destroy();
        $user->destroy();
        return response([
            'message' => 'Successfully deleted'
        ], 200);
    }

    /**
     * Serach the specified resource from storage.
     *
    * @param  str  $type
     * @return \Illuminate\Http\Response
     */
    public function responderType($type)
    {
    //    $responder = Responder::where('type', 'like', '%'.$type.'%')->get();

    //    if($responder == []){
    //         return response([
    //             'message' => 'Not Found'
    //         ]);
    //    }else{
    //     return response([
    //         'message' => 'Found',
    //         'responder' => $responder,
    //     ]);
    //    }
        if($type == 'All' || $type == 'all'){
            $responders = Responder::all();
        }else{
            $responders = Responder::where('type', 'like', '%'.$type.'%')->get();
        }
         $userDetails = User::where('role', 'Responder')->get();
            
            $userResponders = [];
            $count = 0;
            $max = count($responders);
            if($userDetails){
                foreach($userDetails as $userDetail){
                    if($count != $max){
                        array_push($userResponders, [
                        'responder' => $responders[$count],
                        'user' => $userDetail,
                        ]);
                        $count++;
                    } 
                }
                $message = 'Found';
            }else{
                $message = 'No record.';
            }
        return response([
            'message' => $message,
            'responders' => $userResponders
        ]);
    }

    

}
