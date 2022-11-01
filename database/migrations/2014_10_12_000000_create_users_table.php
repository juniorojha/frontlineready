<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //username,country,phone,email,password,image
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('user_type', ['0', '1'])->comment("0=>user,1=>admin")->default(0);
            $table->enum('promotions_email_notification', ['0', '1'])->comment("0=>no,1=>yes")->default(0);
            $table->enum('trade_news_email_notification', ['0', '1'])->comment("0=>no,1=>yes")->default(0);
            $table->enum('outbid_sms_notification', ['0', '1'])->comment("0=>no,1=>yes")->default(0);
            $table->enum('watcher_comment_notification', ['0', '1'])->comment("0=>no,1=>yes")->default(0);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
