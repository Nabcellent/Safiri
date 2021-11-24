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
            $table->string('place_id')->nullable()->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('image')->nullable();
            $table->float('price');
            $table->string('rates', 20)->default('daily');
            $table->json('location')->nullable();
            $table->string('vicinity')->nullable();
            $table->json('availability')->nullable();
            $table->string('description')->nullable();
            $table->float('rating', 3, 1)->nullable();
            $table->string('website')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(true);
            $table->string('status_msg')->nullable();
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
