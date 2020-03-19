<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use App\Models\Article;

class SearchController extends Controller
{
    //
    public function index(Request $request, Article $article)
    {
        $keyword = $request->input("keyword");

        if(!empty($keyword)) {
            #記事タイトルから検索
            $articles = Article::where('title', 'LIKE', '%'.$keyword.'%')->paginate(5);
        }
        // dump($articles);
        return view('search.index', [
            'timelines' => $articles
        ]);
    }
}
