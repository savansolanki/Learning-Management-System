@extends('layouts.app')

@section('content')
    @include('tutor.headers.header')
    <div class="container">

        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="row" data-toggle="isotope" style="position: relative; height: 511px;">
                        @foreach($courses as $course)
                            <div class="item col-xs-12 col-sm-6 col-lg-4"
                                 style="position: absolute; left: 0px; top: 0px;">
                                <div class="panel panel-default paper-shadow" data-z="0.5">

                                    <div class="cover overlay cover-image-full hover" style="height: 150px;">
                                        <img src="/uploads/course_image/{{ $course->course_image }}"
                                             class="img icon-block height-150">
                                    </div>

                                    <div class="panel-body text-center">
                                        <h4 class="text-headline margin-v-0-10"><a
                                                    href="{{ route('tutor.course.show',$course->slug ) }}">{{ $course->title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="item col-xs-12 col-sm-6 col-lg-4"
                             style="position: absolute; left: 0px; top: 341px;">
                            <div class="panel panel-default paper-shadow" data-z="0.5">

                                <div class="cover overlay cover-image-full hover" style="height: 150px;">
                                    <span class="img icon-block height-150 bg-grey-200"></span>
                                    <a href="{{ route('tutor.course.create') }}"
                                       class="padding-none overlay overlay-full icon-block bg-grey-200"
                                       style="height: 150px;">
                                            <span class="v-center">
                                        <i class="fa fa-plus text-grey-600"></i>
                                    </span>
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                    <ul class="pagination margin-top-none">
                        {{ $courses->links() }}
                    </ul>
                    <br>
                    <br>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">My Account</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{  route('tutor.dashboard') }}">Dashboard</a></li>
                                <li class="list-group-item active"><a class="link-text-color"
                                                                      href="{{ route('tutor.course.index') }}">My
                                        Courses</a></li>
                                <li class="list-group-item"><a class="link-text-color" href="{{ route('tutor.profile')}}">Profile</a></li>
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
            </div>
        </div>
    </div>
@endsection