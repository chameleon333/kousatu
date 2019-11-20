<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//      DB::table('articles')->insert([
//        [
//          'title' => 'タイトル1',
//          'body' => '内容1'
//        ],
//        [
//          'title' => 'タイトル2',
//          'body' => '内容2'
//        ],
//        [
//          'title' => 'タイトル3',
//          'body' => '内容3'
//        ],
//      ]);
      
      for ($i = 1; $i <= 10; $i++){
        Article::create([
          'user_id' => $i,
          'text' => 'これはテスト投稿'. $i,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
      
    }
}
