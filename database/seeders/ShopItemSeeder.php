<?php

namespace Database\Seeders;

use App\Models\ShopItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopItemSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
		$items = new ShopItem(
			[
				'item_name' => "Kemeja Polos",
				'stock' => 20,
				'price' => 10000,
				'category_id' => 1
			]
		);

		$items->save();

		$items = new ShopItem(
			[
				'item_name' => "Kaos Polos",
				'stock' => 10,
				'price' => 40000,
				'category_id' => 1
			]
		);

        $items->save();

		$items = new ShopItem(
			[
				'item_name' => "Sweatshirt Hitam",
				'stock' => 10,
				'price' => 75000,
				'category_id' => 1
			]
		);

		$items->save();
	}
}
