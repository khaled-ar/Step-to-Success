<?php

use App\Models\Ad;
use Illuminate\Support\Facades\Route;

Route::get('ads', fn() => ['ads' => Ad::latest('id')->get()]);
