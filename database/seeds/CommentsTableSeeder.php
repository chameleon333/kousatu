<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Comment::create([
                'user_id' => 'test_user'. $i,
                'article_id' => "記事".$i,
                'text' => 'これはテストコメント' .$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
