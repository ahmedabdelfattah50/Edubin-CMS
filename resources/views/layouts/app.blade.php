<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Icon -->
    <link rel="icon" href="{{ asset('storage/images/cmsIcon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Styles -->
    @yield('styleField')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="
                        {{ url('/homeWriterDash') }}
                    ">
                    <img src="{{ asset('storage/frontEnd/logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.profileEdit', Auth()->user()->id) }}">
                                        My Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('middle'))
                <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
                    {{ session()->get('middle') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @auth
                <div class="row">
                    <div class="list-group py-4 col-md-4">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('dashboard.index') }}" class="list-group-item list-group-item-action">Dashboard</a>
                            <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">Users <span class="badge badge-warning">{{ \App\User::count() }}</span></a>
                            <a href="{{ route('contactUs.messages') }}" class="list-group-item list-group-item-action">Contacts Messages <span class="badge badge-warning">{{ \App\Contact::count() }}</span></a>
                        @endif
                        <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">Categories <span class="badge badge-warning">{{ \App\Category::count() }}</span></a>
                        <a href="{{ route('tags.index') }}" class="list-group-item list-group-item-action">Tags <span class="badge badge-warning">{{ \App\Tag::count() }}</span></a>
                        <a href="{{ route('posts.index') }}" class="list-group-item list-group-item-action">All Posts <span class="badge badge-warning">{{ \App\Post::count() }}</span></a>
                        <a href="{{ route('myPosts.index') }}" class="list-group-item list-group-item-action">My Posts <span class="badge badge-warning">{{ Auth()->user()->posts->count() }}</span></a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('trashedPosts.index') }}" class="list-group-item list-group-item-action">Trashed Posts <span class="badge badge-warning">{{ \App\Post::onlyTrashed()->count() }}</span></a>
                        @endif
                        <a href="{{ route('users.profileEdit', Auth()->user()->id) }}" class="list-group-item list-group-item-action">My Profile</a>
                    </div>
                    <main class="py-4 col-md-8">
                        @yield('content')
                    </main>
                </div>
            @else
                <div class="row justify-content-center">
                    <main class="py-4 col-md-8">
                        @yield('content')
                    </main>
                </div>
            @endauth
        </div>

    </div>
</body>
</html>

@yield('scriptField')
