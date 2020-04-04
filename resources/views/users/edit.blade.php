@push('cropper')
    <link href="{{ asset('css/cropper-custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile_edit.css') }}" rel="stylesheet">
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="{{ asset('js/cropper-custom.js') }}" defer></script>
@endpush
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">プロフィールを編集</div>
        <div class="card-body">
          <form method="POST" action="{{url('users/' .$user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group row">
              <label for="profile_image" class="col-md-4 col-form-label text-md-right">プロフィール画像</label>

              <div class="col-md-6 py-2">
                    <label class="label" data-toggle="tooltip" title="画像を追加する">
                        <div id="display_cropped_image" class="border position-relative square-frame">
                            <span id="avatar" class="square_content bg-image rounded" style="background-image:url('{{ asset($user->profile_image) }}')">
                                <i id="avatar_plus" class="fas fa-plus fa-2x text-secondary position-absolute h-100 w-100 m-0 d-flex align-items-center justify-content-center"></i>
                            </span>
                        </div>
                        <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                        <input type="hidden" id="binary_image" name="binary_image" value="">
                    </label>
              </div>
              <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="img-container">
                          <img id="image" src="">
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-primary" id="crop">Crop</button>
                      </div>
                    </div>
                </div>
              </div>
              
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

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">自己紹介</label>
              
              <div class="col-md-6">
                <textarea name="self_introduction" id="self_introduction" class="form-control @error('self_introduction') is-invalid @enderror" cols="30" rows="10">{{ $user->self_introduction }}</textarea>
                
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