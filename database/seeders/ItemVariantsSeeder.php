<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemVariantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("item_variants")->insert([
			[ 'item_id' => 1, 'variant_name' => 'S', 'is_available' => true ],
			[ 'item_id' => 1, 'variant_name' => 'M', 'is_available' => true ],
			[ 'item_id' => 1, 'variant_name' => 'L', 'is_available' => true ],
			[ 'item_id' => 1, 'variant_name' => 'XL', 'is_available' => false ],

			[ 'item_id' => 3, 'variant_name' => 'XS', 'is_available' => true ],
			[ 'item_id' => 3, 'variant_name' => 'S', 'is_available' => true ],
			[ 'item_id' => 3, 'variant_name' => 'M', 'is_available' => false ],
			[ 'item_id' => 3, 'variant_name' => 'L', 'is_available' => true ],
			[ 'item_id' => 3, 'variant_name' => 'XL', 'is_available' => false ]
		]);
    }
}
