<?php

use App\Http\Controllers\Student\FetchDataController;
use Illuminate\Support\Facades\Route;

Route::controller(FetchDataController::class)->group(function() {
    Route::get('courses', 'courses_with_units');
    Route::get('lessons', 'lessons');
    Route::get('questions', 'questions_with_answers');
});
