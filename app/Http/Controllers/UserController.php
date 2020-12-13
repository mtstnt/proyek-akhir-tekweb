<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	protected function checkRequestAuthorization(Request $request) {
		$authData = $request->header("Authorization");

		if ($authData == null) {
			return false;
		}

		$authDataID = base64_decode($authData);

		if (User::find($authDataID) == null) {
			return false;
		}

		return $authDataID;
	}

	public function profile()
	{
		return view("user/profile", [
			'title' => "Profile: " . Auth::user()->first_name . " " . Auth::user()->last_name,
		]);
	}

	public function history()
	{
		return view("user/history", [
			'title' => "History: " . Auth::user()->first_name . " " . Auth::user()->last_name,
		]);
	}

	public function viewCart()
	{
		$cartItems = Auth::user()->cartItems;
		
		return view("user/cart", [
			'title' => "Cart: " . Auth::user()->first_name . " " . Auth::user()->last_name,
			'items' => $cartItems,
			'i' => 1
		]);
	}

	public function editProfile()
	{
		return view("user/edit-profile", [
			'title' => "Edit Profile"
		]);
	}

	// API put
	public function addItemToCart(Request $request)
	{
		if ($request->isJson()) {
			$requestArray = $request->json();

			if (
				$requestArray->get('item_id') == null 	||
				$requestArray->get('count') == null
			) {
				echo json_encode([
					'error' => [
						'message' => "Invalid fields!",
					]
				]);
				return;
			}

			if (!$authDataID = $this->checkRequestAuthorization($request)) {
				echo json_encode([
					'error' => [
						'message' => "Invalid auth!"
					]
				]);
				return;
			}

			if (!Auth::loginUsingId($authDataID)) {
				echo json_encode([
					'error' => [
						'message' => "Invalid auth!"
					]
				]);
				return;
			}

			$cartId = null;

			if (Auth::user()->cart_id == null) {
				// Create new cart and insert item
				$newCart = new Cart();
				$newCart->cart_id = uniqid();
				$newCart->is_used = false;

				if (!$newCart->save()) {
					echo json_encode([
						'error' => [
							'message' => "Failed creating new cart!"
						]
					]);
					return;
				}

				$cartId = $newCart->cart_id;
				$user = User::find($authDataID);
				$user->cart_id = $newCart->cart_id;
				if (!$user->save()) {
					echo json_encode([
						'error' => [
							'message' => "Failed saving new cart to user!"
						]
					]);
				}
			}
			$cartId = User::find($request->header('Authentication'))->cart_id;

			$cartItem = new CartItem();
			$cartItem->cart_id = $cartId;
			$cartItem->user_id = Auth::id();
			$cartItem->item_id = $requestArray->get('item_id');
			$cartItem->count = $requestArray->get('count');
			$cartItem->variant_id = $requestArray->get('variant_id');

			if (!$cartItem->save()) {
				echo json_encode([
					'error' => [
						'message' => "Failed adding item to cart!"
					]
				]);
				return;
			}

			echo json_encode([
				'data' => [
					'added_item_id' => $requestArray->get('item_id')
				]
			]);
			return;
		}

		echo json_encode([
			'error' => [
				'message' => "Invalid request!"
			]
		]);
	}

	// API delete
	public function removeItemFromCart(Request $request)
	{
		if (!$request->isJson()) {
			echo json_encode([
				'error' => [
					'message' => "Invalid request!"
				]
			]);
			return;
		}

		if (!$authDataID = $this->checkRequestAuthorization($request)) {
			echo json_encode([
				'error' => [
					'message' => "Invalid auth!"
				]
			]);
			return;
		}

		if (!Auth::loginUsingId($authDataID)) {
			echo json_encode([
				'error' => [
					'message' => "Invalid auth!"
				]
			]);
			return;
		}

		$requestArray = $request->json();

		if ($requestArray->get("item_id") == null) {
			echo json_encode([
				'error' => [
					'message' => "Invalid fields!"
				]
			]);
			return;
		}

		var_dump(Auth::user()->cart_id->cartItems);
	}

	// API get
	public function getCartItems(Request $request)
	{
		if ($request->ajax()) {
			$data = $request->header("Authentication");
			if ($data == null or !$user = Auth::loginUsingId($data)) {
				echo json_encode([
					"error" => [
						"message" => "Invalid access!"
					]
				]);
				return;
			}

			if ($user->cart == null) {
				echo json_encode([
					"data" => [
						"items" => null
					]
				]);
				return;
			}

			echo json_encode([
				'data' => [
					"items" => $user->cart->cartItems
				]
			]);
			return;
		}
		echo json_encode([
			"error" => [
				"message" => "Invalid request!"
			]
		]);
		return;
	}
}
