<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Responder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
// use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{

    /**
     * Create user account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'role' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            'fname' => ['required', 'min:3'],
            'mname' => ['nullable', 'min:3'],
            'lname' => ['required', 'min:3'],
            'gender' => ['required'],
            'birthdate' => ['required'],
            'contactNumber' => ['required', 'regex:/^(09|\+639)\d{9}$/', 'max:13',  Rule::unique('users', 'contactNumber')],
        ]);

        $fields['password'] = bcrypt($fields['password']);

        if($fields['role'] == 'Responder'){
            
            $user = User::create($fields);
            $responderFields = $request->validate([
                'type' => 'required',
            ]);

            $responderFields['userId'] = $user->id;

            $responder = Responder::create($responderFields);
            
             $response = [
                'message' => 'Responder Registered!',
                'user' => $user,
                'responder' => $responder,
            ];
        }else{

            $user = User::create($fields);
            // event(new Registered($user));
            $response = [
            'message' => 'User Registered!',
            'user' => $user,
            ];
        }
        return response($response, 201);
    }

    /**
     * Log user into account.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $fields['email'])->first();
        
        if(!$user || !Hash::check($fields['password'], $user->password)){
    
            return response([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        if($user->role == 'Responder' || $user->role == 'responder'){
            $responder = Responder::where('userId', $user->id)->first();
            return response([
                'message' => 'Logged In', 
                'user' => $user,
                'token' => $user->createToken('appToken')->plainTextToken,
                'responder' => $responder,
            ], 200);
        }
            return response([
                'message' => 'Logged In', 
                'user' => $user,
                'token' => $user->createToken('appToken')->plainTextToken
            ], 200);
            // return $user->createToken('appToken')->plainTextToken;
    }

    /**
     * Logout the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $bToken = $request->bearerToken();
        $separator = "|";
        $output = explode($separator, $bToken);
        $accessToken = PersonalAccessToken::findToken($output[1]);
        // $user = User::find($accessToken->tokenable_id);
        if($accessToken->delete()){
            return response(['message'=> 'Logged out'], 200);
        }else{
            return response(['message'=> "Can't log out. Something went wrong."], 400);
        }   
        
    }

}
