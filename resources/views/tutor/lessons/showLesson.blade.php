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
                @if($course->user_id == auth()->id())
                    <div class="media-right">
                        <a class="btn btn-primary"
                           href="{{ route('tutor.lesson.edit',[ $course->slug,$lesson->id ]) }}"><i
                                    class="fa fa-edit"></i>Edit</a>
                    </div>
                @endif
                @if($lesson->resource != NULL)
                    <div class="media-right">
                        <a class="btn btn-success" href="\storage\material\{{$lesson->resource}}" download="material\{{$lesson->resource}}" ><i class="fa fa-download"></i> &nbsp; Download Resource </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
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
                        <p class="text-body-2">{!! $lesson->description !!}</p>
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
