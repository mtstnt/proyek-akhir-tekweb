<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
	public function index()
	{
		return view("shop/index", [
			'title' => "Shop Catalog"
		]);
	}

	public function displayAll() {
		$items = ShopItem::all();
		return view('shop/display', [
			'title' => "Tokobaju",
			'items' => $items
		]);
	}

	public function viewItem($id) {

		if (!isset($id)) {
			session()->flash("error", "Item not found!");
			return redirect('catalog');
		}

		$item = ShopItem::where('id', '=', $id)-> get('*')->first();

		return view('shop/item', [
			'title' => $item->item_name,
			'item' => $item
		]);
	}
}
