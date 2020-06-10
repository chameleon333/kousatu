<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    public $timestamps = false;

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function tagStore(Array $_tag_names)
    {
        #すでにタグ名が登録されている場合、登録しない
        if(!empty($_tag_names)) {
            foreach($_tag_names as $tag_name){
                $tag_names[] = ['name' => $tag_name];
            }
            DB::table('tags')->insertOrIgnore($tag_names);
        }
    }    

    public function getTagIds($tag_names){
        foreach($tag_names as $tag_name){
            $tag_id = $this::select('id')->where("name",$tag_name)->first();
            $tag_ids[] = $tag_id->id;
        }
        return $tag_ids;
    }

    public function getPopularTags(){
        $popular_tags = $this::withCount([ 'articles' => function($query) {
            $query->where('status',0);
        }])
        ->orderBy('articles_count', 'desc')
        ->take(5)
        ->get();
        return $popular_tags;
    }
}
