<?php

use App\Http\Controllers\Admin\AnswersController;
use Illuminate\Support\Facades\Route;

Route::apiResource('answers', AnswersController::class);
