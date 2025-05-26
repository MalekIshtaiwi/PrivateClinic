<?php
/*Admin Controllers */
use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\Admin\AppointmentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MedicalRecordsController;
use App\Http\Controllers\Admin\PatientsController as AdminPatientsController;
use App\Http\Controllers\Admin\ScheduleController;

/*User Controllers */
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AppointmentsController as UserAppointmentsController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

/*----------------------------------------------------Admin Routes--------------------------------------------*/

//Auth Routes
Route::get('/admin/login', [AdminSessionController::class, 'index'])->middleware('guest');
Route::post('/admin/login', [AdminSessionController::class, 'login'])->name('admin.login')->middleware('guest');
Route::post('/admin/logout', [AdminSessionController::class, 'logout'])->name('admin.logout')->middleware('doctor');

//Dashboard Routes
Route::middleware('doctor')->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('doctor');


});


//Schedule Routes
Route::middleware('doctor')->group(function () {

    Route::get('/admin/schedule', [ScheduleController::class, 'index'])->name('admin.schedule');
    Route::put('/admin/schedule', [ScheduleController::class, 'update'])->name('admin.schedule.update');


});

//Appointments Routes
Route::middleware('doctor')->group(function () {

    Route::get('/admin/appointments', [AppointmentsController::class, 'index'])->name('admin.appointments');


});

//Patients Routes
Route::middleware('doctor')->prefix('admin')->name('admin.')->group(function () {

    // Other admin routes...

    // Patients routes
    Route::resource('patients', AdminPatientsController::class);

    // Additional routes for search and filter functionality
    Route::get('patients/search', [AdminPatientsController::class, 'search'])->name('patients.search');
    Route::get('patients/filter', [AdminPatientsController::class, 'filter'])->name('patients.filter');

    // Other admin routes...
});
// Route::middleware('doctor')->group(function () {

//     Route::get('/admin/patients', [PatientsController::class, 'index'])->name('admin.patients');
//     Route::get('/admin/patients/{patient}', [PatientsController::class, 'show'])->name('admin.patients.show');


//     Route::get('patients/search', [PatientController::class, 'search'])->name('patients.search');
//     Route::get('patients/filter', [PatientController::class, 'filter'])->name('patients.filter');

// });

//Medical Records Routes
Route::middleware('doctor')->group(function () {

    Route::prefix('/admin')->name('admin.')->middleware('doctor')->group(function () {
        Route::get('/patients/{patient}/medical-records/create', [MedicalRecordsController::class, 'create'])->name('medical_records.create');
        Route::post('/patients/{patient}/medical-records', [MedicalRecordsController::class, 'store'])->name('medical_records.store');
    });


});





/*----------------------------------------------------User Routes--------------------------------------------*/

Route::get('/', function () {
    return view('public.landing');
})->name('home');

//Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/login', [SessionController::class, 'index']);
    Route::post('/login', [SessionController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
    Route::post('/profile', [SessionController::class, 'login'])->name('profile');
});

//Patients Routes
Route::middleware('auth')->group(function () {
    Route::resource('patients', PatientController::class)->except(['destroy', 'edit', 'create']);
    Route::get('/appointments', [UserAppointmentsController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [UserAppointmentsController::class, 'store']);
});

//personal appointment routes


/*make a controller for this route the user sees the schedule there and interacts with the patient controller
 and the appointments controller to book appointments and the appointments controller generates slots for the available
 times and days based on the day and time of the user and prevents them from double booking

*/

