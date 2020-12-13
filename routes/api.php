<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Api endpoint utk get data item
Route::get('/items/{id}', [ShopController::class, 'getItemData'])->where('id', '[0-9]+');

// Api endpoint utk push, delete data dari cart
Route::get('/cart', [UserController::class, 'getCartItems']);
Route::post('/cart', [UserController::class, 'updateItemCountInCart']);
Route::put('/cart', [UserController::class, 'addItemToCart']);
Route::delete('/cart', [UserController::class, 'removeItemFromCart']);
