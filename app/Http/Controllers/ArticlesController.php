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
    public function index(Article $articles, Follower $follower, User $user)
    {
      $login_user = auth()->user();
    //   $follow_ids = $follower->followingIds($login_user->id);
      
    //   // followed_idだけ抜き出す
    //   $following_ids = $follow_ids->pluck('followed_id')->toArray();
      $user_ids = $user->pluck('id')->toArray();
      
      $timelines = $articles->getTimeLines($login_user->id, $user_ids);
      
      return view('articles.index', [
        'user' => $login_user,
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
        $users = auth()->user();
        $user = auth()->user();
        $article = $article->getArticle($article->id);
        $comments = $comment->getComments($article->id);
        return view('articles.show',[
            'user' => $user,
            'article' => $article,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $user = auth()->user();
        $articles = $article->getEditArticle($user->id, $article->id);

        if(!isset($articles)) {
            return redirect('articles');
        }
        
        return view('articles.edit', [
            'user' => $user,
            'articles' => $articles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            // 'title' => ['required', 'string', 'max:30'],
            'body' => ['required', 'string', 'max:1'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $validator->validate();
        $article->articleUpdate($article->id, $data);

        return redirect('articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $user = auth()->user();
        $article->articleDestroy($user->id, $article->id);
        return back();
    }
}
