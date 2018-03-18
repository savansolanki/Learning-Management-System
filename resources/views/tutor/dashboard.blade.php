@extends('layouts.app')

@section('content')
    @include('tutor.headers.header')
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
                                    @if(count($courses))
                                        @foreach($courses as $course)
                                            <li class="list-group-item media v-middle">
                                                <div class="media-body">
                                                    <a href="{{ route('tutor.course.show',$course->slug ) }}"
                                                       class="text-subhead list-group-link">{{ $course->title }}</a>
                                                    <div class="pull-right">
                                                        <span class="badge">Total Student : {{ count($course->enrolledUser )}}</span>
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
                                        {{ $courses->links() }}
                                    </ul>
                                </div>
                                <div class="panel-footer text-right">
                                    <a href="{{ route('tutor.course.index') }}"
                                       class="btn btn-white paper-shadow relative" data-z="0" data-hover-z="1"
                                       data-animated>View all</a>
                                    <a href="{{ route('tutor.course.create') }}"
                                       class="btn btn-primary paper-shadow relative" data-z="0" data-hover-z="1"
                                       data-animated>CREATE COURSE <i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        @if(count($questions))
                            <div class="item col-xs-12 col-lg-6">
                                <div class="s-container">
                                    <h4 class="text-headline margin-none">Questions</h4>
                                    <p class="text-subhead text-light">Latest student questions </p>
                                </div>
                                <div class="panel panel-default">
                                    <ul class="list-group">
                                        @foreach($questions as $question)
                                            <li class="list-group-item">
                                                <div class="media v-middle margin-v-0-10">
                                                    <div class="media-body">
                                                        <p class="text-subhead">
                                                            <a href="{{route('student.profile.show',$question->user->slug)}}">
                                                                <img src="/uploads/profile_image/{{ $question->user->avatar}}"
                                                                     alt="person"
                                                                     class="width-30 img-circle"/>
                                                            </a> &nbsp;
                                                            <a href="{{ route('student.profile.show',$question->user->slug) }}">{{ $question->user->name }}</a>
                                                            <span class="text-caption text-light">{{ $question->created_at->diffForhumans() }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="media-right">
                                                        <div class="width-50 text-right">
                                                            <a href="{{route('student.questions.show',[$question->course->slug,$question->slug ])}}"
                                                               class="btn btn-white btn-xs"><i
                                                                        class="fa fa-reply"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="link-text-color"
                                                   href="{{route('student.questions.show',[$question->course->slug,$question->slug ])}}">
                                                    <p style="font-size: 15px">{{ $question->title }}</p></a>
                                                <p class="text-light"><span class="caption">Course:</span> <a
                                                            href="{{route('tutor.course.show',$question->course->slug )}}">{{ $question->course->title }}</a>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul class="pagination margin-top-none pull-left">
                                        {{ $questions->links() }}
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if(isset($course->enrolledUser))
                            <div class="item col-xs-12 col-lg-6">
                                <div class="panel panel-default paper-shadow" data-z="0.5">
                                    <div class="panel-heading">
                                        <div class="media v-middle">
                                            <div class="media-body">
                                                <h4 class="text-headline margin-none">Students</h4>
                                                <p class="text-subhead text-light">List of Enrolled Students </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-subhead v-middle">
                                            <tbody>
                                            @foreach($courses as $course)
                                                @foreach($course->enrolledUser as $user)
                                                    <tr>
                                                        <td class="text-left"><a
                                                                    href="{{route('student.profile.show',$user->slug)}}">{{ $user->name }}</a>
                                                        </td>
                                                        <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                                        <td class="text-right"><a href="{{ route('tutor.studentList.show',$course->slug) }}">{{ $course->title }} </a></td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <br/>
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
                                                                      href="{{  route('tutor.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{ route('tutor.course.index') }}">My Courses</a>
                                </li>
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{ route('tutor.profile')}}">Profile</a></li>
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
