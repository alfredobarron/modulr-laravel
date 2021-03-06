<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('video')->nullable();
            $table->integer('type'); // 1.Text, 2.Image, 3.Video
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->json('likes');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('news_images', function (Blueprint $table) {
            $table->increments('id');
            $table->text('basename')->nullable();
            $table->integer('news_id')->unsigned();
            $table->foreign('news_id')->references('id')->on('news');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_images');
        Schema::dropIfExists('news');
    }
}
