
@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mb-3 text-right">
      <a href="{{ url('users') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
    </div>

    <div class="row col-md-12">
    
      <div class="col-md-9 mb-3 order-md-2">
        <article-list-component api="{{ url('fetch') }}"></article-list-component>
      </div>

      
      <div class="col-md-3 order-md-1">
        @include('components.popular_tag_list')
        @include('components.popular_user_list')
      </div>

    </div>
  </div>
</div>
@endsection