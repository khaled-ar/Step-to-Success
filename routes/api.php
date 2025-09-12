<?php

use App\Http\Controllers\{
    AuthController,
};
use App\Models\{
    pass
};
use Illuminate\Support\Facades\Route;

Route::middleware('lang')->group(function() {

    Route::prefix('auth')->controller(AuthController::class)->group(function() {
        Route::post('login', 'login');
        Route::post('forgot-password', 'forgot_password');
        Route::post('reset-password', 'reset_password');
        Route::post('verify', 'verify');
        Route::post('resend-code', 'resend_code')->middleware('throttle:1,1');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
    });

});
