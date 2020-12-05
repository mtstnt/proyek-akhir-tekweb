<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('items', function (Blueprint $table) 
		{
			$table->id();
			$table->string('item_name');
			$table->string('item_description')->nullable();
			$table->unsignedDouble('price');
			$table->unsignedInteger('stock');
			$table->unsignedBigInteger("category_id");
			$table->string("item_image")->nullable();

			$table->timestamps();

			$table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
