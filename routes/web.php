<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
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

Route::get('/', [ShopController::class, 'index']);

Route::prefix('auth')->group(function() {
	Route::get('/', function() { return redirect()->route("auth/login"); });
	Route::get('login', [AuthController::class, "login"])->name("auth/login");
	Route::get('register', [AuthController::class, "register"])->name("auth/register");
	Route::get('logout', [AuthController::class, "logout"])->name("auth/logout");

	Route::post('login', [AuthController::class, "checkLogin"])->name("auth/checkLogin");
	Route::post('register', [AuthController::class, "checkRegister"])->name("auth/checkRegister");
});