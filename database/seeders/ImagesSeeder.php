<?php

namespace Database\Seeders;

use App\Models\ItemImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("item_images")->insert([
            [
                'item_id' => 3,
                'filename' => 'sweatshirt_black_0'
            ],
            [
                'item_id' => 3,
                'filename' => 'sweatshirt_black_1'
            ],
            [
                'item_id' => 3,
                'filename' => 'sweatshirt_black_2'
            ]
        ]);
    }
}
