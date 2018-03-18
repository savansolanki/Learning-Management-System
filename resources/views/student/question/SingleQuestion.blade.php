@extends('layouts.app')

@section('content')
    @include('student.headers.courseHeader')
    <div class="container">

        <div class="page-section">
            <div class="row">
                <div class="col-md-9">

                    <div class="page-section padding-top-none">
                        <div class="media media-overflow-visible s-container">
                            <div class="media-body">
                                <h1 class="text-display-1 margin-top-none">{{ $question->title}}</h1><br>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h4 class="margin-top-none">{!! $question->body !!}</h4>
                                    </div>
                                </div>
                                <p class="text-light text-caption">
                                    posted by
                                    <a href="{{route('student.profile.show',$question->user->slug)}}">
                                        <img src="/uploads/profile_image/{{ $question->user->avatar }}" alt="person"
                                             class="img-circle width-20"> {{ $question->user->name }}</a> &nbsp; | <i
                                            class="fa fa-clock-o fa-fw"></i> {{ $question->created_at->diffForHumans()}}
                                </p>
                                <hr>
                            </div>
                            <div class="media-right">
                                <a href="" class="btn btn-white paper-shadow relative" data-z="0.5" data-hover-z="1"
                                   data-animated=""><i class="fa fa-fw fa-reply"></i> Reply</a>
                            </div>
                        </div>
                    </div>
                    @foreach($courseAnswers as $key =>  $answer)
                        <div class="media s-container">
                            <div class="media-left">
                                <div class="width-70 text-center">
                                    <p>
                                        <a href="{{ route('student.profile.show',$answer->user->slug) }}">
                                            <img src="/uploads/profile_image/{{ $answer->user->avatar}}" alt="people"
                                                 style="width: 60px">
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="text-subhead-2">{{$answer->user->name}}<span
                                                    class="text-caption text-light">- {{$answer->updated_at->diffForhumans()}}</span>
                                            @if(auth()->id() == $answer->user->id)
                                                <a class="btn btn-danger pull-right" data-toggle="collapse"
                                                   onclick="document.getElementById('delete-form{{$key}}').submit();">
                                                    <i class="fa fa-trash fa-fw"></i> Delete
                                                </a>
                                                <a class="btn btn-primary pull-right" data-toggle="collapse"
                                                   href="#collsp{{$key+1}}">
                                                    <i class="fa fa-edit fa-fw"></i> Edit
                                                </a>
                                            @endif
                                        </div>
                                        <p>{{ $answer->body }}</p>
                                        @if(auth()->id() == $answer->user->id)
                                            <form method="POST" id="delete-form{{$key}}" action="{{ route('tutor.answer.destroy',
                                            [$course->slug,$answer->id ]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field() }}
                                            </form>
                                            <div id="collsp{{$key+1}}" class="collapse form-group ">
                                                <form action="{{ route('tutor.answer.update',[$course->slug,$answer->id]) }}"
                                                      method="POST" class="form-group">
                                                    <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }} ">
                                                    <textarea name="body" id="body" cols="30" rows="6"
                                                              class="summernote"
                                                              placeholder="Write Something">{!! $answer->body  !!}</textarea>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-right">
                        <ul class="pagination margin-top-none">
                            {{ $courseAnswers->links() }}
                        </ul>
                    </div>

                    <div class="page-section padding-top-none">
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-heading">
                                <h4 class="text-headline">Post a reply</h4>
                            </div>
                            <div class="panel-body">
                                <form action="{{ url('tutor/'.$course->slug.'/answer?question='.$question->slug) }}"
                                      method="POST">
                                    <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }} ">
                                                    <textarea name="body" id="body" cols="30"
                                                              rows="6"
                                                              class="summernote"
                                                              placeholder="Write Something....."></textarea>
                                        @if ($errors->has('body'))
                                            <span class="help-block">
                                                        <strong>{{ $errors->first('body') }}</strong>
                                                        </span>
                                        @endif
                                    </div>
                                    {{ csrf_field() }}
                                    <div class="text-right">
                                        <button class="btn btn-primary" type="submit">
                                            Post reply <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>

                </div>
                <div class="col-md-3">
                    @if(Auth::user()->role == 0)
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
                                        <a class="link-text-color "
                                           href="{{ route('student.questions',$course->slug) }}">
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
                    @else
                        <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                            <div class="panel-heading panel-collapse-trigger">
                                <h4 class="panel-title">My Account</h4>
                            </div>
                            <div class="panel-body list-group">
                                <ul class="list-group list-group-menu">
                                    <li class="list-group-item"><a class="link-text-color"
                                                                   href="{{  route('tutor.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="list-group-item"><a class="link-text-color"
                                                                   href="{{ route('tutor.course.index') }}">My
                                            Courses</a>
                                    </li>
                                    <li class="list-group-item"><a class="link-text-color"
                                                                          href="{{ route('tutor.profile')}}">Profile</a>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection