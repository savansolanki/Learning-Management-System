<div class="panel panel-default curriculum paper-shadow" data-z="0.5">
    <div class="panel-heading panel-heading-gray collapsed"
         data-toggle="collapse" data-target="#curriculum-1{{$key+1}}"
         aria-expanded="false">
        <div class="media">
            <div class="media-left">
                <span class="icon-block img-circle bg-green-300 half text-white">
                    <i class="fa fa-graduation-cap"></i>
                </span>
            </div>
            <div class="media-body">
                <h4 class="text-headline">Chapter :{{ $key+1 }}  {{ $chapter->title }}

                    <a class="btn btn-primary btn-stroke btn-circle" data-toggle="collapse" href="#collsp{{$key+1}}">
                        <i class="fa fa-edit fa-fw"></i>
                    </a>
                    <a class="btn btn-danger btn-stroke btn-circle"
                       onclick="document.getElementById('delete-form{{$key}}').submit();">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a class="btn btn-white" data-toggle="collapse" href="#coll{{$key+1}}">
                        <i class="fa fa-pencil fa-fw"></i> Add Lecture
                    </a>
                    <form method="POST" id="delete-form{{$key}}" action="{{ route('tutor.chapter.destroy', [
                        'course' => $course->slug,
                        'chapter' => $chapter->id
                        ]) }}"
                    >
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                    </form>
                </h4>
            </div>
        </div>
        <span class="collapse-status collapse-open">Open</span>
        <span class="collapse-status collapse-close">Close</span>
    </div>
    <div id="collsp{{$key+1}}" class="panel-collapse collapse">
        <div class="panel-body">

            <form method="POST" action="{{ route('tutor.chapter.update', [
                    'course' => $course->slug,
                    'chapter' => $chapter->id
                ]) }}"
            >
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH">
                <div class="panel-body">
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} ">
                        <label for="title">Title</label>
                        <input id="title" type="text"
                               class="form-control" name="title"
                               value="{{ $chapter->title }}" required
                               autofocus
                               placeholder="e.g. Learn Laravel 5.5 From Scratch"/>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit"
                            class="btn  btn-success  pull-right">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="coll{{$key+1}}" class="panel-collapse collapse">
        <div class="panel-body">
            <form id="lesson" action="{{ url('tutor/'.$course->slug.'/lesson?chapter='.$chapter->id) }}"
                  method="POST" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} ">
                        <label for="title">Title</label>
                        <input id="title" type="text"
                               class="form-control" name="title"
                               value="{{ old('title') }}" required
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
                                  class="summernote"
                                  id="description">{{ old('description') }}</textarea>
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
                    <button class="btn  btn-success  pull-right">
                        Submit
                    </button>
                    <input type="hidden" name="_token"
                           value="{{ csrf_token() }}">
                </div>
            </form>
        </div>
    </div>
    <div class="list-group collapse" id="curriculum-1{{$key+1}}"
         aria-expanded="false" style="height: 0px;">
        @foreach($chapter->lessons as $key => $lesson)
            @include('tutor.chapters.partials.lesson')
        @endforeach
    </div>
</div>