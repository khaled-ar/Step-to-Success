<?php

use App\Http\Controllers\Student\ProfilesController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->controller(ProfilesController::class)->group(function() {
    Route::get('', 'get');
    Route::post('', 'update');
    Route::put('update-password', 'update_password');
});
