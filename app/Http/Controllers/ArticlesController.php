<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Follower;
use Carbon\Carbon;

class ArticlesController extends Controller
{
  
    public function __construct()
    {
//        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $articles, Follower $follower)
    {
      $user = auth()->user();
      $follow_ids = $follower->followingIds($user->id);
      
      // followed_idだけ抜き出す
      $following_ids = $follow_ids->pluck('followed_id')->toArray();
      
      $timelines = $articles->getTimelines($user->id, $following_ids);
      
      return view('articles.index', [
        'user' => $user,
        'timelines' => $timelines
      ]);
//      $articles = Article::all();
////      return $articles;
//      return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//      return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//      $article = new Article;
//      $time = Carbon::now()->toDateTimeString();
////      $article->title = $request->title;
//      $article->image_url = $request->image_url->storeAs('public/post_images',$time.'.jpg');
////      dd($article->image_url);
//      $article->title = $request->title;
//      $article->image_url = str_replace('public/', 'storage/',$article->image_url);
//      $article->body = $request->body;
//      $article->save();
//      return redirect('/articles');
////      return redirect()->route('articles.index', [
////        'image_url' => str_replace('public/', 'storage/',$article->image_url)
////      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article, Comment $comment)
    {
        $user = auth()->user();
        $article = $article->getArticle($article->id);
        $comments = $comment->getComments($article->id);

        return view('articles.show',[
            'user' => $user,
            'article' => $article,
            'comments' => $comments
        ]);
//      $article = Article::find($id);
//      return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//      $article = Article::find($id);
//      return view('articles.edit', ['article' => $article]);
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
//      $article = Article::find($id);
//      $article->title = $request->title;
//      $article->body = $request->body;
//      $article->save();
//      return redirect("/articles/".$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//      $article = Article::find($id);
//      $article->delete();
//      return redirect('/articles');
    }
}
