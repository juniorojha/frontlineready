<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarInteriorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_interiors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('car_id');
            $table->text('seats')->nullable();
            $table->text('dashboard')->nullable();
            $table->text('steering_wheel')->nullable();
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
        Schema::dropIfExists('car_interiors');
    }
}
