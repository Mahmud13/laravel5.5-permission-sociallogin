<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
                    $table->integer('country_id')->unsigned()->nullable()->after('email');
                    $table->integer('time_zone_id')->unsigned()->nullable()->after('country_id');
                    $table->string('gender', 10)->after('time_zone_id')->nullable();
                    $table->integer('age')->unsigned()->after('gender')->nullable();
                    $table->integer('occupation_id')->unsigned()->nullable()->after('age');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('time_zone_id');
            $table->dropColumn('gender');
            $table->dropColumn('age');
            $table->dropColumn('occupation_id');
        });

    }
}
