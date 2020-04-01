<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- SimpleMDE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">

    <!-- tui.editor -->
    <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link>
    <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link>

    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/profile_image_preview.js') }}" defer></script>
    @stack('cropper')

    <!-- <script src="{{ asset('js/tui-editor-Editor-full.js') }}"></script> -->



</head>
<body>
@guest

    <div class="w-100 text-center p-3 bg-warning">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="test1@test.com">
        <input type="hidden" name="password" value="12345678">
        <button type="submit" class="btn btn-link text-white">ゲストユーザーとしてログインする(全機能をご使用できます。)</button>
    </form>    
    </div>
@endguest
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-yellow bg-color shadow-sm">
            <div class="container pl-2">

            <div class="row">
                <a class="navbar-brand" href="{{ url('/articles') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <img src="/storage/logo/logo.png" width="130px">
                </a>
                <div class="btn-group">
                    <span class="fa fa-search top_seach_icon btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                    <div class="dropdown-menu">
                <form action="{{ url('/search') }}" class="form-inline mt-10 w-100">
                    <span class="p-2 w-100"><input type="text" name="keyword" value="{{$keyword}}" class="form-control pl-4 small w-100" placeholder="キーワード検索"></span>
                </form>  
                    </div>
                </div>
            </div>
                <div id="navbarSupportedContent" class="py-2">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav navbar-ori">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item px-1">
                                <a class="btn btn-light btn-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-light btn-sm" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                    </ul>
                        @else 
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto mr-2 navbar-ori">
                        <li class="nav-item">
                            <a class="btn btn-light" role="button" href="{{ url('articles/create') }}"><i class="far fa-edit"></i></i><span class="d-none d-sm-inline ml-1">投稿する</span></a>
                        </li>
                    </ul>
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="dropdown-toggle anderline-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ asset(auth()->user()->profile_image) }}" class="rounded" width="37" height="37">
                                    <span class="caret"></span>
                                </a>                                    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.show',['user'=>auth()->user()->id]) }}">
                                        プロフィール
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    ログアウト
                                        <!-- {{ __('Logout') }} -->
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                        </li>
                        @endguest
                    <!-- </ul> -->
                </div>
            </div>
        </nav>
        <main class="py-3">
            @yield('content')
        </main>
    </div>

</body>
</html>
