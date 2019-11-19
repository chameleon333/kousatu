{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  @foreach ($articles as $article)
    <div class="post_box">
      <a href="/articles/{{$article->id}}">
        <p class="post_pic"><img src="/{{ $article->image_url }}"></p>
        <p>{{$article->body}}</p>
      </a>
      <form action="/articles/{{$article->id}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="delete">
        <input type="submit" name="" value="削除する">
      </form>
      <hr>
    </div>
  @endforeach
@endsection