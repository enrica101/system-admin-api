<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $users = User::where('role', 'like',  '%'.'User'.'%')->get();
        $usersInfo = [];
        $today = date("Y-m-d");
        
        
        for($i = 0; $i<count($users); $i++){
            $requestsFromArchive = RequestsInfo::onlyTrashed()->where('userID', $users[$i]['id'])->get();

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

            $ongoingRequest = RequestsInfo::where('userId', $users[$i]['id'])->get();
            if($ongoingRequest->isNotEmpty()){
                $ongoing = 1;
            }else{
                $ongoing = 0;
            }
            
            $diff = date_diff(date_create($users[$i]['birthdate']), date_create($today));
            $age = $diff->format('%y');

            $createDate = date("Y-m-d H:i:s",strtotime($users[$i]['created_at']));
            // dd($users[$i]['fname']);
            array_push($usersInfo, [
                'id' => $users[$i]['id'],
                'accountType' => $users[$i]['role'],
                'email' => $users[$i]['email'],
                'fname' => $users[$i]['fname'],
                'mname' => $users[$i]['mname'],
                'lname' => $users[$i]['lname'],
                'gender' => $users[$i]['gender'],
                'birthdate' => $users[$i]['birthdate'],
                'age' => $age,
                'contactNumber' => $users[$i]['contactNumber'],
                'created_at' => $createDate,
                'completedRequests' => $completed,
                'cancelledRequests' => $cancelled,
                'ongoingRequest' => $ongoing,
                'joined' => $users[$i]['created_at'],
            ]);
        }
        return response([
            'message' => 'Found',
            'users' => $usersInfo
        ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $bool = User::destroy($id);
            // dd($bool);
            if($bool == 1){
                return response(['message' => 'Deleted']);
            }else if($bool == 0){
                return response(['message' => 'Does not exist.']);
            }
    }
}
