<?php

use App\Http\Controllers\Admin\LessonsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('lessons', LessonsController::class);
