@extends('layouts.app')

@section('content')
    @include('tutor.headers.header')
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="tabbable paper-shadow relative" data-z="0.5">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" tabindex="0" style="overflow: hidden; outline: none;">
                            <li class="active"><a href="#course" data-toggle="tab" aria-expanded="true"><i
                                            class="fa fa-fw fa-lock"></i> Course </a></li>
                        </ul>
                        <!-- // END Tabs -->
                        <!-- Panes -->
                        <div class="tab-content">
                            <div id="course" class="tab-pane active">
                                <div id="course" class="tab-pane active">
                                    <form action="{{ route('tutor.course.store') }}" method="POST"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group form-control-material {{ $errors->has('title') ? ' has-error' : '' }} ">
                                            <input id="title" type="text" class="form-control used" name="title"
                                                   value="{{ old('title') }}" required autofocus
                                                   placeholder="e.g. Learn Laravel 5.5 From Scratch"/>
                                            <label for="title">Title</label>
                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }} ">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="6"
                                                      class="summernote"></textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                            <label for="category" class="col-md-4 control-label">Category</label>
                                            <select class="form-control" name="category" id="category" required
                                                    autofocus>
                                                <option value="">-- Select Category --</option>
                                                @foreach( $categories as $category )
                                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sub_title'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('sub_title') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('sub_category') ? ' has-error' : '' }}">
                                            <label for="sub_category" class="col-md-4 control-label">Sub
                                                Category</label>
                                            <select class="form-control" id="sub_category" name="sub_category" required
                                                    autofocus>
                                                <option value="">-- Select Subcategory --</option>
                                            </select>
                                            @if ($errors->has('sub_category'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('sub_category') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                            <label for="level" class="col-md-4 control-label">Level</label>
                                            <select class="form-control" id="level" name="level" required autofocus>
                                                <option value="">-- Select Level --</option>
                                                <option value="beginner">Beginner Level</option>
                                                <option value="intermediate">Intermediate Level</option>
                                                <option value="expert">Expert Level</option>
                                                <option value="all">All Level</option>
                                            </select>
                                            @if ($errors->has('level'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('level') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('question_1') ? ' has-error' : '' }}">
                                            <label for="question_1" class="col-md-4 control-label">What knowledge &
                                                tools are required?</label>

                                            <input id="question_1" type="text" class="form-control" name="question_1"
                                                   required autofocus
                                                   placeholder="Example: You should be able to use PC at a beginner level">
                                            @if ($errors->has('question_1'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('question_1') }}</strong>
                                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('question_2') ? ' has-error' : '' }}">
                                            <label for="question_2" class="col-md-4 control-label">Who should take this
                                                course? </label>

                                            <input id="question_2" type="text" class="form-control" name="question_2"
                                                   required autofocus
                                                   placeholder="Example: Anyone who wants to learn to code">
                                            @if ($errors->has('question_2'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('question_2') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('question_3') ? ' has-error' : '' }}">
                                            <label for="question_3" class="col-md-4 control-label">What will students
                                                achieve after taking your course? </label>

                                            <input id="question_3" type="text" class="form-control" name="question_3"
                                                   required autofocus
                                                   placeholder="Example: Take Photos even in low lights ">
                                            @if ($errors->has('question_3'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('question_3') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('course_image') ? ' has-error' : '' }}">
                                            <label for="course_image" class="col-md-4 control-label">Course
                                                Image </label>
                                            <input type="file" class="custom-file-input" id="course_image"
                                                   name="course_image">
                                            @if ($errors->has('course_image'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('course_image') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                        </div>
                                    </form>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#category').on('change', function () {
                                                var cat_id = $(this).val();
                                                if (cat_id) {
                                                    $.ajax({
                                                        type: 'GET',
                                                        url: '/tutor/ajax-subcategory',
                                                        data: 'cat_id=' + cat_id,
                                                        success: function (html) {
                                                            $('#sub_category').empty();
                                                            $.each(html, function (index, sub_categoryObj) {
                                                                $('#sub_category').append('<option value=" ' + sub_categoryObj.id + ' " > ' + sub_categoryObj.sub_category + ' </option>');
                                                            });
                                                        }
                                                    });
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!-- // END Panes -->
                    </div>
                    <br/>
                    <br/>
                </div>
                <div class="col-md-3">

                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">My Account</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{  route('tutor.dashboard') }}">Dashboard</a></li>
                                <li class="list-group-item active"><a class="link-text-color"
                                                                      href="{{ route('tutor.course.index') }}">My
                                        Courses</a></li>
                                <li class="list-group-item"><a class="link-text-color" href="{{ route('tutor.profile')}}">Profile</a></li>
                                <li class="list-group-item"><a class="link-text-color" href="{{ route('logout') }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection