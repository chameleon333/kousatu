@foreach ($all_users as $user)
  <div class="card">
    <div class="card-haeder p-3 w-100 d-flex flex-wrap">
    <a href="{{ url('users/' .$user->id) }}" class="text-secondary">
      <img src="{{ asset($user->profile_image) }}" class="rounded" width="39" height="39">
    </a>
      <div class="ml-2 d-flex flex-column w-50">
        <div class="mb-0 small w-100 text_ellipsis"><a href="{{ url('users/' .$user->id) }}">{{ $user->name }}</a></div>
        <div class="w-100 d-inline-flex">
          <div class="w-25 text_ellipsis"><span class="text-secondary">&#064;{{$user->screen_name}}</span></div>
          @if(auth()->user())
            @if (auth()->user()->isFollowed($user->id))
              <div class="w-75 text_ellipsis"><span class="small pl-2">フォローされてます</span></div>
            @endif
          @endif
        </div>
        <div class="w-100 d-inline-flex">
          <div class="text_ellipsis"><span class="text-secondary">{{$user->self_introduction}}</span></div>
        </div>
      </div>


      <div class="d-flex justify-content-end flex-grow-1 w-25">
      @if(auth()->user())
        @if (auth()->user()->isFollowing($user->id))
          <form action="{{route('users.unfollow', ['user' => $user->id]) }}" method="POST">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger btn-sm">フォロー解除</button>
          </form>
        @else
          <form action="{{route('users.follow', ['user' => $user->id]) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary btn-sm">フォロー</button>
          </form>
        @endif
      @else
        <form action="{{route('users.follow', ['user' => $user->id]) }}" method="POST">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-primary">フォローする</button>
        </form>
      @endif
      </div>
    </div>
  </div>
@endforeach
<div class="my-4 d-flex justify-content-center">
  {{ $all_users->links() }}
</div>
