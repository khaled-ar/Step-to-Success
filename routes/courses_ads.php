<?php

use App\Http\Controllers\{
    CoursesAdsController,
};

use Illuminate\Support\Facades\Route;

Route::prefix('courses-ads')->controller(CoursesAdsController::class)->group(function() {
    Route::post('admin', 'store');
    Route::get('', 'index');
    Route::delete('', 'destroy');
});
