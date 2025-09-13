<?php

use App\Http\Controllers\Admin\AdsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('ads', AdsController::class);
