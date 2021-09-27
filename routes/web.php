<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\FrontendController;
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

Route::get('/dashboard', [DashboardController::class, 'index']);

// Route::get('/appointment/create/{doctorId}/{date}', [FrontendController::class, 'create'])
Route::get('/new-appointment/{doctorId}/{date}/', [FrontendController::class, 'createAppointment'])
    ->name('patient.appointment.create');

Route::post('/book/appointment', [FrontendController::class, 'bookAppointment'])
    ->name('book.appointment')->middleware('auth');

Route::get('/my-booking', [FrontendController::class, 'myBooking'])->middleware('auth');

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['auth', 'admin'],
], function () {
    Route::resource('doctors', '\App\Http\Controllers\Admin\DoctorController');
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth', 'doctor'],
], function () {

    Route::resource('appointments', '\App\Http\Controllers\Admin\AppointmentController');
    Route::post('/appointment/check', [AppointmentController::class, 'check'])->name('appointment.check');
    Route::post('/appointment/update', [AppointmentController::class, 'updateTime'])->name('update.times');
});