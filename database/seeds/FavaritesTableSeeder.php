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
      for($i = 2; $i <= 10; $i++){
        Favorite::create([
          'user_id' => 1,
          'article_id' => $i,
        ]);
      }
    }
}
