<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Royal App</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/all.min.css')}}">
</head>
<body>
<div id="app">
    @if(session()->get('token'))
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="@if(!Request::is('home/create/book') and !Request::is('home/profile')) btn btn-primary  @else navbar-brand  @endif" href="{{ url('/') }}">
                    Royal
                </a>
                <a class="@if(Request::is('home/profile')) btn btn-primary  @else navbar-brand  @endif"
                   href="{{ route('profile')}}">
                    Profile
                </a>

                <a class="@if(Request::is('home/create/book')) btn btn-primary  @else navbar-brand  @endif"
                   href="{{ route('book.create')}}">
                    New Book
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                    </ul>


                    <ul class="navbar-nav ms-auto">

                        @if (session('last_name') && session('first_name')  )
                            <li class="nav-item">
                                <p class="nav-link ">
                                    {{ session('first_name') . ' ' . session('last_name')}}
                                </p>

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="btn btn-outline-danger"> Logout</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    @endif
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
