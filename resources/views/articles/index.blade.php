{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  @foreach ($articles as $article)
    <p><img src="{{$article->image_url}}"></p>
    <p>{{$article->body}}</p>
    <a href="/articles/{{$article->id}}">詳細を表示</a>
    <hr>
  @endforeach
@endsection