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
        $tags = [
            "小説","映画","漫画","ドラマ","村上春樹","乙武洋匡",
            "遠藤周作","志賀直也","島崎藤村","坂口安吾","芥川龍之介",
            "浅田次郎","堀辰雄","井伏鱒二"
        ];
        foreach($tags as $tag){
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
}
