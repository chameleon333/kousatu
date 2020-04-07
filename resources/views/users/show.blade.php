@extends('layouts.app')

@section('content')
<?php 
  if(Auth::user()) {
    $auth = Auth::user()->id; 
  } else {
    $auth = null;
  }
?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10 mb-3">
      <div class="card">
        <div class="p-1 d-sm-flex">
          <div class="m-3 d-flex flex-column">
            <img src="{{ asset($user->profile_image) }}" class="rounded" width="100" height="100">
            <div class="mt-3 d-flex flex-column">
              <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
              <span class="text-secondary">&#064;{{ $user->screen_name }}</span>
            </div>
          </div>
          <div class="m-3 d-flex flex-column justify-content-between">
            <div class="d-flex">
              <div>
                @if ($user->id === $auth)
                <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
                @else
                @if ($is_following)
                <form action="{{ route('users.unfollow', ['user' => $user->id]) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button type="submit" class="btn btn-danger">フォロー解除</button>
                </form>
                @else
                <form action="{{ route('users.follow', ['user' => $user->id]) }}" method="POST">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-sm page-link text-dark d-inline-block">フォローする</button>
                </form>
                @endif
                  @if ($is_followed)
                    <span class="mt-2 px-1 bg-white text-dark">フォローされています</span>
                  @endif
                @endif
              </div>
            </div>
            <div class="d-flex">
            <span class="mt-2">{{ $user->self_introduction }}</span>
            </div>
            <div class="d-flex">
              <!-- <div class="p-2 d-flex flex-column align-items-center">
                <p class="font-weight-bold"><span>{{ $article_count }}</span>記事</p>
              </div> -->
              <div class="d-flex flex-column">                
                <p class="font-weight-bold"><a href="{{ url('users/' .$user->id .'/following_users') }}"><span>{{ $follow_count }}</span>フォロー中</a></p>
              </div>
              <div class="ml-2 d-flex flex-column">
                <p class="font-weight-bold"><a href="{{ url('users/' .$user->id .'/followers') }}"><span>{{ $follower_count }}</span>フォロワー</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-10 mb-3 row">
    @if (isset($timelines))
    @foreach ($timelines as $timeline)
      <div class="p-3 col-sm-6">
        <div class="card">
          <a href="{{ route('articles.show', ['article'=>$timeline->id]) }}">
            <img src="{{$timeline->header_image}}" alt="" class="w-100">
          </a>
          <div class="card-haeder w-100 p-3">
            <div class="ml-2 d-flex flex-column">
              <div class="w-100 d-inline-flex">
                <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">
                  <img src="{{ asset($timeline->user->profile_image) }}" class="rounded" width="39" height="39">
                </a>
                <a href="{{ route('articles.show', ['article'=>$timeline->id]) }}">
                  <p class="px-1">{{ $timeline->title }}</p>
                </a>
              </div>
              <div class="mt-1 d-flex">
                <div class="mr-auto text-secondary">
                  <span>by &#064;{{$timeline->user->screen_name}}</span>
                  <span>{{ $timeline->created_at->format('Y-m-d H:i') }}</span>
                  <span><i class="far fa-thumbs-up"></i>{{ count($timeline->favorites) }}</span>
                </div>
                <div class="dropdown d-flex align-items-center">
                  <a href="{{ url('articles/' .$timeline->id. '/edit') }}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-fw"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <form method="POST" action="{{ url('articles/' .$timeline->id) }}" class="mb-0">
                      @csrf
                      @method('DELETE')

                      <a href="{{ url('articles/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                      <button type="submit" class="dropdown-item del-btn">削除</button>
                    </form>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <a href="{{ url('articles/' .$timeline->id) }}#comment"><i class="far fa-comment fa-fw"></i></a>
                  <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>



    @endforeach
    @endif
    </div>
  </div>
  <div class="my-4 d-flex justify-content-center">
    {{ $timelines->links() }}
  </div>
</div>
@endsection
