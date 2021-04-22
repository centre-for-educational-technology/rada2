<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatitudeAndLongitudeToExternalImageResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('external_image_resources', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable()->after('id');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');

            $table->index('latitude');
            $table->index('longitude');
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('external_image_resources', function (Blueprint $table) {
            $table->dropIndex(['latitude']);
            $table->dropIndex(['longitude']);
            $table->dropIndex(['latitude', 'longitude']);

            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
