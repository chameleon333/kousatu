<?php

use Illuminate\Database\Seeder;
use App\Models\ArticleTag;

class ArticleTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($tag_num = 1; $tag_num <= 4; $tag_num++)
        for ($i = 1; $i <= 10; $i++){
            #body用データ読み込み
            ArticleTag::create([
              'article_id' => $i,
              'tag_id' => $tag_num,
            ]);
          }    
    }
}
