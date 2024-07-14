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
        Schema::table('histories', function (Blueprint $table) {
            $table->string('result_bmr')->nullable()->after('duration');
            $table->string('result_bmi')->nullable()->after('duration');
            $table->unsignedDouble('weight')->nullable()->after('duration');
            $table->unsignedDouble('height')->nullable()->after('duration');
            $table->unsignedDouble('imt')->nullable()->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
            //
        });
    }
};
