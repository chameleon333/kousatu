<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      #htmlデータから記事投稿に使用する
      $path = dirname(__FILE__).'/data/*.html';
      $article_paths = File::glob($path);

      for ($i = 1; $i <= 10; $i++){
        #body用データ読み込み
        $body = file_get_contents($article_paths[$i-1]);
        $title = basename($article_paths[$i-1],'.html');
        Article::create([
          'user_id' => $i,
          'header_image'  => '/storage/header_image/header_image'.$i.'.jpeg',
          'title' => $title,
          'body' => $body,
          'status' => 0,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
      
    }
}
