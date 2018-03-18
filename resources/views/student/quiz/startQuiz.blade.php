@extends('layouts.app')

@section('content')
    @include('student.headers.courseHeader')
    <div class="container">

        <div class="page-section">
            <div class="row">

                <div class="col-md-9">
                    <div class="panel panel-default paper-shadow" data-z="0.5">
                        <div class="panel-heading">
                            <h4 class="text-headline">Note </h4>
                        </div>
                        <div class="panel-body">
                            <p> <strong>Total Questions {{ $course->quiz_questions_count }}</strong>
                                <li>All question are compulsory.</li>
                                <li>Each question carry 1 mark each, no negative marking.</li>
                                <li>Each Question Select answer and Click on Submit to Save Answer</li>
                                <li>Click on Next Question for next question</li>
                                <li>Don't Click on Back Button</li>
                                <li>Only One Attemp for each question</li>
                            </p>
                        </div>
                        <div class="panel-footer">
                            <div class="text-right">
                                <a class="btn btn-success" href="{{ route('student.quiz.show',$course->slug) }}"><i class="fa fa-chevron-right fa-fw"></i> Start Quiz</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" >
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">Resources</h4>
                        </div>

                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item">
                                    <a class="link-text-color "
                                       href="{{ route('student.enrolled_course',$course->slug ) }}">
                                        Curriculum
                                    </a>
                                </li>
                                <li class="list-group-item ">
                                    <a class="link-text-color" href="{{ route('student.questions',$course->slug) }}">
                                        Course Forums
                                    </a>
                                </li>
                                <li class="list-group-item active">
                                    <a class="link-text-color" href="{{ route('student.quiz.questions',$course->slug) }}">
                                        Take Quiz
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection