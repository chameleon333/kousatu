<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Article;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Favorite $favorite)
    {   

        $user = auth()->user();
        $article_id = $request->article_id;
        $is_favorite = $favorite->isFavorite($user->id, $article_id);
        if(!$is_favorite)
        {
            $favorite->storeFavorite($user->id, $article_id);
        }
        $favorited_count = $favorite->getFavoritedCount($article_id);
        $favorite_row = $favorite->getFavoriteRow($user->id, $article_id);
        
        $favorite_list = [
            "favorited_count" => $favorited_count,
            "favorite_id" => $favorite_row->id,
        ];  

        return $favorite_list;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        $user_id = $favorite->user_id;
        $article_id = $favorite->article_id;
        $favorite_id = $favorite->id;
        $is_favorite = $favorite->isFavorite($user_id, $article_id);
        if($is_favorite) {
            $favorite->destroyFavorite($favorite_id);
        }
        $favorited_count = $favorite->getFavoritedCount($article_id);
        $favorite_row = $favorite->getFavoriteRow($user_id, $article_id);

        if(isset($favorite_row)) {
            $favorite_id = $favorite_row->id;
        } else {
            $favorite_id = NULL;
        }

        $favorite_list = [
            "favorited_count" => $favorited_count,
            "favorite_id" => $favorite_id,
        ];

        return $favorite_list;
    }
}
