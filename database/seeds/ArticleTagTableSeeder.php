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
        10 => [1,14], 11 =>[1,15],
        12 => [1,11], 13 =>[1,16],
        14 => [23], 15 =>[1,17],
        16 => [1,18], 17 =>[1,19],
        18 => [1,20], 19 =>[1,21],
        20 => [1,22],
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
