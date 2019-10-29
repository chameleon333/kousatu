{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '新規作成')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  <form action="/articles" method="post">
    {{-- 以下を入れないとエラーになる --}}
    {{ csrf_field() }}
    <div>
      <label for="title">タイトル</label>
      <input type="text" name="title" placeholder="記事のタイトルを入れる">
    </div>
    <div>
      <label for="body">内容</label>
      <textarea name="body" rows="8" cols="80" placeholder="記事の内容を入れる"></textarea>
    </div>
    <div>
      <input type="submit" value="送信">
    </div>
  </form>
@endsection