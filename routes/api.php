<?php

use Illuminate\Support\Facades\Route;

Route::middleware('lang')->group(function() {

    include(base_path('routes/auth.php'));

    Route::middleware('auth:sanctum')->group(function() {
        include(base_path('routes/Student/profile.php'));
        include(base_path('routes/Student/home.php'));
        include(base_path('routes/Student/favorite.php'));
        include(base_path('routes/Student/notes.php'));
        include(base_path('routes/Student/fetch_data.php'));
        include(base_path('routes/courses_ads.php'));

        Route::prefix('admin')->middleware('admin')->group(function() {
            include(base_path('routes/Admin/home.php'));
            include(base_path('routes/Admin/ads.php'));
            include(base_path('routes/Admin/courses.php'));
            include(base_path('routes/Admin/units.php'));
            include(base_path('routes/Admin/lessons.php'));
            include(base_path('routes/Admin/pre_questions.php'));
            include(base_path('routes/Admin/questions.php'));
            include(base_path('routes/Admin/answers.php'));
            include(base_path('routes/Admin/students.php'));
        });

        include(base_path('routes/Subscriptions/subscriptions.php'));

    });
});
