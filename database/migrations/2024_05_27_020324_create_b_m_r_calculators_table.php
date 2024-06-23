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
        Schema::create('b_m_r_calculators', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('age');
            $table->string('gender');
            $table->unsignedDouble('weight');
            $table->unsignedDouble('height');
            $table->string('result');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b_m_r_calculators');
    }
};