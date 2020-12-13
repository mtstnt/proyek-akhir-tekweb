<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("carts", function(Blueprint $table) {
    //        $table->unsignedBigInteger("variant_id");
  //          $table->foreign("variant_id")->references("id")->on("item_variants")->onDelete("cascade");
//            $table->dropIndex("carts_cart_id_unique");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("carts", function(Blueprint $table) {
            $table->dropForeign("carts_variant_id_foreign");
            $table->dropColumn("variant_id");
        });       
    }
}
