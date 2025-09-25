<?php

use App\Models\StudentQuestion;
use Illuminate\Support\Facades\Route;

Route::post('questions/notes', function() {
    request()->validate(['note' => ['required', 'string', 'max:1000']]);
    StudentQuestion::create([
        'user_id' => request()->user()->id,
        'question_id' => request('question_id'),
        'note' => request('note'),
    ]);
    return response()->json([
        'message' => __('responses.201'),
        'data' => null,
    ], 201);
})->middleware('auth:sanctum');
