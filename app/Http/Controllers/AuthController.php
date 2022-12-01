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
            $token = $user->createToken('appToken')->plainTextToken;

            $responderFields = $request->validate([
                'type' => 'required',
            ]);

            $responderFields['userId'] = $user->id;

            $responder = Responder::create($responderFields);
            
             $response = [
                'message' => 'Responder Registered!',
                'user' => $user,
                'token' => $token,
                'responder' => $responder,
            ];
        }else{

            $user = User::create($fields);
            $token = $user->createToken('appToken')->plainTextToken;

            $response = [
            'message' => 'User Registered!',
            'user' => $user,
            'token' => $token,
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
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $fields['email'])->first();
        
        if(!$user || !Hash::check($fields['password'], $user->password)){
    
            return response([
                'message' => 'Invalid Credentials'
            ], 401);

        }else{
            Auth::login($user);
            $token = $user->createToken('appToken')->plainTextToken;
            // dd($user->tokens);
            return response([
                'message' => 'Logged In', 
                'user' => $user,
                'token' => $token,
            ], 200);
        }
    }

    /**
     * Logout the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // dd(PersonalAccessToken::where('tokenable_id', 1)->delete());
        // dd($request->bearerToken());
        // dd($request->user()->tokens()->delete());
        
        // return response(['message'=> 'Logged out'], 200);
    }

}
