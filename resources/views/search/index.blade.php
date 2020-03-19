
@extends('layouts.app')

@section('content')

<div class="container">
  @guest
    @component('components.login_form')
    @endcomponent
  @endguest

  <div class="row justify-content-center">
    <div class="col-md-8 mb-3 text-right">
      <a href="{{ url('users') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
    </div>
    @foreach ($search_articles as $search_article)
    <div class="col-md-8 mb-3">
      <div class="card">
        <div class="card-haeder p-3 w-100 d-flex">
        <a href="{{ url('users/' .$search_article->user->id) }}" class="text-secondary">
          <img src="{{ asset($search_article->user->profile_image) }}" class="rounded" width="50" height="50">
        </a>
          <div class="ml-2 d-flex flex-column">
          <a href="{{ route('articles.show', ['article'=>$search_article->id]) }}">
            <p class="mb-0">{{ $search_article->title }}</p>
          </a>
            <p class="mb-0 text-secondary">
              <span>by &#064;{{$search_article->user->screen_name}}</span>
              <span>{{ $search_article->created_at->format('Y-m-d H:i') }}</span>
              <span><i class="far fa-thumbs-up"></i>{{ count($search_article->favorites) }}</span>
            </p>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="my-4 d-flex justify-content-center">
    {{ $search_articles->links() }}
  </div>
</div>
@endsection