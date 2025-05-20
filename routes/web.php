<?php
/*Admin Controllers */
use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\Admin\AppointmentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MedicalRecordsController;
use App\Http\Controllers\Admin\PatientsController;
use App\Http\Controllers\Admin\ScheduleController;

/*User Controllers */
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

/*----------------------------------------------------Admin Routes--------------------------------------------*/

//Auth Routes
Route::get('/admin/login', [AdminSessionController::class, 'index']);
Route::post('/admin/login', [AdminSessionController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminSessionController::class, 'logout'])->name('admin.logout')->middleware('doctor');

//Dashboard Routes
Route::middleware('doctor')->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('doctor');


});


//Schedule Routes
Route::middleware('doctor')->group(function () {

    Route::get('/admin/schedule', [ScheduleController::class, 'index'])->name('admin.schedule');


});

//Appointments Routes
Route::middleware('doctor')->group(function () {

    Route::get('/admin/appointments', [AppointmentsController::class, 'index'])->name('admin.appointments');


});

//Patients Routes
Route::middleware('doctor')->group(function () {

    Route::get('/admin/patients', [PatientsController::class, 'index'])->name('admin.patients');


});

//Medical Records Routes
Route::middleware('doctor')->group(function () {

    Route::get('/admin/records', [MedicalRecordsController::class, 'index'])->name('admin.records');


});





/*----------------------------------------------------User Routes--------------------------------------------*/

Route::get('/', function () {
    return view('public.landing');
});

//Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/login', [SessionController::class, 'index']);
    Route::post('/login', [SessionController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
});

//Patients Routes
Route::middleware('auth')->group( function () {
   Route::resource('patients', PatientController::class)->except(['destroy','edit','create']);
});

//personal appointment routes
Route::middleware('auth')->group(function () {

    Route::get('/appointments', function () {
        return view('public.appointments.index');
    });


});

//book appointment routes
Route::middleware('auth')->group(function () {

    Route::get('/appointment', function () {
        return view('public.appointment.index');
    });


});


