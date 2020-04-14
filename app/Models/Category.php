<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public $timestamps = false;

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function categoryStore(Array $_category_names)
    {
        #すでにタグ名が登録されている場合、スキップする
        foreach($_category_names as $category_name){
            $category_names[] = ['name' => $category_name];
        }
        DB::table('categories')->insertOrIgnore($category_names);
    }

    public function getCategoryIds($category_names){
        foreach($category_names as $category_name){
            $category_id = $this::select('id')->where("name",$category_name)->first();
            $category_ids[] = $category_id->id;
        }
        return $category_ids;
    }
}
