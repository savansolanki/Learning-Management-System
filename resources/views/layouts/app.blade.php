<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Learning Management System </title>

    <!-- Styles -->
    <link href="{{ asset('css/vendor/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/snackbar.css') }}" rel="stylesheet">
    <style>
        .navbar {
            margin-bottom: 0px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top  paper-shadow" data-z="0" data-animated role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    LMS
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-nav-margin-left">
                    @guest
                    <li class="active">
                        <a href="/" class="dropdown-toggle">Home</a>
                    </li>
                    @else
                        @if(Auth::user()->role == 0)
                            <li><a href="{{  route('student.dashboard') }}"> Dashboard</a></li>
                        @else
                                <li><a href="{{  route('tutor.dashboard') }}"> Dashboard</a></li>
                        @endif
                        @endguest
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown">Courses <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($categories as $cat)
                                    <li><a href="{{ url('/?category='.$cat->id) }}">{{ $cat->category }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <div class="navbar-right">
                    <!-- Authentication Links -->
                    @guest
                    <a href="{{ route('login') }}" class="navbar-btn btn btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="navbar-btn btn btn-primary">Register</a>
                    @else
                        <ul class="nav navbar-nav navbar-nav-bordered navbar-nav-margin-right">
                            <!-- user -->
                            <li class="dropdown user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="/uploads/profile_image/{{ Auth::user()->avatar }}" alt=""
                                         class="img-circle"/> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    @if(Auth::user()->role == 0)
                                        <li><a href="{{  route('student.dashboard') }}"><i
                                                        class="fa fa-bar-chart-o"></i> Dashboard</a></li>
                                        <li><a href="{{  url('student/enroll')  }}"><i class="fa fa-mortar-board"></i> My
                                                Courses</a></li>
                                        <li><a href="{{  route('student.profile',str_slug( Auth::user()->name)) }}"><i
                                                        class="fa fa-user"></i> Profile</a>
                                        </li>
                                    @else
                                        <li><a href="{{  route('tutor.dashboard') }}"><i
                                                        class="fa fa-bar-chart-o"></i> Dashboard</a></li>
                                        <li><a href="{{ route('tutor.course.index') }}"><i
                                                        class="fa fa-mortar-board"></i> My
                                                Courses</a></li>
                                        <li><a href="{{  route('tutor.profile') }}"><i
                                                        class="fa fa-user"></i> Profile</a>
                                        </li>
                                    @endif

                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-btn fa-sign-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!-- // END user -->
                        </ul>
                        @endguest
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    <!-- The actual snackbar -->
    <div id="snackbar">{{ Session::has('error') ? Session::get('error')  : '' }}</div>
    </div>
<!-- Scripts -->
@if(Session::has('error'))
    <script>
        // Get the snackbar DIV
        var x = document.getElementById("snackbar")

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show",''); }, 3000);
    </script>
@endif
<!-- Inline Script for colors and config objects; used by various external scripts; -->
<script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        theme: "html",
        skins: {
            "default": {
                "primary-color": "#42a5f5"
            }
        }
    };
</script>
<script src="{{ asset('js/vendor/all.js') }}"></script>
<script src="{{ asset('js/app/app.js') }}"></script>
</body>
</html>
