<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('article_id');
            $table->timestamps();
          
            $table->foreign('user_id')
              ->references('user_id')
              ->on('users')
              ->onDelete('cascade')
              ->onUpdate('cascade');

            $table->foreign('article_id')
              ->references('article_id')
              ->on('articles')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
