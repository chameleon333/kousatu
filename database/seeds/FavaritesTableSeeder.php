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
      for($i = 1; $i <= 10; $i++){
        Favorite::create([
          'account_id' => 'test_user'. $i,
          'article_id' => "記事".$i,
        ]);
      }
    }
}
