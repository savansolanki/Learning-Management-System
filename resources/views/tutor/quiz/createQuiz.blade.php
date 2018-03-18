@extends('layouts.app')

@section('content')
    @include('tutor.headers.header')
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="tabbable paper-shadow relative" data-z="0.5">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" tabindex="0" style="overflow: hidden; outline: none;">
                            <li class=""><a href="{{ route('tutor.course.edit',$course->slug ) }}"><i
                                            class="fa fa-fw fa-lock"></i> Course </a></li>
                            <li class=""><a href="{{ route('tutor.chapter.create',$course->slug) }}"><i
                                            class="fa fa-fw fa-credit-card"></i> Chapters </a></li>
                            <li class="active"><a href="{{ route('tutor.quiz',$course->slug ) }}"><i
                                            class="fa fa-mortar-board"></i> Quiz </a></li>
                        </ul>
                        <!-- // END Tabs -->
                        <!-- Panes -->
                        <div class="tab-content">
                            <div id="course" class="tab-pane active">
                                <div id="chapter" class="tab-pane active">
                                    <div class="media v-middle s-container">
                                        <div class="media-body">
                                            <h5 class="text-subhead text-light"> {{ count($course->quizQuestions) }}
                                                Questions</h5>
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-primary paper-shadow relative" data-toggle="collapse"
                                               data-target="#demo">Add New Question</a>
                                        </div>
                                        {{--Edit Chapter --}}
                                        <div id="demo" class="collapse form-group ">
                                            <form action="{{ route('tutor.quiz',$course->slug) }}"
                                                  method="POST" class="form-group">

                                                <div class="form-group">
                                                    <label for="question">Question Title</label>
                                                    <input id="question" type="text" class="form-control "
                                                           name="question"
                                                           required autofocus
                                                           placeholder="Write Your Question Here."/>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                    {!! Form::radio('correct_answer',1) !!}
                                                            </span>
                                                                <input id="choice_1" type="text" class="form-control"
                                                                       name="choice_1"
                                                                       required autofocus placeholder="Choice 1"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                    {!! Form::radio('correct_answer',2) !!}
                                                            </span>
                                                                <input id="choice_2" type="text" class="form-control"
                                                                       name="choice_2"
                                                                       required autofocus placeholder="Choice 2"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                    {!! Form::radio('correct_answer',3) !!}
                                                            </span>
                                                                <input id="choice_3" type="text" class="form-control"
                                                                       name="choice_3"
                                                                       required autofocus placeholder="Choice 3"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                    {!! Form::radio('correct_answer',4) !!}
                                                            </span>
                                                                <input id="choice_4" type="text" class="form-control"
                                                                       name="choice_4"
                                                                       required autofocus placeholder="Choice 4"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-success pull-left">Add
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        {{--Edit Ends Chapter --}}
                                        <br>
                                        @include('layouts.error')
                                    </div>
                                    <div class="nestable" id="nestable-handles-primary">
                                        <ul class="nestable-list">
                                            @foreach($course->quizQuestions as $key => $question)
                                                @include('tutor.quiz.partials.questions')
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // END Panes -->
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
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{  route('tutor.dashboard') }}">Dashboard</a></li>
                                <li class="list-group-item active"><a class="link-text-color"
                                                                      href="{{ route('tutor.course.index') }}">My
                                        Courses</a></li>
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{ route('tutor.profile')}}">Profile</a></li>
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
