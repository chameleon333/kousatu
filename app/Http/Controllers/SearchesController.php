<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Search;
use App\Models\Tag;

class SearchesController extends Controller
{
    //
    public function index(Request $request, Article $article,Tag $tag)
    {
        $keyword = $request->input("keyword");

        if(!empty($keyword)) {
            #記事タイトルから検索
            $articles = Article::where('title', 'LIKE', '%'.$keyword.'%')->paginate(5);
        }
        $popular_tags = $tag->getPopularTags();
        return view('search.index', [
            'search_articles' => $articles,
            'popular_tags' => $popular_tags,
        ]);
    }
}
