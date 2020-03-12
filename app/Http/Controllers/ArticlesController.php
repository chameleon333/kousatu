<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Follower;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
    public function index(Article $articles)
    {
        $timelines = $articles->getTimeLines();

        return view('articles.index', [
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
        $data["article"] = $article;
        $validator = Validator::make($data,[
            'title' => ['string', 'max:30'],
            'image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:20480']
        ]);
        
        $validator->validate();
        // 画像のみの投稿の処理
        if(isset($data["image"]))
        {
            $image = Storage::disk('s3')->putFile('/post_images', $data["image"], 'public');
            $image_path = Storage::disk('s3')->url($image);
            return $image_path;
        } 
        // 記事を投稿する際の処理
        elseif(isset($data["title"]) && isset($data["body"])) 
        {
            $article->ArticleStore($user->id, $data);
            return redirect('articles');
        }
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
        // dd($articles->body);
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
            'title' => ['required', 'string', 'max:30'],
            // 'body' => ['required', 'string', 'max:150'],
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
    public function destroy(Article $article, Request $request)
    {
        $user = auth()->user();
        $article->articleDestroy($user->id, $article->id);
        $redirect = $request->input('redirect');

        if ($redirect == "on") {
            return redirect('/');
        } else {
            return back();
        }
    }
}
