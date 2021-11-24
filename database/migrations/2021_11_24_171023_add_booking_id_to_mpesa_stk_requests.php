<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingIdToMpesaStkRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('mpesa_stk_requests', function(Blueprint $table) {
            $table->foreignId('booking_id')->nullable()->after('id')->constrained()->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('mpesa_stk_requests', function(Blueprint $table) {
            $table->dropColumn('booking_id');
        });
    }
}
