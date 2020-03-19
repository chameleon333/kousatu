<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- <script src="{{ asset('resources/js/app.js') }}" defer></script> -->

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
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-yellow bg-color shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/articles') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <img src="/storage/logo/logo.png" width="130px">
                </a>
                <form action="{{ url('/search') }}">
                    <span><input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="キーワード検索"></span>
                </form>         
                <div class="navbar" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto mr-2 navbar-ori">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                    </ul>
                    <ul class="navbar-nav ml-auto mr-2 navbar-ori">
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-light" href="{{ route('register') }}">{{ __('Register') }}</a>
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

    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- <script src="{{ asset('js/tui-editor-Editor-full.js') }}"></script> -->
</body>
</html>
