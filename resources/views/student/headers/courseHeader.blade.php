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
            @if(isset($lesson))
                @if($lesson->resource != NULL)
                    <div class="media-right">
                        <a class="btn btn-success" href="\storage\material\{{$lesson->resource}}"
                           download="material\{{$lesson->resource}}"><i class="fa fa-download"></i> &nbsp; Download
                            Resource </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>