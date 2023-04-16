<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usersArchive()
    {
        $users = User::onlyTrashed()->get()->sortDesc()->sortDesc();
        if($users->isNotEmpty()){
            return response([
                'message' => 'Found',
                'totalCount' => count($users),
                'users' => $users,

            ], 200);
        }else{
            return response([
                'message' => 'No Record',
            ], 204);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function respondersArchive()
    {
        $responders = Responder::onlyTrashed()->get()->sortDesc();
        if($responders->isNotEmpty()){
            return response([
                'message' => 'Found',
                'totalCount' => count($responders),
                'responders' => $responders,

            ], 200);
        }else{
            return response([
                'message' => 'No Record',
            ], 204);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestsArchive()
    {
        $requestsInfo = RequestsInfo::onlyTrashed()->get()->sortDesc();
        if($requestsInfo->isNotEmpty()){
            return response([
                'message' => 'Found',
                'totalCount' => count($requestsInfo),
                'requests' => $requestsInfo,

            ], 200);
        }else{
            return response([
                'message' => 'No Record',
            ], 204);
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function responsesArchive()
    {
        $responses = Response::onlyTrashed()->get()->sortDesc();
        if($responses->isNotEmpty()){
            return response([
                'message' => 'Found',
                'totalCount' => count($responses),
                'responses' => $responses,

            ], 200);
        }else{
            return response([
                'message' => 'No Record',
            ], 204);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findArchivedUser($id)
    {
        $user =User::onlyTrashed()->where('id', $id)->first();
        if($user){
            return response([
                'message' => 'Found',
                'user' => $user
            ], 200);
        }else{
            return response([
                'message' => 'Not Found'
            ], 204);
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findArchivedResponder($id)
    {
        $responder =Responder::onlyTrashed()->where('id', $id)->first();
        if($responder){
            return response([
                'message' => 'Found',
                'responder' => $responder
            ], 200);
        }else{
            return response([
                'message' => 'Not Found'
            ], 204);
        }
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findArchivedRequest($id)
    {
        $requestInfo =RequestsInfo::onlyTrashed()->where('id', $id)->first();
        if($requestInfo){
            return response([
                'message' => 'Found',
                'requestInfo' => $requestInfo
            ], 200);
        }else{
            return response([
                'message' => 'Not Found'
            ], 204);
        }
    }

      
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findArchivedResponses($id)
    {
        $responseInfo =Response::onlyTrashed()->where('requestId', $id)->first();
        if($responseInfo){
            return response([
                'message' => 'Found',
                'responseInfo' => $responseInfo
            ], 200);
        }else{
            return response([
                'message' => 'Not Found'
            ], 204);
        }
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchRequestArchive($id)
    {
        $requestsInfo = RequestsInfo::onlyTrashed()->where('userId', $id)-> get()->sortDesc();
        if($requestsInfo){
            return response([
                'message' => 'Found', 
                'totalCount' => count($requestsInfo),
                'requestsInfo' => $requestsInfo
            ], 200);
        }else{
            return response([
                'message' => 'Not Found',
            ], 204);
        }
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchResponsesArchive($id)
    {
        $responsesInfo = Response::onlyTrashed()->where('responderId', $id)-> get()->sortDesc();
        dd($responsesInfo);
        if($responsesInfo){
            return response([
                'message' => 'Found', 
                'totalCount' => count($responsesInfo),
                'responsesInfo' => $responsesInfo
            ], 200);
        }else{
            return response([
                'message' => 'Not Found',
            ], 204);
        }
    }
}
