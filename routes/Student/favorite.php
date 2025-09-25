<?php

use App\Http\Controllers\Student\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::apiResource('favorite', FavoriteController::class);
