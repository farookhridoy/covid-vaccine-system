<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $pageTitle = 'Home';
    return view('welcome', compact('pageTitle'));
});

Route::get('registration', [RegistrationController::class, 'registration'])
    ->name('registration');
Route::post('registration-submit', [RegistrationController::class, 'store'])
    ->name('registration.store');

Route::get('vaccine-status', [RegistrationController::class, 'vaccineStatus'])
    ->name('vaccine.status');
