<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sports', function (Blueprint $table) {
            $table->dropColumn('five_minute_calories');
            $table->dropColumn('fifteen_minute_calories');
            $table->dropColumn('thirty_minute_calories');
            $table->dropColumn('one_hour_calories');
            $table->double('duration')->after('name');
            $table->string('calories_minutes')->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sports', function (Blueprint $table) {
        });
    }
};
