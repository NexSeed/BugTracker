<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('articles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('system');
            $table->string('title');
            $table->string('type');
            $table->string('urgency');
            $table->text('body');
            $table->integer('likes_count')->unsigned();
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->integer('status_list_id')->unsigned();
            $table->timestamps();

            //外部キー
            $table->foreign('user_id')
            	->references('id')
            	->on('users')
            	->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('articles');
    }

}
