<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->dropIndex(['zoo']);
            $table->dropColumn('zoo');
        });

        $now = Carbon::now();

        if (DB::table('roles')->count() > 0) {
            DB::table('roles')->insertOrIgnore([
                [
                    'name' => 'editor',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);
        }

        DB::table('roles')->whereIn('name', ['zooAdmin', 'zooMember'])->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->unsignedTinyInteger('zoo')->nullable()->after('user_id');
            $table->index('zoo');
        });

        $now = Carbon::now();

        DB::table('roles')->insertOrIgnore([
            [
                'name' => 'zooAdmin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'zooMember',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
        DB::table('roles')->where('name', '=', 'editor')->delete();
    }
}
