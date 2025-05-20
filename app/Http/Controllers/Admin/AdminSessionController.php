<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // User with this email doesn't exist
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'لا يوجد حساب مسجل بهذا البريد الإلكتروني.'
                ]);
        }

        if ($user->role !== 'doctor') {
            // User exists but is not a doctor
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'هذا الحساب لا يملك صلاحيات الطبيب.'
                ]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'doctor'])) {
            $request->session()->regenerate();

            // If successful, then redirect to admin dashboard
            return redirect('/admin/dashboard');
        } else {
            return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'password'=> 'كلمة المرور غير صحيحة'
            ]);
        }



    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
