<?php

use Illuminate\Database\Seeder;
use App\Models\ArticleCategory;

class ArticleCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($category_num = 1; $category_num <= 4; $category_num++)
        for ($i = 1; $i <= 10; $i++){
            #body用データ読み込み
            ArticleCategory::create([
              'article_id' => $i,
              'category_id' => $category_num,
            ]);
          }    
    }
}
