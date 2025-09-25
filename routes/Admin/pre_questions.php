<?php

use App\Http\Controllers\Admin\PreQuestionsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('pre-questions', PreQuestionsController::class);
