@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100 d-flex">
                    <img src="{{ asset($article->user->profile_image) }}" class="rounded" width="50" height="50">
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">{{ $article->user->name }}</p>
                        <a href="{{ url('users/' .$article->user->id) }}" class="text-secondary">&#064;{{ $article->user->screen_name }}</a>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $article->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                <div class="card-body">
                <h1>{!! nl2br(e($article->title)) !!}</h1>
                <div class="mb-2">
                    @foreach($article->tags as $tag)
                    <a class="text-secondary" href="/tags/{{ $tag->id }}">
                        <span class="tag-mark">{{$tag->name}}</span>
                    </a>
                    @endforeach
                </div>
                <div class="mb-2">
                    <div class="header-image-wrapper">
                        <div class="header-image-content" style="background-image: url( {{ $article->header_image }} );"></div>
                    </div>
                </div>
                <hr>
                <div id="preview_marked"></div>
                    <!-- {!! nl2br($article->body) !!} -->
                </div>
                <textarea id="edit_content" class="editor mt-2 form-control @error('body') is-invalid @enderror" required autocomplete="body" name="body" style="display: none;">{{$article->body}}</textarea>
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                    <div class="mr-3 d-flex mr-auto align-items-center">                    
                        <a href="https://twitter.com/share?{{$twitter_share_param}}" target="_blank" rel="noopener noreferrer" id="twitterShare">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                @if ($user)
                    @if ($article->user->id === Auth::user()->id)
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ url('articles/' .$article->id) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="redirect" value="on">
                                    <a href="{{ url('articles/' .$article->id .'/edit') }}" class="dropdown-item">編集</a>
                                    <button type="submit" class="dropdown-item del-btn">削除</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endif
                    
                    <div class="mr-3 d-flex align-items-center">
                        <a href="{{ url('articles/' .$article->id) }}"><i class="far fa-comment fa-fw"></i></a>
                        <p class="mb-0 text-secondary">{{ count($article->comments) }}</p>
                    </div>

                    <div class="d-flex align-items-center">

                    @if ($user)
                        @if (!in_array($user->id, array_column($article->favorites->toArray(),'user_id')))
                            <form method="POST" action="{{ url('favorites/') }}" class ="mb-0">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-thumbs-up"></i></button>
                            </form>
                        @else
                            <form method="POST" action="{{ url('favorites/' .array_column($article->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn p-0 border-0 text-primary"><i class="fas fa-thumbs-up"></i></i></button>
                            </form>
                        @endif
                    @else
                        <form method="POST" action="{{ url('favorites/') }}" class ="mb-0">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <button type="submit" class="btn p-0 border-0 text-primary"><i class="fas fa-thumbs-up"></i></i></button>
                        </form>                    
                    @endif
                        <p class="mb-0 text-secondary">{{ count($article->favorites) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div id="comment" class="col-md-8 mb-3">
            <ul class="list-group">
                @forelse ($comments as $comment)
                    <li class="list-group-item">
                        <div class="py-3 w-100 d-flex">
                            <img src="{{ asset($comment->user->profile_image) }}" class="rounded" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $comment->user->name }}</p>
                                <a href="{{ url('users/' .$comment->user->id) }}" class="text-secondary">&#064;{{ $comment->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="py-3">
                            {!! nl2br(e($comment->text)) !!}
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">コメントはまだありません。</p>
                    </li>
                @endforelse

                <li class="list-group-item">
                    <div class="py-3">
                        @if($user)
                            <form method="POST" action="{{ route('comments.store') }}">
                            @csrf

                                <div class="form-group row mb-s0">
                                    <div class="col-md-12 p-3 w-100 d-flex">
                                        <img src="{{ asset($user->profile_image) }}" class="rounded" width="50" height="50">
                                        <div class="ml-2 d-flex flex-column">
                                            <p class="mb-0">{{ $user->name }}</p>
                                            <a href="{{ url('users/' .$user->id) }}" class="text-secondary">&#064;{{ $user->screen_name }}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" required rows="4">{{ old('text')}}</textarea>

                                        @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-12 text-right">
                                        <p class="mb-4 text-danger">140文字以内</p>
                                        <button type="submit" class="btn btn-primary">
                                            コメントする
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                    </div>
                </li>
            </ul>
                @component('components.login_form')
                @endcomponent
            @endif
        </div>
    </div>
</div>
<!-- marked.js -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="{{ asset('js/markdown_preview.js') }}" defer></script>
@endsection
