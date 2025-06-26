<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public Routes (No Authentication Required)
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/seller/login', [AdminController::class, 'sellerLogin']);

// Protected Routes (Authentication Required)
Route::middleware('auth:sanctum')->group(function () {
    
    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/sellers', [AdminController::class, 'listSellers']);
        Route::post('/sellers', [AdminController::class, 'createSeller']);
    });
    
    // Seller Routes
    Route::prefix('seller')->group(function () {
        Route::post('/products', [SellerController::class, 'addProduct']);
        Route::delete('/products/{id}', [SellerController::class, 'deleteProduct']);
    });
    
    // User Info Route
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
