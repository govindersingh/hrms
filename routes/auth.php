<?php

// $clientIP = $_SERVER['REMOTE_ADDR'];
// $allowedIps = ['223.178.212.121'];
// if (!filter_var($clientIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) && !in_array($clientIP, $allowedIps)) {
//     abort(403, 'Access denied');
//     exit();
// }

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAuth');

    Route::get('forgot-password', 'forgotPassword')->name('password.email');
    Route::post('forgot-password', 'sendResetLink')->name('password.request');
    Route::get('reset-password/{token}', 'resetPassword')->name('password.reset');
    Route::post('reset-password', 'updatePassword')->name('password.update');
});
