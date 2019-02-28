<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('news_id')->unsigned();
            $table->timestamps();

            // $table->foreign('user_id')
            //       ->references('id')
            //       ->on('users')
            //       ->onDelete('cascade'); // userが削除されたとき、それに関連するlikeも一気に削除される

            $table->foreign('news_id')
                  ->references('id')
                  ->on('news')
                  ->onDelete('cascade'); // postが削除されたとき、それに関連するlikeも一気に削除される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('likes');
    }
}
