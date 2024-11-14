<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameReceivedAndCollectedColumnsInTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename the columns
        Schema::table('transactions', function (Blueprint $table) {
            // Check if the columns exist before renaming
            if (Schema::hasColumn('transactions', 'received_at')) {
                $table->renameColumn('received_at', 'received_date');
            }
            if (Schema::hasColumn('transactions', 'pickup_date')) {
                $table->renameColumn('pickup_date', 'pickup_date');
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
        // Revert the column names back to the original ones
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'received_date')) {
                $table->renameColumn('received_date', 'received_date');
            }
            if (Schema::hasColumn('transactions', 'pickup_date')) {
                $table->renameColumn('pickup_date', 'pickup_date');
            }
        });
    }
}
