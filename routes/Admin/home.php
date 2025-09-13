<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('statistics', fn() => [
    'students_count' => User::whereRole('student')->count(),
    'courses_count' => 0,
]);
