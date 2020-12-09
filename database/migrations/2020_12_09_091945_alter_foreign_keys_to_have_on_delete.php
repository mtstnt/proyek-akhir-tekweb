<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterForeignKeysToHaveOnDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// Delete constraint, add ondelete
        Schema::table('item_images', function(Blueprint $table) {
			$table->dropForeign("item_images_item_id_foreign");
			$table->foreign("item_id")->references("id")->on("items")->onDelete("cascade");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
