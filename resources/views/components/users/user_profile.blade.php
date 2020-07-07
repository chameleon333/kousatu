<div class="d-flex flex-column text-right pt-2 pr-3">
  <div>
    <i class="far fa-thumbs-up"></i>
    <span class="text-secondary">Total {{ $total_favorited_count }}</span>
  </div>
</div>
<div class="p-1 d-sm-flex">
  <div class="mx-3 d-flex flex-column">
    <img src="{{ asset($user->profile_image) }}" class="rounded" width="100" height="100">
    <div class="my-3 d-flex flex-column">
      <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
      <span class="text-secondary">&#064;{{ $user->screen_name }}</span>
    </div>
  </div>
  <div class="mx-3 mb-3 d-flex flex-column">
    <div class="d-flex">
      @if (isset(auth()->user()->id))
      @if (auth()->user()->id == $user->id)
      <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
      @else
      @if ($is_following)
      <follow-button-component is-follow="{{ auth()->user()->isFollowing($user->id) }}" user-id="{{ $user->id }}"></follow-button-component>
      @else
      <follow-button-component is-follow="{{ auth()->user()->isFollowing($user->id) }}" user-id="{{ $user->id }}"></follow-button-component>
      @endif
      @if ($is_followed)
      <span class="mt-2 px-2 text-dark">フォローされています</span>
      @endif
      @endif
      @endif
    </div>
    <div class="d-flex">
      <span class="mt-2">{{ $user->self_introduction }}</span>
    </div>
  </div>
</div>
