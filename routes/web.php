<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShopController::class, 'displayAll'])->name("main");
Route::get('checkout', [ShopController::class, 'checkout'])->name('main/checkout');
Route::get('view/{id}', [ShopController::class, 'viewItem']);

Route::prefix('auth')->group(function() {
	Route::get('/', function() { return redirect()->route("auth/login"); });
	Route::get('login', [AuthController::class, "login"])->name("auth/login");
	Route::get('register', [AuthController::class, "register"])->name("auth/register");
	Route::get('logout', [AuthController::class, "logout"])->name("auth/logout");
	Route::get('autologin/{mode}', [AuthController::class, "guestLogin"]);

	Route::post('login', [AuthController::class, "checkLogin"])->name("auth/checkLogin");
	Route::post('register', [AuthController::class, "checkRegister"])->name("auth/checkRegister");
});

Route::prefix('user')->group(function() {
	Route::get('/', function() { return redirect()->route("user/profile"); })->middleware('auth');
    Route::get('profile', [UserController::class, "profile"])->name("user/profile")->middleware('auth');
    Route::get('cart', [UserController::class, "viewCart"])->name("user/cart")->middleware('auth');
});

Route::prefix('admin')->group(function() {
	Route::get('/', [AdminController::class, "index"])->middleware('admin_only')->name('admin');

	Route::prefix('list')->group(function() {
		Route::get('/', [AdminController::class, "list"])->middleware('admin_only')->name('admin/list');
		Route::get('add-form', [AdminController::class, "addItemForm"])->middleware('admin_only')->name('admin/list/add-item');
		Route::get('update-form', [AdminController::class, "updateItemForm"])->middleware('admin_only')->name('admin/list/update-item');
		Route::get('changelog', [AdminController::class, "changeLog"])->middleware('admin_only')->name('admin/list/changelog');

		Route::post('add-form', [AdminController::class, "addItem"])->middleware('admin_only')->name('admin/list/send-add-item');
		Route::post('update-form', [AdminController::class, "updateItem"])->middleware('admin_only')->name('admin/list/send-update-item');
		Route::delete('update-form', [AdminController::class, "deleteItem"])->middleware('admin_only')->name('admin/list/send-delete-item');
	});

	Route::prefix('orders')->group(function() {
		Route::get('/', [AdminController::class, "orders"])->middleware('admin_only')->name('admin/orders');
		Route::get('pending', [AdminController::class, "orders"])->middleware('admin_only')->name('admin/orders/pending');
	});
});
