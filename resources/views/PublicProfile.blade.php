@extends('layouts.app')

@section('content')
    <div class="parallax overflow-hidden bg-blue-400 page-section third">
        <div class="container parallax-layer" data-opacity="true"
             style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
            <div class="media v-middle">
                <div class="media-left text-center">
                    <a href="">
                        <img src="/uploads/profile_image/{{ $user->avatar }}" alt="people" class="img-circle width-80">
                    </a>
                </div>
                <div class="media-body">
                    <h1 class="text-white text-display-1 margin-v-0">{{ $user->name }}</h1>
                </div>
                <div class="media-right">
                    <span class="label bg-blue-500">{{ $user->role == 0 ? 'Student' : 'Instructor'}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="page-section">
            <div class="row">
                <div class="col-md-9">

                    <div class="media media-grid media-clearfix-xs">
                        <div class="media-left">
                            <div class="width-200 width-auto-xs">
                                <div class="panel panel-default text-center paper-shadow" data-z="0.5">
                                    <img src="/uploads/profile_image/{{ $user->avatar }}" alt="person"
                                         class="width-100pc">
                                    <div class="panel-body">
                                        <a class="text-headline">{{ $user->name }}</a>
                                    </div>
                                    <hr>
                                    <div class="panel-body">
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                @if($user->role == 0)
                                    @if( $user->student_profile )
                                        <div class="panel panel-default">
                                            <ul class="list-group text-subhead">
                                                @if($user->student_profile->web)
                                                    <li class="list-group-item">
                                                        <div class="media v-middle">
                                                            <div class="media-left">
                                                                <i class="fa fa-link fa-fw "></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <a href="{{ $user->student_profile->web}}"
                                                                   class="link-text-color">/{{ $user->student_profile->web  }}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($user->student_profile->google)
                                                    <li class="list-group-item">
                                                        <div class="media v-middle">
                                                            <div class="media-left">
                                                                <i class="fa fa-google-plus fa-fw text-red-800"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <a href="{{  'https://plus.google.com/'.$user->student_profile->google }}"
                                                                   class="link-text-color">/{{ $user->student_profile->google }}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($user->student_profile->linkedin)
                                                    <li class="list-group-item">
                                                        <div class="media v-middle">
                                                            <div class="media-left">
                                                                <i class="fa fa-linkedin fa-fw text-blue-800"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <a href="{{ 'http://www.linkedin.com/'.$user->student_profile->linkedin }}"
                                                                   class="link-text-color">/{{ $user->student_profile->linkedin}}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($user->student_profile->youtube)
                                                    <li class="list-group-item">
                                                        <div class="media v-middle">
                                                            <div class="media-left">
                                                                <i class="fa fa-youtube-play fa-fw text-red-800"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <a href="{{'http://www.youtube.com/'.$user->student_profile->youtube }}"
                                                                   class="link-text-color">/{{ $user->student_profile->youtube }}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                @else
                                    @if( $user->tutor_profile)
                                        <div class="panel panel-default">
                                            <ul class="list-group text-subhead">
                                                @if($user->tutor_profile->web)
                                                    <li class="list-group-item">
                                                        <div class="media v-middle">
                                                            <div class="media-left">
                                                                <i class="fa fa-link fa-fw "></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <a href="{{ $user->tutor_profile->web}}"
                                                                   class="link-text-color">/{{ $user->tutor_profile->web  }}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($user->tutor_profile->google)
                                                    <li class="list-group-item">
                                                        <div class="media v-middle">
                                                            <div class="media-left">
                                                                <i class="fa fa-google-plus fa-fw text-red-800"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <a href="{{  'https://plus.google.com/'.$user->tutor_profile->google }}"
                                                                   class="link-text-color">/{{ $user->tutor_profile->google }}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($user->tutor_profile->linkedin)
                                                    <li class="list-group-item">
                                                        <div class="media v-middle">
                                                            <div class="media-left">
                                                                <i class="fa fa-linkedin fa-fw text-blue-800"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <a href="{{ 'http://www.linkedin.com/'.$user->tutor_profile->linkedin }}"
                                                                   class="link-text-color">/{{ $user->tutor_profile->linkedin}}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($user->tutor_profile->youtube)
                                                    <li class="list-group-item">
                                                        <div class="media v-middle">
                                                            <div class="media-left">
                                                                <i class="fa fa-youtube-play fa-fw text-red-800"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <a href="{{'http://www.youtube.com/'.$user->tutor_profile->youtube }}"
                                                                   class="link-text-color">/{{ $user->tutor_profile->youtube }}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                        @if($user->role == 0)
                            <div class="media-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-headline">
                                            Headline
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <p>{{ $user->student_profile ? $user->student_profile->headline : 'Nothing to Display' }}</p>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-headline">
                                            About the Student
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <p> {{ $user->student_profile ? $user->student_profile->biography : 'Nothing to Display' }} </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="media-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-headline">
                                            Headline
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <p> {{ $user->tutor_profile ? $user->tutor_profile->headline : 'Nothing to Display' }} </p>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-headline">
                                            About the Instructor
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <p> {{ $user->tutor_profile ? $user->tutor_profile->biography : 'Nothing to Display' }} </p>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="text-headline">
                                            {{$user->name}}'s Courses
                                        </h4>
                                    </div>
                                    <div class="list-group">
                                        @isset($user->tutorCourses)
                                            @foreach($user->tutorCourses as $course)
                                                <div class="list-group-item">
                                                    <div class="media media-clearfix-xs">
                                                        <div class="media-body">
                                                            <h3 class="margin-v-5-0">
                                                                <a href="{{ route('tutor.course.show',$course->slug ) }}">
                                                                    {{ $course->title }}
                                                                </a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if(Auth::user()->role == 0)
                    <div class="col-md-3">
                        <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                            <div class="panel-heading panel-collapse-trigger">
                                <h4 class="panel-title">My Account</h4>
                            </div>
                            <div class="panel-body list-group">
                                <ul class="list-group list-group-menu">
                                    <li class="list-group-item"><a class="link-text-color"
                                                                   href="{{  route('student.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="list-group-item"><a class="link-text-color"
                                                                   href="{{ url('student/enroll') }}">My Courses</a>
                                    </li>
                                    <li class="list-group-item"><a class="link-text-color"
                                                                   href="{{ route('student.profile',str_slug( Auth::user()->name)) }}">Profile</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a class="link-text-color" href="{{ route('logout') }}"
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
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-3">
                        <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                            <div class="panel-heading panel-collapse-trigger">
                                <h4 class="panel-title">My Account</h4>
                            </div>
                            <div class="panel-body list-group">
                                <ul class="list-group list-group-menu">
                                    <li class="list-group-item"><a class="link-text-color"
                                                                   href="{{  route('tutor.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="list-group-item"><a class="link-text-color"
                                                                   href="{{ route('tutor.course.index') }}">My
                                            Courses</a></li>
                                    <li class="list-group-item"><a class="link-text-color" href="">Profile</a></li>
                                    <li class="list-group-item"><a class="link-text-color" href="{{ route('logout') }}"
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
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection