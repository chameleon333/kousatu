@push('cropper')
    <link href="{{ asset('css/cropper-custom.css') }}" rel="stylesheet">
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="{{ asset('js/cropper-custom.js') }}" defer></script>
@endpush
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Update</div>
        <div class="card-body">
          <form method="POST" action="{{url('users/' .$user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="col-md-6 d-flex align-items-center">
              <img src="{{ asset($user->profile_image) }}" class="mr-2 rounded" width="80" height="80" alt="profile_image">
              <input type="file" name="profile_image" class="@error('profile_image') is-invalid @enderror" autocomplete="profile_image">
              
              @error('profile_image')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            
            <div class="form-group row">
              <label for="screen_name" class="col-md-4 col-form-label text-md-right">ユーザー名</label>
              
              <div class="col-md-6">
                <input id="screen_name" type="text" class="form-control @error('screen_name') is-invalid @enderror" name="screen_name" value="{{ $user->screen_name }}" required autocomplete="screen_name" autofocus>
                
                @error('screen_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <lavel for="name" class="col-md-4 col-form-label text-md-right">名前</lavel>
              
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-valid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address' )}}</label>
              
              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">更新する</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection