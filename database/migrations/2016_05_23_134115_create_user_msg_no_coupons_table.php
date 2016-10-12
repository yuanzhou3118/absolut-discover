<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMsgNoCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_msg_no_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid', 100);
            $table->string('name', 100);
            $table->string('mobile', 20);
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
        Schema::drop('user_msg_no_coupons');
    }
}
