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
      for ($i = 1; $i <= 10; $i++){
        Article::create([
          'user_id' => $i,
          'title' => 'これはテストタイトル'. $i,
          'body' => 'これはテスト投稿'. $i,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
      
    }
}
