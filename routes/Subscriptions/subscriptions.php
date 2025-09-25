<?php

use App\Http\Controllers\SubscriptionsController;
use Illuminate\Support\Facades\Route;

Route::controller(SubscriptionsController::class)->group(function() {
    Route::post('courses/subscribe', 'store');
    Route::get('subscriptions', 'get_subscriptions');
    Route::delete('subscriptions/{subscription}', 'destroy');
    Route::post('subscriptions/{subscription}/transfer-image', 'store_transfer_image');
    Route::get('admin/subscriptions', 'index')->middleware('admin');
    Route::post('admin/subscriptions/{id}', 'update')->middleware('admin');
});
