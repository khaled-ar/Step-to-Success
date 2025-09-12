<?php

use App\Http\Controllers\{
    AuthController,
};

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(AuthController::class)->group(function() {
    Route::post('admin/login', 'login_admin');
    Route::post('register', 'register');
    Route::post('login', 'login_student');
    Route::post('forgot-password', 'forgot_password');
    Route::post('reset-password', 'reset_password');
    Route::post('verify', 'verify');
    Route::post('resend-code', 'resend_code')->middleware('throttle:1,1');
    Route::delete('logout', 'logout')->middleware('auth:sanctum');
});
