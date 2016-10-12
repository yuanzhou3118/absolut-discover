<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousePartyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_party_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid',100);
            $table->string('city',20)->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('username',50)->nullable();
            $table->string('birthday',50);
            $table->string('party_name',50)->nullable();
            $table->string('utm_source',50)->nullable();
            $table->string('utm_medium',50)->nullable();
            $table->string('theme',50)->nullable();
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
        Schema::drop('house_party_users');
    }
}
