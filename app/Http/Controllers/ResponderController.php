<?php

namespace App\Http\Controllers;

use App\Models\User;
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
       $responder = Responder::where('type', 'like', '%'.$type.'%')->get();

       if($responder == []){
            return response([
                'message' => 'Not Found'
            ]);
       }else{
        return response([
            'message' => 'Found',
            'responder' => $responder,
        ]);
       }
    }

    

}
