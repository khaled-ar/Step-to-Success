<?php

use App\Http\Controllers\Admin\CoursesController;
use Illuminate\Support\Facades\Route;

Route::apiResource('courses', CoursesController::class);
