<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger("user_id");
			$table->string("cart_id");
			$table->double("total_price");
			$table->timestamp("transaction_time")->useCurrent();

			$table->foreign("user_id")->references("id")->on('users')->onDelete("cascade");
			$table->foreign("cart_id")->references("cart_id")->on('carts')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
}
