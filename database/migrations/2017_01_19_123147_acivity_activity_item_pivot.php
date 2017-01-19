<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcivityActivityItemPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_activity_item', function (Blueprint $table) {
            $table->unsignedInteger('activity_id');
            $table->unsignedInteger('activity_item_id');
            $table->unsignedTinyInteger('position');
            $table->timestamps();

            $table->primary(['activity_id', 'activity_item_id']);
            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade');
            $table->foreign('activity_item_id')
                ->references('id')
                ->on('activity_items')
                ->onDelete('cascade');
            $table->index('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_activity_item');
    }
}
