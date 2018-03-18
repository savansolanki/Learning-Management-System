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
                                <h1 class="text-display-1 margin-none">{{ isset($lesson->title) ? $lesson->title : '' }}</h1>
                            </div>
                        </div>
                        <br>
                        <p class="text-body-2">{!!  isset($lesson->description) ? $lesson->description :  $course->description !!}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">Resources</h4>
                        </div>

                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item active">
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
                            <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                                <div class="panel-heading panel-collapse-trigger">
                                    <h4 class="panel-title">Chapter {{ $key+1}} : {{ $chapter->title }}</h4>
                                </div>
                                <div class="panel-body list-group">
                                    <ul class="list-group list-group-menu">
                                        @foreach($chapter->lessons as $key => $numLesson)
                                            <li class="list-group-item">
                                                @if(isset($read))
                                                        <a class="link-text-color"
                                                           href="{{ route('student.chapter.show ',[ $course->slug,$numLesson->id ]) }}"> {{$key+1}}
                                                            <i class="fa fa-fw fa-circle text-{{ in_array($numLesson->id, $read) ? 'green' : 'brown' }}-300"> </i> {{ $numLesson->title }}
                                                        </a>
                                                @else
                                                    <a class="link-text-color"
                                                       href="{{ route('student.chapter.show ',[ $course->slug,$numLesson->id ]) }}"> {{$key+1}}
                                                        <i class="fa fa-fw fa-circle text-brown-300"> </i> {{ $numLesson->title }}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection