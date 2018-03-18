@extends('layouts.app')

@section('content')
    @include('student.headers.header')
    <div class="container">

        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="row" data-toggle="isotope" style="position: relative; height: 1812px;">

                        @if(count($enrolledCourses))
                            @foreach($enrolledCourses as $course)
                                <div class="item col-xs-12 col-sm-6 col-lg-4"
                                     style="position: absolute; left: 0px; top: 0px;">
                                    <div class="panel panel-default paper-shadow" data-z="0.5">

                                        <div class="panel-heading">
                                            <div class="media media-clearfix-xs-min v-middle">
                                                <div class="media-body text-caption text-light">
                                                    Lessons {{ isset($readCourseLessons[$course->id]) ? $readCourseLessons[$course->id]->count() : 0 }}
                                                    of {{ $course->lessons_count }}
                                                </div>

                                                <div class="media-right">
                                                    <div class="progress progress-mini width-100 margin-none">
                                                        <div class="progress-bar progress-bar-blue-600"
                                                             role="progressbar"
                                                             aria-valuenow="{{ isset($readCourseLessons[$course->id]) ? ($readCourseLessons[$course->id]->count()/$course->lessons_count)*100 : 0 }}" aria-valuemin="0" aria-valuemax="100"
                                                             style="width:75%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cover overlay cover-image-full hover" style="height: 100px;">
                                            <img src="/uploads/course_image/{{ $course->course_image }}"
                                                 class="img icon-block height-120">
                                        </div>
                                        <div class="panel-body">
                                            <h4 class="text-headline margin-v-0-10">
                                                <a href="{{ route('student.enrolled_course',$course->slug ) }}">
                                                    {{ $course->title }}
                                                </a>
                                            </h4>
                                        </div>
                                        <hr class="margin-none">
                                        <div class="panel-body">

                                            <a class="btn btn-white btn-flat paper-shadow relative" data-z="0"
                                               data-hover-z="1" data-animated=""
                                               href="{{ route('student.enrolled_course',$course->slug ) }}">Go to
                                                course</a>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="item col-xs-12 col-sm-6 col-lg-4"
                                 style="position: absolute; left: 0px; top: 0px;">
                                <div class="panel panel-default paper-shadow" data-z="0.5">
                                    <div class="panel-heading">
                                        <div class="media media-clearfix-xs-min v-middle">
                                            <div class="media-body text-caption text-light">
                                                Lessons 0 of 0
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="text-headline margin-v-0-10">
                                            Sorry You Don't Have Any Enrolled Course
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <ul class="pagination margin-top-none">
                        {{ $enrolledCourses->links() }}
                    </ul>
                </div>
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
                                <li class="list-group-item active"><a class="link-text-color"
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
            </div>
        </div>
    </div>
@endsection