
@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mb-3 text-right">
      <a href="{{ url('users') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
    </div>

    <div class="row col-md-12">
    
      <div class="col-md-9 mb-3 order-md-2">
        <h2 class="text-center"><span class="tag-mark">{{$tag->name}}<span> 一覧</h2>
        <hr>
        <div class="row">
        @foreach ($articles as $article)
        <div class="p-3 col-sm-6">
          <div class="card">
            <a href="{{ route('articles.show', ['article'=>$article->id]) }}">
              <div class="header-image-wrapper">
                <div class="header-image-content" style="background-image:url('{{$article->header_image}}');"></div>    
              </div>
            </a>
            <div class="card-haeder w-100 d-flex p-3">
              <div class="ml-2 d-flex flex-column">
                <div class="w-100 d-inline-flex">
                  <a href="{{ url('users/' .$article->user->id) }}" class="text-secondary">
                    <img src="{{ asset($article->user->profile_image) }}" class="rounded" width="39" height="39">
                  </a>
                  <a href="{{ route('articles.show', ['article'=>$article->id]) }}">
                    <p class="px-1">{{ $article->title }}</p>
                  </a>
                </div>
                <p class="mb-0 text-secondary">
                  @foreach($article->tags as $tag)
                  <span class="tag-mark">{{$tag->name}}</span>
                  @endforeach
                </p>
                <p class="mb-0 text-secondary">
                  <span>by &#064;{{$article->user->screen_name}}</span>
                  <span>{{ $article->created_at->format('Y-m-d H:i') }}</span>
                  <span><i class="far fa-thumbs-up"></i>{{ count($article->favorites) }}</span>
                </p>
              </div>
            </div>
          </div>
          </div>
        @endforeach
        </div>
        <div class="my-4 d-flex justify-content-center">
          {{ $articles->links() }}
        </div>
      </div>
      
      <div class="col-md-3 order-md-1">
        <div class="card">
          <div class="card-header tag-mark">話題のタグ</div>
          <div class="card-body">
            @foreach ($popular_tags as $tag)
              <a href="{{ route('tags.show', ['tag'=>$tag->id]) }}">
                <p>{{$tag->name}}({{$tag->articles_count}})</p>
              </a>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>
  
</div>
@endsection