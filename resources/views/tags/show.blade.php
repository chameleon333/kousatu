
@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">

    <div class="row col-md-12">
    
      <div class="col-md-9 mb-3 order-md-2">
        <h2 class="text-center"><span class="tag-mark h2">{{$tag->name}}</span><span class="ml-2">の記事一覧</span></h2>
        <hr>
        <article-list-component api="{{ $api }}"></article-list-component>
      </div>
      @include('components.side_navi')
    </div>
  </div>
  
</div>
@endsection