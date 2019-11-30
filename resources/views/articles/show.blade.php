@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100 d-flex">
                    <img src="{{ asset('storage/profile_image/' .$article->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">{{ $article->user->name }}</p>
                        <a href="{{ url('users/' .$article->user->id) }}" class="text-secondary">{{ $article->user->screen_name }}</a>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $article->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    {!! nl2br(e($article->text)) !!}
                </div>
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                    @if ($article->user->id === Auth::user()->id)
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ url('articles/' .$article->id) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ url('articles/' .$article->id .'/edit') }}" class="dropdown-item">編集</a>
                                    <button type="submit" class="dropdown-item del-btn">削除</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="mr-3 d-flex align-items-center">
                        <a href="{{ url('articles/' .$article->id) }}"><i class="far fa-comment fa-fw"></i></a>
                        <p class="mb-0 text-secondary">{{ count($article->comments) }}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                        <p class="mb-0 text-secondary">{{ count($article->favorites) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <ul class="list-group">
                @forelse ($comments as $comment)
                    <li class="list-group-item">
                        <div class="py-3 w-100 d-flex">
                            <img src="{{ asset('storage/profile_image/' .$comment->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $comment->user->name }}</p>
                                <a href="{{ url('users/' .$comment->user->id) }}" class="text-secondary">{{ $comment->user->screen_name }}</a>
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
            </ul>
        </div>
    </div>
</div>
@endsection