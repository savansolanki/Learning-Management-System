@extends('layouts.app')

@section('content')
    @include('student.headers.courseHeader')
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="page-section padding-top-none">
                        <div class="media media-grid v-middle">
                            <div class="media-body">
                                <h1 class="text-display-1 margin-none">{{ $lesson->title }}</h1>
                            </div>
                        </div>
                        <br>
                        <p class="text-body-2">{!! $lesson->description !!} </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default" data-toggle="panel-collapse">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">Resources</h4>
                        </div>

                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item">
                                    <a class="link-text-color" href="{{ route('student.enrolled_course',$course->slug ) }}">
                                        Curriculum
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a class="link-text-color" href="{{ route('student.questions',$course->slug) }}">
                                        Course Forums
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a class="link-text-color" href="{{ route('student.quiz.questions',$course->slug) }}">
                                        Take Quiz
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @foreach($chapters as $key => $chapter)
                        @if(count($chapter->lessons))
                            @include('student.lessons.partials.chapter')
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
