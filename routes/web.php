<?php

use App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Auth as UserAuth;

use Illuminate\Support\Facades\Route;

//Admin Routes

//Auth Routes
Route::get('/auth',[Auth::class,'index']);

Route::get('/auth',[Auth::class,'index']);


Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/dashboard-appointments', function () {
    return view('admin.appointments.index');
});

Route::get('/admin-schedule', function () {
    return view('admin.schedule.index');
});

Route::get('/admin-appointments', function () {
    return view('admin.appointments.index');
})->name('appointments');

Route::get('/admin-schedule', function () {
    return view('admin.schedule.index');
})->name('schedule');

//user basic routes
Route::get('/', function () {
    return view('public.landing');
});
Route::get('/book-appointment', function () {
    return view('public.appointment.index');
})->name('appointment');

Route::get('/appointment-confirmed', function () {
    return view('public.appointment.confirm');
})->name('appointment_confirm');

Route::get('/appointments', function () {
    return view('public.appointments.index');
})->name('appointments');

Route::get('/profile', function () {
    return view('public.profile.index');
})->name('profile');

Route::get('/patients', function () {
    return view('public.patients.index');
})->name('patients');

Route::get('/login', function () {
    return view('public.auth.login');
})->name('login');
