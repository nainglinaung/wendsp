<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->increments('pos_id');
            $table->integer('book_id')->unsigned();
            $table->integer('opening_quantity');
            $table->integer('opening_amount');
            $table->integer('receive_quantity');
            $table->integer('receive_amount');
            $table->integer('sale_quantity');
            $table->integer('sale_amount');
            $table->integer('return_quantity');
            $table->integer('return_amount');
            $table->integer('closing_quantity');
            $table->integer('closing_amount');
            $table->text('remark');
            $table->timestamps();
            $table->foreign('book_id')->references('book_id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos');
    }
}
