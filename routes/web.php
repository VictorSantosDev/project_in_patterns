<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [RegisterController::class, 'signin'])->name('signin');
Route::get('/form/register', [RegisterController::class, 'index'])->name('form-register');
Route::get('/reset/password', [RegisterController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset/password/user', [RegisterController::class, 'resetPasswordUser'])->name('reset-password-user');
Route::post('/regiter/user', [RegisterController::class, 'register'])->name('register-user');

// route verify email
Route::get('/verify/email/token/{token}', [RegisterController::class, 'verifyEmail'])->name('verify-email');

// authenticate
Route::get('/check/authUser/{token}', [AuthUserController::class, 'checkAuthUser'])->name('check-auth');
Route::post('/auth', [AuthUserController::class, 'auth'])->name('auth');

Route::prefix('/app')->middleware('authUser')->group(function() {
    Route::get('/home/{token?}', [HomeController::class, 'index'])->name('app.home');
});
