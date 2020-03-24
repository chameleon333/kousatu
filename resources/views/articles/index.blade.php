
@extends('layouts.app')

@section('content')

<div class="container">
  @guest
    @component('components.login_form')
    @endcomponent
  @endguest

  <div class="row justify-content-center">
    <div class="col-md-9 mb-3 text-right">
      <a href="{{ url('users') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
    </div>
    <div class="col-md-9 mb-3 row">
    @foreach ($timelines as $timeline)
    <div class="p-2 col-sm-6">
      <div class="card">
        <!-- <div class="w-100" style="background-image: url('https://placehold.jp/500x400.png');height:150px;"></div> -->
        <img src="https://placehold.jp/500x400.png" alt="" class="w-100">
        <div class="card-haeder w-100 d-flex p-3">
          <div class="ml-2 d-flex flex-column">
            <div class="w-100 d-inline-flex">
            <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">
                <img src="{{ asset($timeline->user->profile_image) }}" class="rounded" width="39" height="39">
              </a>
              <a href="{{ route('articles.show', ['article'=>$timeline->id]) }}">
                <p >{{ $timeline->title }}</p>
              </a>
            </div>
            <p class="mb-0 text-secondary">
              <span>by &#064;{{$timeline->user->screen_name}}</span>
              <span>{{ $timeline->created_at->format('Y-m-d H:i') }}</span>
              <span><i class="far fa-thumbs-up"></i>{{ count($timeline->favorites) }}</span>
            </p>
          </div>
        </div>
      </div>
      </div>
    @endforeach
    </div>
  </div>
  <div class="my-4 d-flex justify-content-center">
    {{ $timelines->links() }}
  </div>
</div>
@endsection