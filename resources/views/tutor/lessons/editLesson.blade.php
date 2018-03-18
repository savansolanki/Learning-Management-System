@extends('layouts.app')

@section('content')
    <div class="parallax bg-white page-section third">
        <div class="container parallax-layer" data-opacity="true"
             style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
            <div class="media v-middle media-overflow-visible">
                <div class="media-left">
                    <image src="/uploads/course_image/{{ $course->course_image }}" style="height: 80px"></image>
                </div>
                <div class="media-body">
                    <div class="text-headline">{{ $course->title }}</div>
                </div>
                <div class="media-right">
                    <a class="btn btn-danger"  onclick="document.getElementById('lesson-delete-form').submit();" ><i class="fa fa-trash"> </i> &nbsp;&nbsp;Delete</a>
                </div>
                <form method="POST" id="lesson-delete-form" action="{{ route('tutor.lesson.destroy', [
                        'course' => $course->slug,
                        'lesson' => $lesson->id
                        ]) }}"
                >
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="page-section padding-top-none">
                        <form id="lesson"
                              action="{{ route('tutor.lesson.update',[$course->slug,$lesson->id]) }}"
                              method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}
                            <div class="panel-body">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} ">
                                    <label for="title">Title</label>
                                    <input id="title" type="text"
                                           class="form-control" name="title"
                                           value="{{ $lesson->title}}" required
                                           autofocus
                                           placeholder="e.g. Learn Laravel 5.5 From Scratch"/>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }} ">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                              class="form-control summernote"
                                              id="description" >{{ $lesson->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('resource') ? ' has-error' : '' }} ">
                                    <label for="material">Upload Files</label>
                                    <input type="file" name="resource"
                                           class="form-group">
                                    @if ($errors->has('resource'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('resource') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button class="btn  btn-success  pull-right"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    @foreach($chapters as $key => $chapter)
                        @include('tutor.lessons.partials.chapter')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
