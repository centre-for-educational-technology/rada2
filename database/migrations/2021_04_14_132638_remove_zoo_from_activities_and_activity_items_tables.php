<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveZooFromActivitiesAndActivityItemsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropIndex(['zoo']);
            $table->dropColumn('zoo');
        });

        Schema::table('activity_items', function (Blueprint $table) {
            $table->dropIndex(['zoo']);
            $table->dropColumn('zoo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedTinyInteger('zoo')->nullable()->after('contact_information');
        });

        DB::table('activities')->update(['zoo' => 3,]);

        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedTinyInteger('zoo')->nullable(false)->change();
            $table->index('zoo');
        });

        Schema::table('activity_items', function (Blueprint $table) {
            $table->unsignedTinyInteger('zoo')->nullable()->after('embedded_content');
        });

        DB::table('activity_items')->update(['zoo' => 3,]);

        Schema::table('activity_items', function (Blueprint $table) {
            $table->unsignedTinyInteger('zoo')->nullable(false)->change();
            $table->index('zoo');
        });
    }
}
