@extends('layouts.app')

@section('content')
    @include('student.headers.header')
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="row" data-toggle="isotope">
                        <div class="item col-xs-12 col-lg-6">
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="panel-heading">
                                    <h4 class="text-headline margin-none">My Courses</h4>
                                    <p class="text-subhead text-light">Your recent courses</p>
                                </div>
                                <ul class="list-group">
                                    @if(count($enrolledCourses))
                                        @foreach($enrolledCourses as $course)
                                            <li class="list-group-item media v-middle">
                                                <div class="media-body">
                                                    <a href="{{ route('student.enrolled_course',$course->slug ) }}"
                                                       class="text-subhead list-group-link">{{ $course->title }}</a>
                                                </div>
                                                <div class="media-right">
                                                    <div class="progress progress-mini width-100 margin-none">
                                                        <div class="progress-bar progress-bar-green-300"
                                                             role="progressbar"
                                                             aria-valuenow="{{ isset($readCourseLessons[$course->id]) ? ($readCourseLessons[$course->id]->count()/$course->lessons_count)*100 : 0 }}"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100" style="width: 45%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item media v-middle text-center">
                                            Sorry You Have No Courses
                                        </li>
                                    @endif
                                </ul>
                                <div class="panel-footer text-right">
                                    <ul class="pagination margin-top-none pull-left">
                                        {{ $enrolledCourses->links() }}
                                    </ul>
                                </div>
                                <div class="panel-footer text-right">
                                    <a href="{{ url('student/enroll ') }}"
                                       class="btn btn-white paper-shadow relative" data-z="0" data-hover-z="1"
                                       data-animated>View all</a>
                                </div>
                            </div>
                        </div>
                        @if(count($questions))
                            <div class="item col-xs-12 col-lg-6" style="position: absolute; left: 0px; top: 985px;">
                                <h4 class="text-headline margin-none">Forum Activity</h4>
                                <p class="text-subhead text-light">Latest Questions topics &amp; answers </p>
                                <ul class="list-group relative paper-shadow" data-hover-z="0.5" data-animated="">
                                    @foreach($questions as $question)
                                        <li class="list-group-item paper-shadow">
                                            <div class="media v-middle">
                                                <div class="media-left">
                                                    <a href="{{ route('student.profile.show',$question->user->slug) }}">
                                                        <img src="/uploads/profile_image/{{ $question->user->avatar}}"
                                                             alt="person"
                                                             class="img-circle width-40">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{route('student.questions.show',[$question->course->slug,$question->slug ])}}"
                                                       class="link-text-color"
                                                       style="font-size: 14px">{{ $question->title }}</a>
                                                    <div class="text-light">
                                                        Topic: <a
                                                                href="{{route('student.enrolled_course',$question->course->slug ) }}">{{ $question->course->title }}</a>
                                                        &nbsp;
                                                        By:
                                                        <a href="{{route('student.profile.show',$question->user->slug)}}">{{ $question->user->name }}</a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <div class="width-60 text-right">
                                                        <span class="text-caption text-light">{{ $question->created_at->diffForhumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                    <ul class="pagination margin-top-none pull-left">
                                        {{ $questions->links() }}
                                    </ul>

                            </div>
                        @endif
                        @if(count($scores))
                            <div class="item col-xs-12 col-lg-6" style="position: absolute; left: 0px; top: 598px;">
                                <div class="panel panel-default paper-shadow" data-z="0.5">
                                    <div class="panel-heading">
                                        <h4 class="text-headline margin-none">Quizzes</h4>
                                        <p class="text-subhead text-light">Your recent performance</p>
                                    </div>
                                    <ul class="list-group">
                                        @foreach($scores as $score)
                                            @if($score->score > 70)
                                                <li class="list-group-item media v-middle">
                                                    <div class="media-body">
                                                        <h4 class="text-subhead margin-none">
                                                            <a href="{{route('student.enrolled_course',$score->course->slug ) }}"
                                                               class="list-group-link">{{$score->course->title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="media-right text-center">
                                                        <div class="text-display-1 text-green-300">{{ $score->score }}%</div>
                                                        <span class="caption text-light">Great</span>
                                                    </div>
                                                </li>
                                            @elseif($score->score > 40)
                                                <li class="list-group-item media v-middle">
                                                    <div class="media-body">
                                                        <h4 class="text-subhead margin-none">
                                                            <a href="{{route('student.enrolled_course',$score->course->slug ) }}"
                                                               class="list-group-link">{{$score->course->title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="media-right text-center">
                                                        <div class="text-display-1">{{ $score->score }}%</div>
                                                        <span class="caption text-light">Good </span>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="list-group-item media v-middle">
                                                    <div class="media-body">
                                                        <h4 class="text-subhead margin-none">
                                                            <a href="{{route('student.enrolled_course',$score->course->slug ) }}"
                                                               class="list-group-link">{{$score->course->title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="media-right text-center">
                                                        <div class="text-display-1 text-red-300">{{ $score->score }}%</div>
                                                        <span class="caption text-light">Failed</span>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <br/>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">My Account</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item active"><a class="link-text-color"
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
            </div>
        </div>
    </div>
@endsection
