
@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mb-3 text-right">
      <a href="{{ url('users') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
    </div>

    <div class="row col-md-12">
    
      <div class="col-md-9 mb-3 order-md-2">
        <h2 class="text-center"><span class="tag-mark">{{$tag->name}}</span><span class="ml-2">一覧</span></h2>
        <hr>
        <article-list-component api="{{ $api }}"></article-list-component>
      </div>
      <div class="col-md-3 order-md-1">
        @include('components.popular_tag_list')
        @include('components.popular_user_list')
      </div>
    </div>
  </div>
  
</div>
@endsection