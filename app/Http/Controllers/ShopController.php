<?php

namespace App\Http\Controllers;

use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
	public function index()
	{
		$items = ShopItem::all();

		return view("shop/index", [
			'title' => "Shop Catalog",
			'items' => $items
		]);
	}

	// Get Request
	public function checkout()
	{
		return view("shop/checkout", [
			'title' => "Checkout"
		]);
	}

	// API get
	public function getItemData($data)
	{
		$items = ShopItem::all()->where('id', $data);

		$itemsJson = $items->toJson();

		return response($itemsJson)
			->header('Content-Type', 'application/json');
	}

	// API post
	public function addItemToCart()
	{
		if (request()->isJson()) {
			$requestBody = request()->json();
			$requestArray = json_decode($requestBody);

			// Field check
			if (
				!isset($requestArray['item_id']) 	||
				!isset($requestArray['user_id'])	||
				!isset($requestArray['count'])		||
				!isset($requestArray['cart_id'])
			) {
				return response([
					'status' => 200,
					'message' => "Invalid fields!",
					'result' => true
				])->header('Content-Type', 'application/json');
			}

			// Check apakah user skrg adalah user id yang dikirimkan
			if (Auth::user()->getAuthIdentifier() != $requestArray['user_id']) {
				return response([
					'status' => 200,
					'message' => "Invalid user!",
					'result' => true
				])->header('Content-Type', 'application/json');
			}

			// Get cart id yang dikirimkan. Check apakah usernya cocok.
			$item = ShopItem::where('cart_id', $requestArray['cart_id'])->first();
			dd($item);
		}
		return response([
			'status' => 200,
			'message' => "Failed parsing request data!",
			'result' => false
		])->header('Content-Type', 'application/json');
	}

	// API post
	public function removeItemFromCart()
	{
		if (request()->isJson()) {
			// Proses
			return response([
				'status' => 200,
				'message' => "Successfully removed item from cart!",
				'result' => true
			])->header('Content-Type', 'application/json');
		}
		return response([
			'status' => 200,
			'message' => "Failed parsing request data!",
			'result' => false
		])->header('Content-Type', 'application/json');
	}
}
