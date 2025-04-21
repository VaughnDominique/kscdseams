<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login() 
    {
       return view('login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $validated=auth()->attempt([
            'email'=> $request->email,
            'password'=> $request->password,
        ],$request->password);

        if ($validated) {
            return redirect()->route('dash')->with('success', 'Login Successfully');
            
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
}
