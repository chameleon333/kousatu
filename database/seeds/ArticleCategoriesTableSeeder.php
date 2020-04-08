<?php

use Illuminate\Database\Seeder;
use App\Models\ArticleCategory;

class ArticleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++){
            #body用データ読み込み
            ArticleCategory::create([
              'article_id' => $i,
              'category_id' => 1
            ]);
          }    
    }
}
