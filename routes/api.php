<?php

use App\Http\Controllers\{
    AuthController,
};
use App\Models\{
    pass
};
use Illuminate\Support\Facades\Route;

Route::middleware('lang')->group(function() {

    include(base_path('routes/auth.php'));

    Route::middleware('auth:sanctum')->group(function() {
        include(base_path('routes/Student/profile.php'));
        include(base_path('routes/Student/home.php'));

        Route::prefix('admin')->middleware('admin')->group(function() {
            include(base_path('routes/Admin/home.php'));
            include(base_path('routes/Admin/ads.php'));
        });
    });

});
