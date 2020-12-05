<?php

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

Route::get('/', [ShopController::class, 'index'])->name("main");
Route::get('catalog', [ShopController::class, 'displayAll'])->name('main/catalog');
Route::get('checkout', [ShopController::class, 'checkout'])->name('main/checkout');
Route::get('view/{id}', [ShopController::class, 'viewItem']);

Route::prefix('auth')->group(function() {
	Route::get('/', function() { return redirect()->route("auth/login"); });
	Route::get('login', [AuthController::class, "login"])->name("auth/login");
	Route::get('register', [AuthController::class, "register"])->name("auth/register");
    Route::get('logout', [AuthController::class, "logout"])->name("auth/logout");

	Route::post('login', [AuthController::class, "checkLogin"])->name("auth/checkLogin");
	Route::post('register', [AuthController::class, "checkRegister"])->name("auth/checkRegister");
});

Route::prefix('user')->group(function() {
	Route::get('/', function() { return redirect()->route("user/profile"); })->middleware('auth');
    Route::get('profile', [UserController::class, "profile"])->name("user/profile")->middleware('auth');
    Route::get('cart', [UserController::class, "viewCart"])->name("user/cart")->middleware('auth');
});
