<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarExteriorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_exteriors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('car_id');
            $table->text('wheels_tyres')->nullable();
            $table->text('bodywork')->nullable();
            $table->text('paint')->nullable();
            $table->text('glass_trim')->nullable();
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
        Schema::dropIfExists('car_exteriors');
    }
}
