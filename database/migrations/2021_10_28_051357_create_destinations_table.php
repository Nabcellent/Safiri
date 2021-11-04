<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('destinations', function(Blueprint $table) {
            $table->id();
            $table->string('place_id')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('image');
            $table->float('price', '');
            $table->json('location');
            $table->string('vicinity')->nullable();
            $table->float('distance');
            $table->string('description')->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->string('website')->nullable();
            $table->boolean('active')->default(true);
            $table->string('active_msg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('destinations');
    }
}
