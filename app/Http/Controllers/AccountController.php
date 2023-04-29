<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;



class AccountController extends Controller
{
    public function create()
    {
        return view('accountcreate');
    }

    public function store(Request $request)
    {
      
        $validated = $request->validate([ 
            'role' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            'fname' => ['required', 'min:3'],
            'mname' => ['nullable', 'min:3'],
            'lname' => ['required', 'min:3'],
            'gender' => ['required'],
            'birthdate' => ['required'],
            'contactNumber' => ['nullable', 'regex:/^(09|\+639)\d{9}$/', 'max:13',  Rule::unique('users', 'contactNumber')],
        ]);
        dd();
        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);
        dd();
        return redirect('/dashboard')->with('success', 'Registration successful. Please login.');
    }
}
