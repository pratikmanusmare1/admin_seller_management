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

// Admin Routes
Route::post('/admin/login', [AdminController::class, 'login']);
Route::middleware('auth:sanctum')->post('/admin/sellers', [AdminController::class, 'createSeller']);
Route::middleware('auth:sanctum')->get('/admin/sellers', [AdminController::class, 'listSellers']);
Route::post('/seller/login', [AdminController::class, 'sellerLogin']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/seller/products', [SellerController::class, 'addProduct']);
Route::middleware('auth:sanctum')->delete('/seller/products/{id}', [SellerController::class, 'deleteProduct']);
