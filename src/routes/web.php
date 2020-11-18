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

Route::get('/', function () {
    return view('welcome');
});

/** Admin */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Admin\Auth\LoginController@login');

    // Password reset
    Route::get('password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('password.request');
    Route::get('password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
});

Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    /** Admin */
    Route::get('/', 'Admin\HomeController@index');
    Route::get('home', 'Admin\HomeController@index')->name('home');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

    /** Setting */
    Route::name('settings.')->group(function () {
        Route::get('account', 'Admin\SettingController@account')->name('account');
        Route::post('account', 'Admin\SettingController@updateAccount')->name('account.update');
        Route::get('password', 'Admin\SettingController@password')->name('password');
        Route::post('password', 'Admin\SettingController@updatePassword')->name('password.update');
    });
});
