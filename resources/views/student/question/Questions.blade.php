@extends('layouts.app')

@section('content')
    @include('student.headers.courseHeader')
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">

                    <div class="page-section padding-top-none">
                        <div class="media v-middle">
                            <div class="media-body">
                                <h1 class="text-display-1 margin-none">Questions and Answers</h1>
                            </div>
                            <div class="media-right">
                                <a class="btn btn-success paper-shadow relative" data-toggle="modal"
                                   data-target="#myModal" data-z="0.5" data-hover-z="1" data-animated=""><i
                                            class="fa fa-fw fa-plus"></i> New Topic</a>
                            </div>
                            <br>
                            <!-- The Modal -->
                            <div class="modal fade {{ count($errors) ? 'in' : '' }}" id="myModal"
                                 style="display: {{ count($errors) ? 'block' : 'none' }} ; "
                                 aria-hidden="{{ count($errors) ? 'true' : 'false' }}">

                                <div class="modal-dialog" style="align-items: center; margin-top: 10px">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ask your Query</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;
                                            </button>
                                        </div>
                                        <form action="{{ route('student.questions.store',$course->slug) }}"
                                              method="POST">
                                        {{ csrf_field() }}
                                        <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-group  {{ $errors->has('title') ? ' has-error' : '' }} ">
                                                    <label for="title">Title</label>
                                                    <input id="title" type="text" class="form-control used" name="title"
                                                           value="{{ old('title') }}" required autofocus
                                                           placeholder="Whats your question ? Be Specific"/>
                                                    @if ($errors->has('title'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }} ">
                                                    <textarea name="body" id="body" cols="30" rows="6"
                                                              class="summernote"
                                                              placeholder="Write Something"></textarea>
                                                    @if ($errors->has('body'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('body') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    Submit
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </div>

                    <div class="panel panel-default paper-shadow" data-z="0.5">
                        <ul class="list-group">
                            @if(isset($courseQuestions))
                                @foreach($courseQuestions as $key => $question)
                                    <li class="list-group-item media v-middle">
                                        <div class="media-left">
                                            <div class="icon-block half img-circle bg-grey-300">
                                                <i class="fa fa-file-text text-white"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-subhead margin-none">
                                                <a href="{{ route('student.questions.show',[$course->slug,$question->slug ]) }}"
                                                   class="link-text-color">{{$question->title}}
                                                </a>
                                            </h4>
                                            <div class="text-light text-caption">
                                                posted by &nbsp;
                                                <a href="{{route('student.profile.show',$question->user->slug)}}">
                                                    <img src="/uploads/profile_image/{{ $question->user->avatar }}"
                                                         alt="person"
                                                         class="img-circle width-20"> {{ $question->user->name }}</a>
                                                &nbsp; | <i class="fa fa-clock-o fa-fw"></i> {{ $question->updated_at->diffForHumans() }}
                                            </div>

                                        </div>
                                        @if(auth()->id() == $question->user->id)
                                            <div class="media-right">
                                                <a class="btn btn-primary" data-toggle="collapse"
                                                   href="#collsp{{$key+1}}">
                                                    <i class="fa fa-edit fa-fw"></i> Edit
                                                </a>
                                            </div>

                                        <div class="media-right">
                                            <a class="btn btn-danger" onclick="document.getElementById('delete-form{{$key}}').submit();">
                                                <i class="fa fa-trash fa-fw"></i> Delete</a>
                                        </div>
                                        @endif
                                        <div class="media-right">

                                            <a href="{{ route('student.questions.show',[$course->slug,$question->slug ]) }}" class="btn btn-white text-light"><i
                                                        class="fa fa-comments fa-fw"></i>{{ $question->course_answers_count }}</a>
                                        </div>
                                        <br>
                                        @if(auth()->id() == $question->user->id)
                                            <form method="POST" id="delete-form{{$key}}" action="{{ route('student.questions.destroy',
                                            [$course->slug,$question->slug ]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field() }}
                                            </form>
                                            <div id="collsp{{$key+1}}" class="collapse form-group ">
                                                <form action="{{ route('student.questions.update',[$course->slug,$question->slug]) }}"
                                                      method="POST" class="form-group">
                                                    <div class="form-group  {{ $errors->has('title') ? ' has-error' : '' }} ">
                                                        <label for="title">Title</label>
                                                        <input id="title" type="text" class="form-control used"
                                                               name="title"
                                                               value="{{ $question->title }}" required autofocus
                                                               placeholder="Whats your question ? Be Specific"/>
                                                        @if ($errors->has('title'))
                                                            <span class="help-block">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }} ">
                                                    <textarea name="body" id="body" cols="30" rows="6"
                                                              class="summernote"
                                                              placeholder="Write Something">{{ $question->body }}</textarea>
                                                        @if ($errors->has('body'))
                                                            <span class="help-block">
                                                        <strong>{{ $errors->first('body') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    <button type="submit" class="btn btn-success pull-right">Update
                                                    </button>
                                                </form>
                                            </div>

                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item media v-middle">
                                    <div class="media-left">
                                        <div class="icon-block half img-circle bg-grey-300">
                                            <i class="fa fa-file-text text-white"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="text-subhead margin-none">
                                            No Question Found
                                        </h4>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <ul class="pagination margin-top-none">
                        {{ $courseQuestions->links() }}
                    </ul>
                </div>
                <div class="col-md-3">
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
                                <li class="list-group-item active">
                                    <a class="link-text-color " href="{{ route('student.questions',$course->slug) }}">
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
                </div>
            </div>
        </div>
    </div>
@endsection