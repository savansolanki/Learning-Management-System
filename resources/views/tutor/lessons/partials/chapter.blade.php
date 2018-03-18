<div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
    <div class="panel-heading panel-collapse-trigger">
        <h4 class="panel-title">Chapter {{ $key+1}} {{ $chapter->title }}</h4>
    </div>
    <div class="panel-body list-group">
        <ul class="list-group list-group-menu">
            @foreach($chapter->lessons as $key => $numLesson)
                <li class="list-group-item {{ $numLesson->id==$lesson->id ? 'active' : '' }}"><a class="link-text-color" href="{{ route('tutor.chapter.show',[ $course->slug,$numLesson->id ]) }}">{{ $numLesson->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>