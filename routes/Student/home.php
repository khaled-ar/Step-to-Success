<?php

use App\Models\Ad;
use Illuminate\Support\Facades\Route;

Route::get('ads', fn() => ['ads' => Ad::latest()->limit(10)->get()]);
