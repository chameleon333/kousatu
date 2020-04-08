<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["小説","映画","漫画","ドラマ"];
        foreach($categories as $category){
            Category::create([
                'name' => $category,
            ]);
        }
  
    }
}
