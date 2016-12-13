<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_books', function (Blueprint $table) {
            $table->increments('e_book_id');
            $table->string('e_book_title');
            $table->string('e_book_description');
            $table->integer('author_id')->unsigned();
            $table->integer('publisher_id')->unsigned();
            $table->integer('edition_id')->unsigned();
            $table->string('e_book_cover')->nullable();
            $table->string('e_book_download');
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
        Schema::dropIfExists('e_books');
    }
}
