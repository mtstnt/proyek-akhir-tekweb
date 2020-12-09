<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterItemsNoStockAndVariantAddStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function(Blueprint $table) {
			$table->dropColumn('item_image');
		});

		Schema::table('item_variants', function(Blueprint $table) {
			$table->unsignedInteger('stock');
			$table->dropColumn('is_available');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		// 
    }
}
