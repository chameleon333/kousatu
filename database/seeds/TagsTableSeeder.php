<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ["小説","映画","漫画","ドラマ"];
        foreach($tags as $tag){
            Tag::create([
                'name' => $tag,
            ]);
        }
  
    }
}
