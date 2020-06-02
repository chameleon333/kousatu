@push('cropper')
  <link href="{{ asset('css/cropper-custom.css') }}" rel="stylesheet">
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
  <script src="{{ asset('js/cropper-custom.js') }}" defer></script>
@endpush

@push('tui-editor')
  <script src="https://uicdn.toast.com/tui-editor/latest/tui-editor-Editor-full.js"></script>
  <script src="{{ asset('js/tui-editor-custom.js') }}"></script>
@endpush


@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row mb-0">
      <div class="col-md-12">
        <input type="text" name="title" placeholder="タイトル" class="form-control form-control-lg @error('title') is-invalid @enderror">
        <tags-component></tags-component>
        <!-- Create the editor container -->                
        <div id="editSection" rows="8" cols="40">{{ old('body')}}</div>
        <textarea id="edit_content" class="editor mt-2 form-control @error('body') is-invalid @enderror" required autocomplete="body" name="body" style="display: none;"></textarea>
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

    <div class="form-group row mb-0 text-right">
      <div class="col-md-12 mt-2">
          <label for="profile_image" class="col-form-label text-md-right">ヘッダー画像</label>
          <div class="">
            <label class="label" data-toggle="tooltip" title="画像を追加する">
                <div id="display_cropped_image" class="border position-relative rectangle-frame" name="test">
                    <span id="avatar" class="rectangle_content bg-image rounded" style="background-image:url('')">
                        <i id="avatar_plus" class="fas fa-plus fa-2x text-secondary position-absolute h-100 w-100 m-0 d-flex align-items-center justify-content-center"></i>
                    </span>
                </div>
                <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                <input type="hidden" id="binary_image" name="binary_image" value="">
            </label>
          </div>
          <post-article-button-component v-bind:status-texts="{{ ($article_status_texts) }}"></post-article-button-component>

          <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
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
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">中止</button>
                      <button type="button" class="btn btn-primary" id="crop">切り抜き</button>
                  </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </form>
</div>

@endsection
