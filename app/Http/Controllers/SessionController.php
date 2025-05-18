<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function index()
    {
        return view('public.auth.login');
    }

    public function store()
    {
        $creds = request()->validate([
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&\-_])[A-Za-z\d@$!%*?&\-_]{8,}$/',
        ]);
        // you can provide the attempt with another boolean argument if you want to remember the user
        if (! Auth::attempt($creds)){
            throw ValidationException::withMessages([
                'email' => 'wrong creds'
            ]);
        }

        request()->session()->regenerate();

        //redirect to home page

    }
}
