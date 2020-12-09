<?php

namespace App\Http\Controllers;

use App\Models\ItemImages;
use App\Models\ItemVariant;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {

		return view('admin/index', [
			'title' => 'Dashboard'
		]);
	}

	public function list() {

		return view('admin/storage', [
			'title' => 'Storage list'
		]);
	}

	public function orders() {

		return view('admin/orders', [
			'title' => 'Orders'
		]);
	}

	public function addItemForm() {

		return view('admin/add-item', [
			'title' => 'Add Item Form'
		]);
	}

	public function addItem(Request $request) {
		// dd($request->allFiles()['input-file-0']->extension());
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
}
