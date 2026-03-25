<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SaleController;

// Removed the `Route::prefix('api')->group` block, as `routes/api.php` already applies the `api` prefix in Laravel 11/12 via `bootstrap/app.php`.
// Public
Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{car}', [CarController::class, 'show']);

Route::post('/appointments', [AppointmentController::class, 'store']); // Public appointment booking

// Auth
Route::post('/login', [AuthController::class, 'login']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('cars', CarController::class)->except(['index', 'show']);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('inquiries', InquiryController::class);
    Route::apiResource('sales', SaleController::class);
});
