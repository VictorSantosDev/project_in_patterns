<?php

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

Route::prefix('dashboard')->middleware('authUser')->group(function() {
    Route::get('/home/{token?}', 'DashboardController@dashboard')->name('app.dashboard');
    Route::get('/home/user/wallet/{token?}', 'DashboardController@userWallet')->name('app.user-wallet');

    Route::post('/home/user/wallet/import/{token?}', 'DashboardController@importUserWallet')->name('app.import-user-wallet');
});