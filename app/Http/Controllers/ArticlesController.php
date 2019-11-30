<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        return view('articles.create',[
            'user' => $user
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data,[
            'body' => ['required', 'string', 'max:140'],
            'title' => ['required', 'string', 'max:30'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);
        $validator->validate();
        $article->ArticleStore($user->id, $data);

        return redirect('articles');
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
