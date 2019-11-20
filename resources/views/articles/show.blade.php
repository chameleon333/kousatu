{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事詳細')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  <div class="title"><h2>{{$article->title}}</h2></div>
  <div class="post_pic"><img src='/{{$article->image_url}}'></div>
  <p>{{$article->body}}</p>
  <br><br>
<!--
    <form action="/articles/{{$article->id}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="delete">
      <input type="submit" name="" value="削除する">
    </form>
-->
  <a href="/articles">一覧に戻る</a>
@endsection