<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
	public function createPayment(Request $request)
	{
		if (!$request->ajax()) {
			echo json_encode([
				'error' => [
					'message' => "Bad request"
				]
			]);
			return;
		}

		$authKey = base64_decode($request->header('Authorization'));
		if (!Auth::loginUsingId($authKey)) {
			echo json_encode([
				'error' => [
					'message' => "Bad auth"
				]
			]);
			return;
		}

		$cartId = Auth::user()->cart_id;

		// Hitung total penbayaran
		$sum = DB::table("carts")
			->select([DB::raw("SUM(items.price * carts.count) as total")])
			->from("carts")
			->join('items', 'carts.item_id', '=', 'items.id')
			->where('cart_id', '=', $cartId)->first();

		if ($sum == null) {
			echo json_encode([
				'error' => [
					'message' => "Failed query!"
				]
			]);
			return;
		}

		$req = $request->json();
		$shippingCost = $req->get('shipping-cost');

		$response = Http::withOptions([
			'verify' => false
		])->get('https://free.currconv.com/api/v7/convert?q=USD_IDR,IDR_USD&compact=ultra&apiKey=0e09124ee496dfd7be6d');
		$responseObject = $response->json();
		$totalPrice = round(($sum->total + $shippingCost) * $responseObject['IDR_USD']);

		echo json_encode([
			'data' => [
				'total' => $totalPrice
			]
		]);
	}

	public function savePayment(Request $request) {
		if (!$request->ajax()) {
			echo json_encode([
				'error' => [
					'message' => "Bad request"
				]
			]);
			return;
		}

		$authKey = base64_decode($request->header('Authorization'));
		if (!Auth::loginUsingId($authKey)) {
			echo json_encode([
				'error' => [
					'message' => "Bad auth"
				]
			]);
			return;
		}

		$cartId = Auth::user()->cart_id;

		// Confirm payment
		// DB::table('transactions')->insert([
		// 	''
		// ]);
	}
}
