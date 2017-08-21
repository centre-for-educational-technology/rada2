<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSwedishLanguageCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $code = 'swe';
        $update = ['language' => 'sv'];

        if ( DB::table('activities')->where('language', $code)->count() > 0 )
        {
            DB::table('activities')
                ->where('language', $code)
                ->update($update);
        }

        if  ( DB::table('activity_items')->where('language', $code)->count() > 0)
        {
            DB::table('activity_items')
                ->where('language', $code)
                ->update($update);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This is a fix, nothing to reverse
    }
}
