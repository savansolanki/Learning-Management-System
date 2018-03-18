@extends('layouts.app')

@section('content')
    @include('student.headers.courseHeader')
    <div class="container">

        <div class="page-section">
            <div class="row">

                <div class="col-md-9">

                    <div class="text-subhead-2 text-light">Question {{ $questions->currentPage() }}
                        of {{ $questions->total() }}</div>
                    @foreach($questions as $question)
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-heading">
                                <p class="text-body-2">{!! $question->question !!}</p>
                            </div>
                            <form action="{{ route('student.quiz.store',[$course->slug,$question->id]) }}"
                                  method="POST" class="form-group">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    1). <input type="radio" name="answer"
                                                               value="1"> {{ $question->choice_1 }}<br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    2). <input type="radio" name="answer"
                                                               value="2"> {{ $question->choice_2 }}<br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    3). <input type="radio" name="answer"
                                                               value="3"> {{ $question->choice_3 }}<br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    4). <input type="radio" name="answer"
                                                               value="4"> {{ $question->choice_4 }}<br>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                    @include('layouts.error')
                                </div>
                                <div class="panel-footer">
                                    <a href="{{ route('student.quiz.submit',$course->slug) }}" class="btn btn-danger pull-left"><i
                                                class="fa fa-chevron-right fa-fw"></i>
                                        Finish Assessment
                                    </a>
                                    <div class="text-right">
                                        <a href="{{ $questions->previousPageUrl() }}" class="btn btn-primary"><i
                                                    class="fa fa-chevron-left fa-fw"></i>
                                            Previous Question
                                        </a>
                                        <a href="{{ $questions->nextPageUrl() }}" class="btn btn-primary"><i
                                                    class="fa fa-chevron-right fa-fw"></i>
                                            Next Question
                                        </a>
                                        @isset($answers)
                                            @if(!in_array($question->id,$answers))
                                                <button type="submit" class="btn btn-success"><i
                                                            class="fa fa-save fa-fw"></i>
                                                    Save
                                                    Answer
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-success" disabled=""><i
                                                            class="fa fa-save fa-fw"></i>
                                                    Save
                                                    Answer
                                                </button>
                                            @endif
                                        @endisset
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-3" style="margin-top: 26px">
                    <div class="panel panel-default margin-none">
                        <div class="panel-heading">
                            <h4 class="panel-title">Questions</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group">
                                @foreach($course->quizQuestions as $key => $quizQuestion)
                                    <li class="list-group-item">
                                        <div class="media v-middle">
                                            <div class="media-left">
                                                @if(in_array($quizQuestion->id,$answers))
                                                    <a href="{{$questions->url($key+1)}}">
                                                        <div class="icon-block s30 bg-green-400 text-white">{{ $key+1 }}</div>
                                                    </a>
                                                @elseif($questions->currentPage()==$key+1)
                                                    <a href="{{$questions->url($key+1)}}">
                                                        <div class="icon-block s30 bg-blue-400 text-white">{{ $key+1 }}</div>
                                                    </a>
                                                @else
                                                    <a href="{{$questions->url($key+1)}}">
                                                        <div class="icon-block s30 bg-brown-400 text-white">{{ $key+1 }}</div>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="media-body">
                                                <p>{{ substr($quizQuestion->question,0,60) }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection