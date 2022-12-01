<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function create(){
        return view('register');
    }

    public function store(Request $request, ){
        $formInputs = $request->validate([ 
            'accountType' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            'fname' => ['required', 'min:3'],
            'mname' => ['nullable', 'min:3'],
            'lname' => ['required', 'min:3'],
            'gender' => ['required'],
            'birthdate' => ['required'],
            'contactNumber' => ['nullable', 'regex:/^(09|\+639)\d{9}$/', 'max:13',  Rule::unique('users', 'contactNumber')],
            'avatar'  => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        // Hash Password
        $formInputs['password'] = bcrypt($formInputs['password']);
        
        if($request->hasFile('avatar')){
            $formInputs['avatar'] = $request->file('avatar')->store('avatars', 'public');c
        }
        
        // Create User
        $user = User::create($formInputs);

        // Login
        auth()->login($user); 
        return redirect('/dashboard');
    }
}
