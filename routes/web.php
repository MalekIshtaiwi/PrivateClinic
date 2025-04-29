<?php

use Illuminate\Support\Facades\Route;
//admin basic routes
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/dashboard-login', function () {
    return view('admin.auth.login');
});

//user basic routes
Route::get('/', function () {
    return view('public.landing');
});
Route::get('/appointments', function () {
    return view('public.appointment.index');
})->name('appointments');

Route::get('/appointments-confirm', function () {
    return view('public.appointment.confirm');
})->name('appointments_confirm');

Route::get('/login', function () {
    return view('public.auth.login');
})->name('login');
