<?php

use Illuminate\Database\Seeder;
use App\Models\Article_stock;

class Article_stockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i = 2; $i <= 10; $i++){
        Article_stock::create([
          'user_id' => 1,
          'article_id' => $i,
        ]);
      }
    }
}
