<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController; /*Import controller file */
use App\Http\Controllers\appointmentController;
use App\Http\Controllers\designController;
use App\Http\Controllers\orderController;

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
    return view('welcome');
});

Route::controller(userController::class)->group(function(){

    Route::get('loginPage','index')->name('loginPage');

    Route::get('registration','signUpPageStaff')->name('registration');

    // Route::get('signUpPageStaff','signUpPageStaff')->name('signUpPageStaff');

    Route::get('logout','logout')->name('logout');

    Route::post('validate_registration', 'validate_registration')->name('user.validate_registration');

    Route::post('validate_login', 'validate_login')->name('user.validate_login');

    Route::get('dashboard', 'dashboard')->name('dashboard');

});

Route::resource('appointment', appointmentController::class);

Route::resource('design', designController::class);

Route::resource('order', orderController::class);
