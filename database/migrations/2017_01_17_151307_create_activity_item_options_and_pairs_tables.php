<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityItemOptionsAndPairsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_item_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('option');
            $table->boolean('correct');
            $table->string('image')->nullable();
            $table->unsignedInteger('activity_item_id');
            $table->timestamps();

            $table->foreign('activity_item_id')
                ->references('id')
                ->on('activity_items')
                ->onDelete('cascade');
        });

        Schema::create('activity_item_pairs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('option');
            $table->string('image')->nullable();
            $table->string('option_match');
            $table->string('image_match')->nullable();
            $table->unsignedInteger('activity_item_id');
            $table->timestamps();

            $table->foreign('activity_item_id')
                ->references('id')
                ->on('activity_items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_item_options');
        Schema::dropIfExists('activity_item_pairs');
    }
}
