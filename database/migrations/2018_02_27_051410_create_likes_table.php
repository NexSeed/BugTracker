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
        //
        Schema::create('likes', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->timestamps();

            $table->foreign('article_id')
                  ->references('id')
                  ->on('articles')
                  ->onDelete('cascade');
            
            $table->foreign('user_id')
            	->references('id')
            	->on('users')
            	->onDelete('cascade');            
        });

                // 記事とライクの中間テーブル
        Schema::create('article_like', function(Blueprint $table)
        {
            $table->integer('article_id')->unsigned()->index();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            
            $table->integer('like_id')->unsigned()->index();
            $table->foreign('like_id')->references('id')->on('likes')->onDelete('cascade');

            $table->timestamps();

        });
                // ユーザとライクの中間テーブル
        Schema::create('user_like', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->integer('like_id')->unsigned()->index();
            $table->foreign('like_id')->references('id')->on('likes')->onDelete('cascade');

            $table->timestamps();

        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
                //
        Schema::drop('likes');
        Schema::drop('article_like');
        Schema::drop('user_like');
    }
}
