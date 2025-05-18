<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        // create the register view only for testing --- final product will only have login through phone
        //maybe consider registering through phone
        return view('public.auth.register');
    }

    public function store()
    {
        $creds = request()->validate([
            'name' => 'required|string|min:3',
            'age' => 'required|integer|min_digits:2',
            'gender' => 'required', // you can make this an enum of both values
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&\-_])[A-Za-z\d@$!%*?&\-_]{8,}$/',
        ]);

        //when the user registers they provide data so that we create their first patient
        Patient::create();

        $user = Auth::create($creds);

        Auth::login($user);

        //redirecet to home
    }

}
