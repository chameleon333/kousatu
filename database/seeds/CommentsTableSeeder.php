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
        Comment::create([
            'user_id' => 2,
            'article_id' => 1,
            'text' => 'すばらしい考察です！',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        for ($i = 2; $i <= 10; $i++) {
            Comment::create([
                'user_id' => 1,
                'article_id' => $i,
                'text' => 'すばらしい考察です！',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
