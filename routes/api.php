<?php

use App\Http\Controllers\ShopController;
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
Route::middleware('auth:api')->post('/cart', [ShopController::class, 'getCartData']);
Route::middleware('auth:api')->post('/cart', [ShopController::class, 'updateItemCountInCart']);
Route::middleware('auth:api')->put('/cart', [ShopController::class, 'addItemToCart']);
Route::middleware('auth:api')->delete('/cart', [ShopController::class, 'removeItemFromCart']);