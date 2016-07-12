<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->morphs('userable');
            $table->boolean('ban')->default(0);
            $table->boolean('deleted')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('social_account', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('provider_user_id');
            $table->string('provider');
            $table->timestamps();
        });

        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('address', 200);
            $table->string('district', 20);
            $table->string('city', 20);
            $table->string('phone', 11)->unique();
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
        Schema::drop('users');
        Schema::drop('customer');
    }

}
