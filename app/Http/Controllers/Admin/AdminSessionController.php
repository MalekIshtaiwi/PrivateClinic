<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.auth.login');
    }




    public function login(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);
        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'doctor'])) {
            $request->session()->regenerate();

            // If successful, then redirect to admin dashboard
            return redirect('/admin/dashboard');
        }


                return back()->withErrors([
            'email' => 'بيانات الاعتماد هذه لا تتطابق مع سجلاتنا أو أنت لست طبيبًا.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();


        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}
