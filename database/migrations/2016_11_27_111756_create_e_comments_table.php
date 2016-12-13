<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateECommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_comments', function (Blueprint $table) {
            $table->increments('e_comment_id');
            $table->integer('e_book_id')->unsigned();
            $table->string('email');
            $table->text('comment');
            $table->integer('rating');
            $table->timestamps();
            $table->foreign('e_book_id')->references('e_book_id')->on('e_books')
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
        Schema::dropIfExists('e_comments');
    }
}
