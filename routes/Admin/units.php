<?php

use App\Http\Controllers\Admin\UnitsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('units', UnitsController::class);
