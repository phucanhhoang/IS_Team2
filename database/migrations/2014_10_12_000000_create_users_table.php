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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('name', 40);
            $table->string('address', 200);
            $table->string('district', 20);
            $table->string('city', 20);
            $table->string('phone', 11)->unique();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
//            $table->integer('userable_id')->unsigned();
//            $table->string('userable_type');
            $table->boolean('ban')->default(0);
//            $table->boolean('deleted')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
//
//        Schema::create('social_account', function (Blueprint $table) {
//            $table->integer('user_id');
//            $table->string('provider_user_id');
//            $table->string('provider');
//            $table->timestamps();
//        });
//
//
//
//        Schema::create('categories', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('cat_title');
//            $table->integer('parent_id');
//        });
//
//        Schema::create('products', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('pro_name')->unique();
//            $table->string('pro_code')->unique();
//            $table->integer('price');
//            $table->integer('discount');
//            $table->string('image');
//            $table->longText('short_des');
//            $table->longText('full_des');
//            $table->integer('cat_id')->unsigned();
//            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
//            $table->timestamps();
//        });
//
//        Schema::create('colors', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('color');
//        });
//
//        Schema::create('images', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('images');
//            $table->integer('pro_id')->unsigned();
//            $table->foreign('pro_id')->references('id')->on('products')->onDelte('cascade');
//            $table->integer('color_id')->unsigned();
//            $table->foreign('color_id')->references('id')->on('colors')->onDelte('cascade');
//        });
//
//        Schema::create('sizes', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('size');
//        });
//
//        Schema::create('proSizes', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('pro_id')->unsigned();
//            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
//            $table->integer('size_id')->unsigned();
//            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
//        });

//        Schema::create('proColors', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('pro_id')->unsigned();
//            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
//            $table->integer('color_id')->unsigned();
//            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
//        });

//        Schema::create('customers', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('username');
//            $table->string('address');
//            $table->string('district');
//            $table->string('city');
//            $table->integer('phone');
//            $table->timestamps();
//        });

//        Schema::create('cart', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('user_id')->unsigned()->nullable();
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->integer('product_id')->unsigned();
//            $table->foreign('product_id')->references('id')->on('products');
//            $table->integer('color_id')->unsigned();
//            $table->foreign('color_id')->references('id')->on('colors');
//            $table->integer('size_id')->unsigned();
//            $table->foreign('size_id')->references('id')->on('sizes');
//            $table->tinyInteger('quantity')->unsigned();
//            $table->rememberToken();
//            $table->timestamps();
//        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('total_money');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('orderDetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('pro_id')->unsigned();
            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->integer('size_id')->unsigned();
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->string('pro_name');
            $table->integer('price');
            $table->integer('qty'); //so luong
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
//        Schema::drop('users');
//        Schema::drop('social_account');
//        Schema::drop('customer');
//        Schema::drop('cart');
    }
}
