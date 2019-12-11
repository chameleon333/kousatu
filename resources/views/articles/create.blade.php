@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create</div>


        <div class="card-body">
          <form method="POST" action="{{ route('articles.store') }}">
            @csrf
            <div class="form-group row mb-0">
              <div class="col-md-12 p-3 w-100 d-flex">
                <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded" width="50" height="50">
                <div class="ml-2 d-flex flex-column">
                  <p class="mb-0">{{ $user->name }}</p>
                  <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                  
                </div>
              </div>
              <div class="col-md-12">
                <input type="text" name="title" class="form-control">
                <textarea class="form-control @error('body') is-invalid @enderror" name="body" required autocomplete="body" rows="4">{{ old('body')}}</textarea>
                <input type="file" name="image_url" class="@error('image_url') is-invalid @enderror" autocomplete="image_url">
                @error('image_url')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('title')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('body')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-12 text-right">
                <p class="mb-4 text-danger">140文字以内</p>
                <button type="submit" class="btn btn-primary">記事投稿する</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection