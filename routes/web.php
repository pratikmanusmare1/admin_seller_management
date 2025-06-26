<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/home', function () {
    return view('landing');
})->name('home');

Route::get('/admin/sellers-list', [AdminController::class, 'showSellersList']);

Route::get('/admin/login', [AdminController::class, 'showAdminLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'handleAdminLogin'])->name('admin.login.handle');

Route::get('/seller/login', [AdminController::class, 'showSellerLoginForm'])->name('seller.login.form');
Route::post('/seller/login', [AdminController::class, 'handleSellerLogin'])->name('seller.login.handle');

Route::post('/seller/logout', [AdminController::class, 'sellerLogout'])->name('seller.logout');
Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

Route::get('/seller/add-product', [SellerController::class, 'showAddProductForm'])->name('seller.add.product.form');
Route::post('/seller/add-product', [SellerController::class, 'handleAddProduct'])->name('seller.add.product.handle');

Route::get('/seller/dashboard', [AdminController::class, 'sellerDashboard'])->name('seller.dashboard');

Route::post('/seller/products/{id}/delete', [SellerController::class, 'deleteProductWeb'])->name('seller.product.delete');
Route::get('/admin/sellers-list', [AdminController::class, 'showSellersList']);
Route::get('/admin/sellers-list', [AdminController::class, 'showSellersList'])->name('admin.sellers.list');

Route::get('/admin/sellers/add', [AdminController::class, 'showAddSellerForm'])->name('admin.sellers.add.form');
Route::post('/admin/sellers/add', [AdminController::class, 'handleAddSeller'])->name('admin.sellers.add.handle');