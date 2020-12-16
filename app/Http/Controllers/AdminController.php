<?php

namespace App\Http\Controllers;

use App\Models\ItemImages;
use App\Models\ItemVariant;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {

		return view('admin/index', [
			'title' => 'Dashboard'
		]);
	}

	public function list() {
		// Raw db, aman seharusnya karena tdk ada user input

		// select items.id, items.item_name, items.price, items.updated_at, sum(stock) from items join item_variants on items.id = item_variants.item_id group by items.id

		$res = DB::table('items')->select(['items.id', 'item_variants.stock', 'items.item_name', 'items.price', 'items.updated_at', 'item_variants.variant_name'])->join('item_variants', "items.id", "=", "item_variants.item_id")->get();

		return view('admin/storage', [
			'title' => 'Storage list',
			'items' => $res,
			'i' => 0
		]);
	}

	public function orders() {

		$transactions = DB::table("transactions")->select([
			'users.first_name', 'users.last_name', 'transactions.*'
		])
			->join('users', 'users.id', '=', 'transactions.user_id')
			->get();

		return view('admin/orders', [
			'title' => 'Orders',
			'transactions' => $transactions
		]);
	}

	public function viewOrder($id) {
		$result = DB::table("transactions")->select([
			'items.item_name', 'items.price', 'transactions.*', 'carts.count', 'item_variants.variant_name'
		])
		->join('carts', 'carts.cart_id', '=', 'transactions.cart_id')
		->join('items', 'items.id', '=', 'carts.item_id')
		->join('item_variants', 'item_variants.id', '=', 'carts.variant_id')
		->where('transactions.cart_id', '=', $id)
		->get();

		$sum = 0;
		foreach ($result as $r) {
			$sum += $r->price * $r->count;
		}

		return view('admin/vieworder', [
			'title' => "Orders : " . $id,
			'items' => $result,
			'total' => $sum
		]);
	}

	public function completeOrder(Request $request) {
		if (!$request->ajax()) {
			echo "FAILED NOT AJAX";
			return;
		}

		$authID = base64_decode($request->header("Authorization"));
		if (!Auth::loginUsingId($authID)) {
			echo "FAILED NOT LOGGED IN";
			return;
		}

		if (Auth::user()->role != 1) {
			echo "FAILED NOT ADMIN";
			return;
		}

		$id = $request->json()->get('id');
		if ($id == null) {
			echo "FAILED NO ID";
			return;
		}

		if (!DB::table("transactions")->where('id', '=', $id)->update([
			'status' => "Completed"
		])) {
			echo "FAILED UPDATE";
			return;
		}

		$countOfItems = DB::table('carts')
			->select('carts.count', 'carts.variant_id', 'item_variants.stock')
			->join('item_variants', 'item_variants.id', '=', 'carts.variant_id')
			->join('transactions', 'carts.cart_id', '=', 'transactions.cart_id')
			->where('transactions.id', '=', $id)->get();
		
		foreach ($countOfItems as $c) {
			DB::table('item_variants')->where('id', '=', $c->variant_id)
				->update([
					'stock' => $c->stock - $c->count
				]);
		}

		echo "OK";
	}

	public function cancelOrder(Request $request) {
		if (!$request->ajax()) {
			echo "FAILED";
			return;
		}

		$authID = base64_decode($request->header("Authorization"));
		if (!Auth::loginUsingId($authID)) {
			echo "FAILED";
			return;
		}

		if (Auth::user()->role != 1) {
			echo "FAILED";
			return;
		}
		$id = $request->json()->get('id');
		if ($id == null) {
			echo "FAILED";
			return;
		}

		if (!DB::table("transactions")->where('id', '=', $id)->update([
			'status' => "Cancelled"
		])) {
			echo "FAILED!";
			return;
		}

		echo "OK";
	}

	public function addItemForm() {

		return view('admin/add-item', [
			'title' => 'Add Item Form'
		]);
	}

	// Function utk save data dari addItemForm
	public function addItem(Request $request) {
		$request->validate([
			'input-item-name' => 'bail|unique:items,item_name|required',
			'input-price' => 'required',
		]);

		$item = new ShopItem();
		$item->item_name = $request->input('input-item-name');
		$item->price = $request->input('input-price');
		$item->item_description = $request->input('input-description');
		$item->category_id = $request->input('input-category');
		
		if (!$item->save()) {
			session()->flash("error", "Error saving new item");
			return redirect()->route('admin/list/add-item');
		}

		for ($i = 0; $i < $request->input('img-number'); $i++) {

			$uniqueFilename = uniqid();
			$file = $request->allFiles()['input-file-' . $i];

			$itemImage = new ItemImages();
			$itemImage->item_id = $item->id;
			$itemImage->filename = $uniqueFilename . '.' . $file->extension();

			$path = $file->storeAs('public/store/', $itemImage->filename);
			
			if (!$itemImage->save()) {
				session()->flash("error", "Error saving image!");
				return redirect()->route('admin/list/add-item');
			}
		}

		for ($i = 0; $i < $request->input('variant-number'); $i++) {
			$itemVariant = new ItemVariant();
			$itemVariant->item_id = $item->id;
			$itemVariant->variant_name = $request->input('variant-name-' . $i);
			$itemVariant->stock = $request->input('variant-stock-' . $i);

			if (!$itemVariant->save()) {
				session()->flash("error", "Error saving variant!");
				return redirect()->route('admin/list/add-item');
			}
		}

		session()->flash("success", "Successfully added item!");
		return redirect()->route('admin/list/add-item');
	}

	public function deleteItem($id) {
		if (ShopItem::where('id', '=', $id)->delete()) {
			echo json_encode([
				'status' => "success"
			]);
		} else {
			echo json_encode([
				'status' => "failure"
			]);
		}
	}
}

