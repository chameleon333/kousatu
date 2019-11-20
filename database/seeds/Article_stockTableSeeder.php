<?php

use Illuminate\Database\Seeder;

class Article_stockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i = 2; $i <=10; $i){
        Favorite::create([
          'acocunt_id' => 1,
          'article_id' => $i
        ]);
      }
    }
}
