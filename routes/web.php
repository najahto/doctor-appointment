<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Doctor\PrescriptionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/new-appointment/{doctorId}/{date}/', [FrontendController::class, 'createAppointment'])
    ->name('patient.appointment.create');


Route::group(
    ['middleware' => ['auth', 'patient']],
    function () {
        Route::post('/book/appointment', [FrontendController::class, 'bookAppointment'])
            ->name('book.appointment');
        Route::get('/my-booking', [FrontendController::class, 'myBooking']);
        Route::get('/my-prescription', [FrontendController::class, 'myPrescription'])->name('my.prescription');
        Route::get('/profile', [ProfileController::class, 'show']);
        Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
        Route::post('/profile/picture', [ProfileController::class, 'profilePicture'])->name('profile.picture');
    }
);

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['auth', 'admin'],
], function () {
    Route::resource('doctors', '\App\Http\Controllers\Admin\DoctorController');
    Route::get('/patients', [PatientController::class, 'index'])->name('patients');
    Route::get('/status/update/{id}', [PatientController::class, 'updateStatus'])->name('status.update');
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth', 'doctor'],
], function () {

    Route::resource('appointments', '\App\Http\Controllers\Admin\AppointmentController');
    Route::post('/appointment/check', [AppointmentController::class, 'check'])->name('appointment.check');
    Route::post('/appointment/update', [AppointmentController::class, 'updateTime'])->name('update.times');
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions');
    Route::post('/prescriptions/store', [PrescriptionController::class, 'store'])->name('prescription.store');
    Route::get('/prescriptions/show/{id}', [PrescriptionController::class, 'show'])->name('prescription.show');
});