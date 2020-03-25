@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="m-3">
                <h2 class="text-center">新規登録</h2>
                <hr>
                <div class="mt-3">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="screen_name" class="col-md-4 col-form-label text-md-right">ユーザー名</label>

                            <div class="col-md-6">
                                <input id="screen_name" type="text" class="form-control @error('screen_name') is-invalid @enderror" name="screen_name" value="{{ old('screen_name') }}" required autocomplete="screen_name" autofocus>

                                @error('screen_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">プロフィール画像</label>
                            <div class="col-md-6 py-2">
                                <div class="mb-2">
                                    <input type="file" id="add_profile_image"　class="form-control-file mb-1">
                                </div>
                                <div>
                                    <img id="dispaly_profile_image" src="" class="border" alt="" width="150" height="150">
                                    <!-- <canvas id="canvas_profile_image" class="border border-secondary" height="150" width="150" onclick=on_click()></canvas> -->
                                </div>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    アカウントを作成する
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        アカウントをお持ちの方
                                    </a>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
