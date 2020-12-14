<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
	protected function checkRequestAuthorization(Request $request)
	{
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

	// Get Request
	public function checkout()
	{
		$response = Http::withOptions([
			'verify' => false
		])->withHeaders([
			'Key' => "d938615fdd53e66c29aa7c3f474e237b",
			'Content-Type' => 'application/json'
		])->get("https://api.rajaongkir.com/starter/province");

		// \dd($response->json());
		return view("user/checkout", [
			'title' => "Checkout",
			'provinces' => $response->json()["rajaongkir"]["results"]
		]);
	}

	public function thankyouPage() {
		return view("user/thankyou", [
			'title' => "Thank you!"
		]);
	}

	// API get
	public function getCityID($id) 
	{
		$response = Http::withOptions([
			'verify' => false
		])->withHeaders([
			'Key' => "d938615fdd53e66c29aa7c3f474e237b",
			'Content-Type' => 'application/json'
		])->get("https://api.rajaongkir.com/starter/city?province=" . $id);

		// \dd($response->json());
		return response(json_encode($response->json()['rajaongkir']['results']));
	}

	public function getShippingCost($origin = 444, $destination, $weight) {
		$response = Http::asForm()->withOptions([
			'verify' => false
		])->withHeaders([
			'Key' => "d938615fdd53e66c29aa7c3f474e237b",
			'Content-Type' => 'application/x-www-form-urlencoded'
		])->post("https://api.rajaongkir.com/starter/cost", [
			'origin' => 444,
			'destination' => $destination,
			'weight' => 1000,
			'courier' => "jne"
		]);

		return response(json_encode($response->json()['rajaongkir']));
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
			$cartId = User::find($authDataID)->cart_id;

			$cartItem = new CartItem();
			$cartItem->cart_id = $cartId;
			$cartItem->user_id = Auth::user()->id;
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
		if (!$request->ajax()) {
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

		if ($requestArray->get("cartitem_id") == null) {
			echo json_encode([
				'error' => [
					'message' => "Invalid fields!"
				]
			]);
			return;
		}


		$itemToDelete = CartItem::all()
			->where("cart_id", "=", Auth::user()->cart_id)
			->where("id", "=", $requestArray->get('cartitem_id'))
			->where("user_id", "=", Auth::user()->id)
			->first();

		if ($itemToDelete == null) {
			echo json_encode([
				'error' => [
					'message' => "Failed to delete item! Item doesn't exist!"
				]
			]);
			return;
		}

		if (!$itemToDelete->delete()) {
			echo json_encode([
				'error' => [
					'message' => "Delete unsuccessful!"
				]
			]);
			return;
		}
		echo json_encode([
			'data' => [
				'message' => "Delete successful!"
			]
		]);
		return;
	}

	// API get
	public function getCartItems(Request $request)
	{
		if ($request->isJson()) {
			$data = base64_decode($request->header("Authorization"));
			if ($data == null or !$user = Auth::loginUsingId($data)) {
				echo json_encode([
					"error" => [
						"message" => "Invalid access!"
					]
				]);
				return;
			}

			if ($user->cart_id == null) {
				echo json_encode([
					"data" => [
						"items" => null
					]
				]);
				return;
			}

			$items = [];

			$cartItems = CartItem::all()->where('user_id', '=', Auth::user()->id)->where('cart_id', '=', Auth::user()->cart_id);
			$total = 0;
			foreach ($cartItems as $it) {
				array_push($items, [
					'id' => $it->id,
					'user_id' => $it->user_id,
					'cart_id' => $it->cart_id,
					'count' => $it->count,
					'variant_id' => $it->variant_id,
					'item_name' => $it->item->item_name,
					'image' => $it->item->images[0]->filename,
					'price' => $it->item->price,
					'subtotal' => $it->count * $it->item->price
				]);

				$total += $it->count * $it->item->price;
			}

			echo json_encode([
				'data' => [
					"items" => $items,
					"total" => $total
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
