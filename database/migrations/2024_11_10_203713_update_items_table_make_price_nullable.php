<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateItemsTableMakePriceNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            // Make the price column nullable
            $table->decimal('price', 8, 2)->nullable()->change(); // Adjust decimal length if necessary
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            // Make the price column non-nullable if rolling back
            $table->decimal('price', 8, 2)->nullable(false)->change();
        });
    }
}
