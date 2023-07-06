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
        natcasesort($article_paths);
        $article_paths = array_values($article_paths);
        for ($i = 1; $i <= 10; $i++) {
            #body用データ読み込み
            $body = file_get_contents($article_paths[$i-1]);
            $title = basename($article_paths[$i-1], '.html');
            $title = preg_replace("@\d.*_@", "", $title);
            Article::create([
          'user_id' => $i,
          'header_image'  => '/images/header_image/header_image'.$i.'.jpeg',
          'title' => $title,
          'body' => $body,
          'status' => 0,
          'created_at' => now()->addSeconds($i),
          'updated_at' => now()->addSeconds($i),
        ]);
        }

        for ($i = 11; $i <= 20; $i++) {
            $status=0;
            if ($i >= 18) {
                $status = 1;
            }
            #body用データ読み込み
            $body = file_get_contents($article_paths[$i-1]);
            $title = basename($article_paths[$i-1], '.html');
            $title = preg_replace("@\d.*_@", "", $title);

            Article::create([
          'user_id' => 1,
          'header_image'  => '/images/header_image/header_image'.$i.'.jpg',
          'title' => $title,
          'body' => $body,
          'status' => $status,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        }
    }
}
