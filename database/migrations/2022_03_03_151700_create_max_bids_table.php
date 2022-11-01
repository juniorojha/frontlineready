<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaxBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('max_bids', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('car_id');
            $table->bigInteger('user_id');
            $table->double('amount')->nullable();
            $table->bigInteger('statua')->default(0);
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
        Schema::dropIfExists('max_bids');
    }
}
