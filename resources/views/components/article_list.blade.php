<div class="row">
  @foreach ($articles as $article)
  <div class="p-3 col-sm-6">
    <div class="card">
      <a href="{{ route('articles.show', ['article'=>$article->id]) }}">
        <div class="header-image-wrapper">
          <div class="header-image-content" style="background-image:url('{{$article->header_image}}');"></div>    
        </div>
      </a>
      <div class="card-haeder w-100 d-flex p-3">
        <div class="ml-2 d-flex flex-column">
          <div class="w-100 d-inline-flex">
            <a href="{{ url('users/' .$article->user->id) }}" class="text-secondary">
              <img src="{{ asset($article->user->profile_image) }}" class="rounded" width="39" height="39">
            </a>
            <a href="{{ route('articles.show', ['article'=>$article->id]) }}">
              <p class="px-1">{{ $article->title }}</p>
            </a>
          </div>
          <p class="mb-0 text-secondary">
            @foreach($article->tags as $tag)
            <span class="tag-mark">{{$tag->name}}</span>
            @endforeach
          </p>
          <p class="mb-0 text-secondary">
            <span>by &#064;{{$article->user->screen_name}}</span>
            <span>{{ $article->created_at->format('Y-m-d H:i') }}</span>
            <span><i class="far fa-thumbs-up"></i>{{ count($article->favorites) }}</span>
          </p>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
<div class="my-4 d-flex justify-content-center">
          {{ $articles->links() }}
</div>