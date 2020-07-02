<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    //いいねしているかどうかの判定処理
    public function isFavorite(Int $user_id, Int $article_id)
    {
        return (boolean) $this->where('user_id', $user_id)->where('article_id', $article_id)->first();
    }

    public function storeFavorite(Int $user_id, Int $article_id)
    {
        $this->user_id = $user_id;
        $this->article_id = $article_id;
        $this->save();

        return;
    }

    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }

    public function getTotalFavoritedCount(Int $user_id){
        $article = new Article; 
        $article_ids = $article::all()->where('user_id',$user_id)->pluck('id');
        
        $total_favorited_count = count($this->whereIn('article_id',$article_ids)->get());
        return $total_favorited_count;
    }

    public function getFavoritedCount(Int $article_id) {
        $favorited_count = count($this->where('article_id', $article_id)->get());
        return $favorited_count;
    }

    public function getFavoriteRow(Int $user_id, Int $article_id) {
        $favorite_row = $this->where([
            ['article_id', $article_id],
            ["user_id", $user_id],
        ])->first();

        return $favorite_row;
    }
}
