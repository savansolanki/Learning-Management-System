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