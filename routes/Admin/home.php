<?php

use App\Models\{
    Course,
    Subscription,
    User
};
use Illuminate\Support\Facades\Route;

Route::get('statistics', fn() => [
    'students_count' => User::whereRole('student')->count(),
    'scientific_courses_count' => Course::whereType('scientific')->count(),
    'literary_courses_count' => Course::whereType('literary')->count(),
    'subscriptions' => Subscription::whereStatus('pending')->count(),
]);
