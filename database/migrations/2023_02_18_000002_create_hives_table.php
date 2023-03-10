<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->integer('total_bees');
            $table->integer('present_bees');
            $table->integer('infected_bees');
            $table->string('tempreture');
            $table->string('humidity');
            $table->enum('status', ['working', 'down'])->default('working');
            $table->unsignedBigInteger('beekeeper_id');

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
        Schema::dropIfExists('hives');
    }
};
