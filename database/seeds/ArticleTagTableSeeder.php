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
      $articles = [
        1 => [1,2,5], 2 => [1,6],
        3 => [1,7], 4 => [1,7], 
        4 => [1,8], 5 => [1,9], 
        6 => [1,10], 7 => [1,11], 
        8 => [1,12], 9 => [1,2,3,13], 
        10 => [1,14]
      ];

      foreach($articles as $article_id => $tag_ids) {
        foreach($tag_ids as $tag_id) {
          ArticleTag::create([
            'article_id' => $article_id,
            'tag_id' => $tag_id,
          ]);
        }
      };
    }
}
