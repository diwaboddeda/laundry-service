<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            // Only add the user_id column if it doesn't exist
            if (!Schema::hasColumn('items', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                
                // Define the foreign key constraint
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
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
            // Drop the foreign key constraint first
            if (Schema::hasColumn('items', 'user_id')) {
                $table->dropForeign(['user_id']);
                // Then drop the user_id column
                $table->dropColumn('user_id');
            }
        });
    }
}
?>