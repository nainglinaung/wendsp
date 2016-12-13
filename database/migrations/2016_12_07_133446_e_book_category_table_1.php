<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EBookCategoryTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_book_category', function (Blueprint $table) {
            $table->integer('e_book_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();
            $table->foreign('e_book_id')->references('e_book_id')->on('e_books')
            ->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories')
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
Schema::dropIfExists('e_book_category');
    }
}
