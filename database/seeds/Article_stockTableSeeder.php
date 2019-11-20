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
      for($i = 1; $i <= 10; $i++){
        Article_stock::create([
          'account_id' => 'test_user'. $i,
          'article_id' => "記事".$i,
        ]);
      }
    }
}
