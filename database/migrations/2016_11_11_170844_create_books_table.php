<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('book_id');
            $table->string('book_title');
            $table->string('book_description');
            $table->integer('author_id')->unsigned();
            $table->integer('publisher_id')->unsigned();
            $table->integer('edition_id')->unsigned();
            $table->integer('assigned');
            $table->integer('in_stock');
            $table->integer('buy_price');
            $table->integer('sale_price');
            $table->string('book_cover')->nullable();
            $table->timestamps();
            $table->foreign('author_id')->references('author_id')->on('authors')
            ->onDelete('cascade');
            $table->foreign('publisher_id')->references('publisher_id')->on('publishers')
            ->onDelete('cascade');
            $table->foreign('edition_id')->references('edition_id')->on('editions')
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
        Schema::dropIfExists('books');
    }
}
