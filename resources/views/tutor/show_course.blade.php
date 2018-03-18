@extends('layouts.app')

@section('content')

    @include('tutor.headers.course ')

    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">

                <div class="page-section">
                    <div class="width-350 width-300-md width-100pc-xs paragraph-inline">
                        <div class="cover overlay cover-image-full hover" style="height:151px;">
                            <img src="/uploads/course_image/{{ $course->course_image }}"
                                 class="img icon-block height-150">
                        </div>
                    </div>
                    <h3 style="margin-top: 2px">About this Course</h3>
                    <p>
                        {!! $course->description !!}
                    </p>
                    <br>
                </div>

                <div class="page-section">
                    <div class="row">
                        <div class="col-md-7">
                            <h2 class="text-headline margin-none">What you'll learn</h2>
                            <br>
                            <ul class="list-group relative paper-shadow" data-hover-z="0.5" data-animated="">
                                <li class="list-group-item">
                                    <div class="media v-middle">
                                        <div class="media-body text-body-2">
                                            <p class="text-subhead "><strong> What are the requirements? </strong></p>
                                            {{ $course->question_1 }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media v-middle">
                                        <div class="media-body text-body-2">
                                            <p class="text-subhead "><strong> What am I going to get from this
                                                    course?What are the requirements? </strong></p>
                                            {{ $course->question_2 }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media v-middle">
                                        <div class="media-body text-body-2">
                                            <p class="text-subhead "><strong> What is the target audience? </strong></p>
                                            {{ $course->question_3 }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-lg-3 col-md-4">

                <div class="page-section">

                    <!-- .panel -->
                    <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated="">
                        <div class="panel-heading">
                            <h4 class="text-headline">{{ $course->title }}</h4>
                        </div>
                        <div class="panel-body">
                            <p class="text-caption">
                                <i class="fa fa-calendar fa-fw"></i> {{ $course->created_at->toFormattedDateString() }}
                                <br>
                                <i class="fa fa-user fa-fw"></i> Instructor: {{ $course->user->name }}
                                <br>
                                <i class="fa fa-mortar-board fa-fw"></i> Total Students: {{ count($course->enrolledUser) }}
                                <br>
                                <i class="fa fa-check fa-fw"></i> {{ ucfirst($course->level) }} level
                            </p>
                        </div>
                        <hr class="margin-none">
                        @guest
                        <div class="panel-body text-center">
                            <form action="{{ url('student/enroll/'.$course->slug) }}" method="POST">
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-success">Start Course</button>
                            </form>
                        </div>
                        @else
                            @if(Auth::user()->role == 0)
                                <div class="panel-body text-center">
                                    <form action="{{ url('student/enroll/'.$course->slug) }}" method="POST">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-success">Start Course</button>
                                    </form>
                                </div>
                            @else
                                @if(Auth::user()->id == $course->user_id)
                                <div class="panel-body text-center">
                                    <a class="btn btn-white btn-flat paper-shadow relative" data-z="0" data-hover-z="1"
                                       data-animated="" href="{{ route('tutor.course.edit',$course->slug ) }}"><i
                                                class="fa fa-fw fa-pencil"></i> Edit course</a>
                                </div>
                                @else
                                    @endif
                            @endif
                            @endguest
                    </div>
                    <!-- // END .panel -->

                    <!-- .panel -->
                    <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated="">
                        <div class="panel-body">
                            <div class="media v-middle">
                                <div class="media-left">
                                    <img src="/uploads/profile_image/{{ $course->user->avatar }}" alt="About Adrian"
                                         width="60" class="img-circle">
                                </div>
                                <div class="media-body">
                                    <h4 class="text-title margin-none"><a href="{{ route('tutor.profile.show',$course->user->slug) }}">{{ $course->user->name }}</a></h4>
                                    <span class="caption text-light">Biography</span>
                                </div>
                            </div>
                            <br>
                            <div class="expandable expandable-indicator-white expandable-trigger">
                                <div class="expandable-content">
                                    <p> {{ $course->user->tutor_profile ?  $course->user->tutor_profile->biography : '' }}</p>
                                    <div class="expandable-indicator"><i></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- // END .panel -->

                </div>
                <!-- // END .page-section -->

            </div>
        </div>

    </div>
@endsection
