<?php

use App\Http\Controllers\Admin\QuestionsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('questions', QuestionsController::class);
