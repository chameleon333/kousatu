
@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="row col-md-12">
      <div class="col-md-9 mb-3 order-md-2">
        <h2 class="text-center"><span class="double-quotation-mark h2">{{$keyword}}</span><span class="ml-2">で検索</span></h2>
        <hr>
        @include('components.article_list')
      </div>
      @include('components.side_navi')
    </div>
    
  </div>
  
</div>
@endsection