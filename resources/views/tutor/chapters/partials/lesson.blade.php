<div class="list-group-item media active"
     data-target="{{ route('tutor.chapter.show',[ $course->slug,$lesson->id ])  }}">
    <div class="media-left">
        <div class="text-crt">{{ $key+1 }}</div>
    </div>
    <div class="media-body">
        {{-- Read(text-grey-300) Active(text-blue-300) --}}
        <i class="fa fa-fw fa-circle text-green-300"> </i>
        {{ $lesson->title }}
    </div>
    <div class="media-right">
        <a href="{{ route('tutor.lesson.edit',[ $course->slug,$lesson->id ]) }}" title="Edit Lesson">
            <button class="btn btn-info btn-stroke  " style="height: 22px;line-height: 0px;">
                Edit
            </button>
        </a>
        {{--<div class="width-100 text-right text-caption">2:03 min</div>--}}
    </div>
</div>