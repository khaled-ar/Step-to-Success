<?php

use App\Http\Controllers\{
    AuthController,
};
use App\Models\{
    pass
};
use Illuminate\Support\Facades\Route;

Route::middleware('lang')->group(function() {

    include(base_path('routes/auth.php'));

});
