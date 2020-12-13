<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCartIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create("carts_list", function(Blueprint $table) {
			$table->id();
			$table->string("cart_id")->unique();
			$table->boolean("is_used")->default(false);
		});

		Schema::table("users", function(Blueprint $table) {
			$table->string("cart_id")->nullable()->default(null);
			$table->foreign("cart_id")->references("cart_id")->on("carts_list")->onDelete("cascade");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table("users", function(Blueprint $table) {
			$table->dropForeign("users_cart_id_foreign");
			$table->dropColumn("cart_id");
		});

		Schema::table("carts", function(Blueprint $table) {
			$table->dropForeign("carts_cart_id_foreign");
			$table->unique("cart_id");
		});

		Schema::dropIfExists("carts_list");
    }
}
