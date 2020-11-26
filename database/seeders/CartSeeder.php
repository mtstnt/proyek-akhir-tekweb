<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run()
    {
        $cart = new Cart([
			'cart_id' => uniqid(),
			'user_id' => 1,
			'item_id' => 1,
			'stock' => 3
		]);

		$cart->save();
    }
}
