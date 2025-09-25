<?php

use App\Http\Controllers\Admin\StudentsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', StudentsController::class);
