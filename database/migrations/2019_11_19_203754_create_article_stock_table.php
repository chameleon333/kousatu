<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_id');
            $table->string('article_id');
            $table->timestamps();
          
            $table->foreign('account_id')
              ->references('account_id')
              ->on('accounts')
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
        Schema::dropIfExists('article_stock');
    }
}
