<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
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

        $user = request()->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&\-_])[A-Za-z\d@$!%*?&\-_]{8,}$/'
        ]);

        $patient = request()->validate([
            'name' => 'required|string|min:3',
            'age' => 'nullable|integer|min_digits:2',
            'gender' => 'required', // you can make this an enum of both values
            'status' => 'required', // you can make this an enum of both values
        ]);

        //when the user registers they provide data so that we create their first patient
        $user = User::create($user);

        Patient::create($patient + [
            'user_id' => $user->id,
        ]);

        Auth::login($user);

        return redirect('/');
        //redirecet to home
    }
}
