<?php

use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

//Admin Routes

//Auth Routes
Route::get('/admin/login',[AdminSessionController::class,'index']);
Route::post('/admin/login',[AdminSessionController::class,'login'])->name('admin.login');
Route::post('/admin/logout',[AdminSessionController::class,'logout'])->name('admin.logout');

//Dashboard Routes

//User Routes
Route::get('/', function () {
    return view('public.landing');
})->middleware('auth');

//Auth Routes

Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'store'])->name('register');
Route::get('/login',[SessionController::class,'index']);
Route::post('/login',[SessionController::class,'login'])->name('login');
Route::post('/logout',[SessionController::class,'logout'])->name('logout');
