@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="">
    <div class="">
      <div class="">
        <div class="">
          <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-0">
              <div class="col-md-12">
                <input type="text" name="title" class="form-control">
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

            <div class="form-group row mb-0">
              <div class="col-md-12 text-right">
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary" onclick="callBody();">投稿する</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- tui.editor -->
<script src="https://uicdn.toast.com/tui-editor/latest/tui-editor-Editor-full.js"></script>
<script src="{{ asset('js/tui-editor-custom.js') }}" defer></script>

@endsection
