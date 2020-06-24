@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mb-3">
      <div class="card">
        @include('components.users.user_profile')
        @include('components.users.user_tab_list')

        <div class="row p-3">
          @if ($timelines->count())
            @foreach ($timelines as $timeline)
              <div class="col-sm-6 mb-3">
                <div class="card">
                  <a href="{{ route('articles.show', ['article'=>$timeline->id]) }}">
                    <div class="header-image-wrapper">
                      <div class="header-image-content" style="background-image:url('{{$timeline->header_image}}');"></div>    
                    </div>
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
                      <p class="mb-0">
                        @foreach($timeline->tags as $tag)
                          <a class="text-secondary" href="/tags/{{ $tag->id }}">
                            <span class="tag-mark">{{$tag->name}}</span>
                          </a>
                        @endforeach
                      </p>
                      <div class="mt-1 d-flex">
                        <div class="mr-auto text-secondary">
                          <span>by &#064;{{$timeline->user->screen_name}}</span>
                          <span>{{ $timeline->created_at->format('Y-m-d H:i') }}</span>
                          <span><i class="far fa-thumbs-up"></i>{{ count($timeline->favorites) }}</span>
                        </div>
                        @if (isset(auth()->user()->id))
                          @if (auth()->user()->id == $user->id)
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
                          @endif
                        @endif
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
          @else
            <div class="mx-auto p-5">対象の記事がありません。</div>  
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="my-4 d-flex justify-content-center">
    {{ $timelines->links() }}
  </div>
</div>
@endsection
