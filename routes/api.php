<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1\CustomerController'], function() {
    Route::apiResource('/customers', CustomerController::class);
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1\InvoiceController'], function() {
    Route::apiResource('/invoices', InvoiceController::class);
});

