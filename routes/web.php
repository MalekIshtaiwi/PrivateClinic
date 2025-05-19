<?php

use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\Admin\AppointmentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MedicalRecordsController;
use App\Http\Controllers\Admin\PatientsController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

/*----------------------------------------------------Admin Routes--------------------------------------------*/

//Auth Routes
Route::get('/admin/login',[AdminSessionController::class,'index']);
Route::post('/admin/login',[AdminSessionController::class,'login'])->name('admin.login');
Route::post('/admin/logout',[AdminSessionController::class,'logout'])->name('admin.logout');

//Dashboard Routes
Route::get('/admin/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');

//Schedule Routes
Route::get('/admin/schedule',[ScheduleController::class,'index'])->name('admin.schedule');
//Appointments Routes
Route::get('/admin/appointments',[AppointmentsController::class,'index'])->name('admin.appointments');
//Patients Routes
Route::get('/admin/patients',[PatientsController::class,'index'])->name('admin.patients');
//Medical Records Routes
Route::get('/admin/records',[MedicalRecordsController::class,'index'])->name('admin.records');




/*----------------------------------------------------User Routes--------------------------------------------*/

Route::get('/', function () {
    return view('public.landing');
})->middleware('auth');

//Auth Routes

Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'store'])->name('register');
Route::get('/login',[SessionController::class,'index']);
Route::post('/login',[SessionController::class,'login'])->name('login');
Route::post('/logout',[SessionController::class,'logout'])->name('logout');

Route::get('/appointments',function(){
    return view('public.appointments.index');
});
Route::get('/appointment',function(){
    return view('public.appointment.index');
});

