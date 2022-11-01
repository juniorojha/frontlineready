<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_media', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('car_id');
            $table->enum('type', ['1', '2','3','4','5'])->comment("1=>Exterior,2=>Interior,3=>Mechanics,4=>History & Paperwork,5=>Video")->default(1);
            $table->string('media')->nullable();
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
        Schema::dropIfExists('car_media');
    }
}
