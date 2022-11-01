<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarMechanicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_mechanics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('car_id');
            $table->text('engine_gearbox')->nullable();
            $table->text('suspension_brakes')->nullable();
            $table->text('the_drive')->nullable();
            $table->text('electrics')->nullable();
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
        Schema::dropIfExists('car_mechanics');
    }
}
