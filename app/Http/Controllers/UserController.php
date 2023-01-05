<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\AdminController;
use App\Models\Response as ResponseModel;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUsers()
    {
        return User::where('role', 'like',  '%'.'User'.'%')->get();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexResponders()
    {
        return User::where('role', 'like',  '%'.'Responder'.'%')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmins()
    {
        return User::where('role', 'like',  '%'.'Admin'.'%')->get();
    }

                /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserAccount($id)
    {
        $user = User::find($id);
        $usersInfo = [];
        $today = date("Y-m-d");
        
            $requestsFromArchive = RequestsInfo::onlyTrashed()->where('userId', $user['id'])->get();
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

            $ongoingRequest = RequestsInfo::where('userId', $user['id'])->get();
            if($ongoingRequest->isNotEmpty()){
                $ongoing = 1;
            }else{
                $ongoing = 0;
            }
            
            $diff = date_diff(date_create($user['birthdate']), date_create($today));
            $age = $diff->format('%y');

            $createDate = date("Y-m-d H:i:s",strtotime($user['created_at']));
            // dd($users[$i]['fname']);
            array_push($usersInfo, [
                'id' => $user['id'],
                'accountType' => $user['role'],
                'email' => $user['email'],
                'fname' => $user['fname'],
                'mname' => $user['mname'],
                'lname' => $user['lname'],
                'gender' => $user['gender'],
                'birthdate' => $user['birthdate'],
                'age' => $age,
                'contactNumber' => $user['contactNumber'],
                'created_at' => $createDate,
                'completedRequests' => $completed,
                'cancelledRequests' => $cancelled,
                'ongoingRequest' => $ongoing,
                'joined' => $createDate,
            ]);
        
        return response([
            'message' => 'Found',
            'user' => $usersInfo
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            return response([
                'message' => 'Found',
                'user' => $user,
            ], 200);
        }else {
            return response([
                'message' => 'Not found'
            ], 404);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if($user){
            
            $user->update($request->all());

            return response([
                'message' => 'Updated',
                'user' => $user,
            ], 200);
        }else {
            return response([
                'message' => 'Not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $user = User::find($id);
            $requestExist = RequestsInfo::where('userId', $id)->first();
            if($user->role == 'Responder'||$user->role == 'responder'){
                $responder = Responder::where('userId', $id)->first();
                $responseExist = ResponseModel::where('responderId', $responder->id)->first();
                if($responseExist){
                    return response([
                        'message' => 'Cannot delete this user while handling request.'
                    ]);
                }else{
                    if($responder->delete()){
                        if($user->delete()){
                            return response([
                                'message' => 'Deleted.'
                            ]);
                        }
                    }  
                }
            }else{
                if($requestExist){
                    $responseExist = ResponseModel::where('requestId', $requestExist->id)->first();
                    if($responseExist){
                        $responseExist->delete();
                        if($requestExist->delete()){
                            if($user->delete()){
                                 return response([
                            'message' => 'Deleted.'
                        ]);
                            }
                        }
                    }else{
                        if($requestExist->delete()){
                            if($user->delete()){
                                 return response([
                            'message' => 'Deleted.'
                        ]);
                            }
                        }
                    }
                    
                }else{
                    if($user->delete()){
                        return response([
                            'message' => 'Deleted.'
                        ]);
                    }
                }
                
            }
    }
}
