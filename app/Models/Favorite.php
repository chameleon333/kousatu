<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

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
}
