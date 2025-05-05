<?php

use Illuminate\Support\Facades\Route;
//admin basic routes
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/dashboard-login', function () {
    return view('admin.auth.login');
});
Route::get('/dashboard-appointments', function () {
    return view('admin.appointments.index');
});

Route::get('/admin-schedule', function () {
    return view('admin.schedule.index');
});

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
