<?php

use Illuminate\Database\Migrations\Migration;

class AlterDestinationsTableAddFulltextIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('ALTER TABLE destinations ADD FULLTEXT fulltext_index(name, vicinity, description, website)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}
