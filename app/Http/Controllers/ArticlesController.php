<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Article;
use App\Models\Tag;
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

    public function fetch(Article $article)
    {
        $status_id = 0;
        $timelines = Article::with(['user','tags','favorites'])->where('status', $status_id)->orderBy('created_at', 'DESC')->paginate(6);
        return $timelines;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article, Tag $tags)
    {
        $status_id = 0;
        $timelines = $article->getTimeLines($status_id);
        $popular_tags = $tags->getPopularTags();
        return view('articles.index', [
            'articles' => $timelines,
            'popular_tags' => $popular_tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Article $article)
    {
        $article_status_texts = $article->getPostArticleStatusTexts();
        $user = auth()->user();
        return view('articles.create',[
            'user' => $user,
            'article_status_texts' => $article_status_texts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article, Tag $tag)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data,[
            'title' => ['string', 'max:30'],
            'body' => ['string', 'max:20480'],
            'image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:20480']
        ]);
        
        $validator->validate();
        // 画像のみの投稿の処理
        if(isset($data["image"]))
        {
            $image = Storage::disk('s3')->putFile('/article_images', $data["image"], 'public');
            $image_path = Storage::disk('s3')->url($image);
            return $image_path;
        } 
        // 記事を投稿する際の処理
        elseif(isset($data["title"]) && isset($data["body"])) 
        {
            // dump($data);
            if(!isset($data["binary_image"])){
                $data["binary_image"] = "/images/etc/default-header-image.png";
            } else {
                $img = $data["binary_image"];
                $fileData = base64_decode($img);
                $fileName = '/tmp/header_image.png';
                file_put_contents($fileName, $fileData);

                $image = Storage::disk('s3')->putFile('/header_images', $fileName, 'public');
                $data["binary_image"] = Storage::disk('s3')->url($image);
            }
            $article->articleStore($user->id, $data);
            if(isset($data["tags"])) {
                $tag->tagStore($data["tags"]);
                $tag_ids = $tag->getTagIds($data["tags"]);
                $article->articleTagSync($tag_ids);    
            }
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
        $article_status_texts = $article->getPostArticleStatusTexts();
        $user = auth()->user();
        $articles = $article->getEditArticle($user->id, $article->id);
        
        if(!isset($articles)) {
            return redirect('articles');
        }
        $tags = [];
        foreach($article->tags as $tag){
            $tags[] = $tag;
        }
        return view('articles.edit', [
            'user' => $user,
            'articles' => $articles,
            'tags'=>$tags,
            'article_status_texts' => $article_status_texts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article, Tag $tag)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            'title' => ['required', 'string', 'max:30'],
            'body' => ['string', 'max:20480'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $validator->validate();
        $article->articleUpdate($article->id, $data);

        #カテゴリ名の重複登録を防ぐ
        $storedTagNames = $tag->whereIn('name',$data["tags"])->pluck('name');
        $newTagNames = array_diff($data["tags"],$storedTagNames->all());

        $tag->tagStore($newTagNames);
        $tag_ids = $tag->getTagIds($data["tags"]);
        $article->articleTagSync($tag_ids);

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
