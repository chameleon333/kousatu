{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  @foreach ($articles as $article)
    <div class="post_box">
      <div><h2>{{$article->title}}</h2></div>
      <a href="/articles/{{$article->id}}">
        <p class="post_pic"><img src="/{{ $article->image_url }}"></p>
        <p>{{$article->body}}</p>
      </a>
      <hr>
    </div>
  @endforeach
@endsection