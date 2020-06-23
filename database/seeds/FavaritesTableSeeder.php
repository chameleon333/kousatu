<?php

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavaritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      for($i = 0; $i <= 9; $i++){
        Favorite::create([
        'user_id' => 3,
        'article_id' => 11+$i,
        ]);
      }

      for($i = 2; $i <= 10; $i++){
        Favorite::create([
          'user_id' => 1,
          'article_id' => $i,
        ]);
        Favorite::create([
          'user_id' => $i,
          'article_id' => 2,
        ]);
      }
    }
}
