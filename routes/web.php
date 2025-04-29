<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.landing');
});
Route::get('/appointments', function () {
    return view('public.appointment.index');
})->name('appointments');
