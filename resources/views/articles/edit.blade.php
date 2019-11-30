@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
          <!-- <form method="POST" action="{{ route('articles.update', ['articles' => $articles]) }}"> -->
          <form method="POST" action="{{ route('articles.update', ['articles' => $articles]) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group row mb-0">
              <div class="col-md-12 p-3 w-100 d-flex">
                <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                <div class="ml-2 d-flex flex-column">
                  <p class="mb-0">{{ $user->name }}</p>
                  <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                </div>
              </div>
              <div class="col-md-12">
                <textarea class="form-control @error('body') is-invalid @enderror" name="body" required autocomplete="body" rows="10">{{ old('body') ? : $articles->body }}</textarea>
              
                @error('body')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-12 text-right">
                <p class="mb-4 text-right">
                  <p class="mb-4 text-danger">140文字以内</p>
                  <button class="btn btn-primary">
                    記事を投稿する
                  </button>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection