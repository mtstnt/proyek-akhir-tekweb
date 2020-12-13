<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCardIdForeignToCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
			// $table->dropColumn("cart_id");
			// $table->string("cart_id");
			$table->foreign("cart_id")->references("cart_id")->on("carts_list")->onDelete("Cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
			$table->dropForeign("carts_cart_id_foreign");
			$table->dropColumn("cart_id");
			$table->string("cart_id")->unique();
        });
    }
}
