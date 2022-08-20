<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthUserController;

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
Route::post('/regiter/user', [RegisterController::class, 'register'])->name('register-user');

// authenticate
Route::post('/auth', [AuthUserController::class, 'auth'])->name('auth');


Route::prefix('/app')->middleware('authUser')->group(function() {
    Route::get('/home', function(){
        return 'ola';
    })->name('app.home');
});