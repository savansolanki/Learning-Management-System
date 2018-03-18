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
                <h5 class="text-headline">Question :{{ $key+1 }}  {{ $question->question }}
                    <a class="btn btn-primary btn-stroke btn-circle" data-toggle="collapse" href="#collsp{{$key+1}}">
                        <i class="fa fa-edit fa-fw"></i>
                    </a>
                    <a class="btn btn-danger btn-stroke btn-circle"
                       onclick="document.getElementById('delete-form{{$key}}').submit();">
                        <i class="fa fa-trash"></i>
                    </a>
                    <form method="POST" id="delete-form{{$key}}" action="{{route('tutor.quiz.destroy',[$course->slug,$question->id]) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                    </form>
                </h5>
            </div>
        </div>
    </div>
    <div id="collsp{{$key+1}}" class="panel-collapse collapse">
        <div class="panel-body">

            <form method="POST" action="{{ route('tutor.quiz.update',[$course->slug,$question->id]) }}" >
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="question">Question Title</label>
                        <input id="question" type="text" class="form-control "
                               name="question"
                               required autofocus
                               placeholder="Write Your Question Here." value="{{ $question->question }}"/>
                        @if ($errors->has('question'))
                            <span class="help-block">
                                <strong>{{ $errors->first('question') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        {!! Form::radio('correct_answer',1, $question->correct_answer == 1 ? 'true' : '') !!}
                                    </span>
                                    <input id="choice_1" type="text" class="form-control"
                                           name="choice_1"
                                           required autofocus placeholder="Choice 1" value="{{ $question->choice_1 }}"/>
                                    @if ($errors->has('choice_1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('choice_1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        {!! Form::radio('correct_answer',2 ,  $question->correct_answer == 2 ? 'true' : '') !!}
                                    </span>
                                    <input id="choice_2" type="text" class="form-control"
                                           name="choice_2"
                                           required autofocus placeholder="Choice 2"  value="{{ $question->choice_2 }}"/>
                                    @if ($errors->has('choice_2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('choice_2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        {!! Form::radio('correct_answer',3 ,  $question->correct_answer == 3 ? 'true' : '') !!}
                                    </span>
                                    <input id="choice_3" type="text" class="form-control"
                                           name="choice_3"
                                           required autofocus placeholder="Choice 3"  value="{{ $question->choice_3 }}"/>
                                    @if ($errors->has('choice_3'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('choice_3') }}</strong>
                                        </span>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        {!! Form::radio('correct_answer',4, $question->correct_answer == 4 ? 'true' : '' ) !!}
                                    </span>

                                    <input id="choice_4" type="text" class="form-control"
                                           name="choice_4"
                                           required autofocus placeholder="Choice 4"  value="{{ $question->choice_4 }}"/>
                                    @if ($errors->has('choice_4'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('choice_4') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success pull-left">Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>