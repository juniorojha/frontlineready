<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_infos', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('make_id')->nullable();
            $table->string('model');
            $table->string('variant');
            $table->bigInteger('year');
            $table->string('mileage');
            $table->string('gearbox');
            $table->enum('steering_position', ['1', '2'])->comment("1=>LHD,2=>RHD")->default(1);
            $table->string('engine_size');
            $table->string('color');            
            $table->string('chassis_no');
            $table->string('former_keepers');
            $table->bigInteger('country_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->enum('is_auction', ['0', '1'])->comment("0=>no,1=>yes")->default(0);
            $table->enum('seller_type', ['1', '2'])->comment("2=>private,1=>dealer")->default(1);
            $table->text('description');
            $table->string('currency');
            $table->bigInteger('current_bid_id')->nullable();
            $table->date('auction_start_datetime')->nullable();
            $table->date('auction_end_datetime')->nullable();
            $table->double('price')->nullable();
            $table->double('reserve_price')->nullable();
            $table->enum('is_approve', ['0', '1'])->comment("0=>no,1=>yes")->default(0);
            $table->enum('status', ['1', '2','3','4'])->comment("1=>live,2=>comming,3=>buy_now,4=>sold")->default(1);
            $table->bigInteger('is_sold')->comment("0=>no,1=>yes")->default(0);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('car_infos');
    }
}
