<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('book_id')->unsigned();
            $table->string('email');
            $table->string('phonenumber');
            $table->string('address');
            $table->integer('amount');
            $table->integer('total');
            $table->boolean('on_the_way')->nullable();
            $table->boolean('delievered')->nullable();
            $table->timestamps();
            $table->foreign('book_id')->references('book_id')->on('books')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
