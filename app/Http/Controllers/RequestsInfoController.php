<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RequestsInfoController extends Controller
{
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
        // dd($request['userId']);
        $fields = $request->validate([
            'userId' => ['required'],
            'type' => ['required'],
            'location' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'status' => ['required'],
        ]);

        $user = User::where('id', $request['userId'])->first();
        // dd($fields['userId']);
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
            $requestUpdated = RequestsInfo::where('id', $id)->update(['status' => 'Cancelled']);
            if($requestUpdated){
                if(RequestsInfo::where('id', $id)->delete()){
                    $message = "Request is completed and is moved to archives.";
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
        return RequestsInfo::where('location', 'like', '%'.$location.'%')->get();
 
    }
}
