@extends('layouts.app')

@section('content')
    @include('student.headers.header')
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <!-- Tabbable Widget -->
                    <div class="tabbable paper-shadow relative" data-z="0.5">

                        <!-- Tabs -->
                        <ul class="nav nav-tabs" tabindex="0" style="overflow: hidden; outline: none;">
                            <li>
                                <a>
                                    <i class="fa fa-fw fa-lock"></i>
                                    <span class="hidden-sm hidden-xs">Manage Account</span>
                                </a>
                            </li>
                        </ul>
                        <!-- // END Tabs -->

                        <!-- Panes -->
                        <div class="tab-content">
                            <div>
                                <form class="form-horizontal" enctype="multipart/form-data" action="/student/update"
                                      method="POST">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Avatar</label>
                                        <div class="col-md-6">
                                            <div class="media v-middle">
                                                <div class="media-left">
                                                    <div class="icon-block width-100 bg-grey-100">
                                                        <img src="/uploads/profile_image/{{ $user->avatar }}"
                                                             style="width:100px; height:100px; float:left;"
                                                             class="fa fa-photo text-light">
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <input type="file" id="savan"  name="avatar"/><br>
                                                    <input type="submit" class="btn btn-success" value="Upload Image" name="Upload">
                                                </div>
                                            </div>
                                            @include('layouts.error')
                                        </div>
                                    </div>
                                </form>
                                <form class="form-horizontal" action="/student/profile" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Name</label>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control form-group col-sm-2"
                                                           name="name"
                                                           value="{{ $user->name }}" placeholder="Name"><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Email</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="email" class="form-control form-group col-sm-2"
                                                       name="email"
                                                       value="{{ $user->email }}" placeholder="Email"><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Password</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="password" class="form-control form-group col-sm-2"
                                                       name="password" placeholder="password"><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Headline</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control form-group col-sm-2"
                                                       name="headline"
                                                       value="{{ $user->student_profile ? $user->student_profile->headline : '' }}"
                                                       placeholder="Headline">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Biography</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <textarea class="form-group form-control" name="biography"
                                                          placeholder="Biography"
                                                          rows="5">{{ $user->student_profile ? $user->student_profile->biography : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Web</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">Web :</span>
                                                    <input type="url" class="form-control" name="web" placeholder="Website"
                                                           aria-describedby="basic-addon1" value="{{ $user->student_profile ? $user->student_profile->web : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Google +</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">https://plus.google.com/</span>
                                                    <input type="text" class="form-control" name="google" placeholder="Google+ Link"
                                                           aria-describedby="basic-addon1" value="{{ $user->student_profile ? $user->student_profile->google : '' }}">
                                                </div>
                                                <p style="margin-top: 5px">Add your Google+ profile name (e.g. +JohnSmith or 33338888789996)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Linkedin</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">http://www.linkedin.com/</span>
                                                    <input type="text" class="form-control" name="linkedin" placeholder="LinkedIn Profile"
                                                           aria-describedby="basic-addon1" value="{{ $user->student_profile ? $user->student_profile->linkedin : '' }}">
                                                </div>
                                                <p style="margin-top: 5px">Input your LinkedIn resource id (e.g. in/johnsmith).</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Youtube</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">http://www.youtube.com/</span>
                                                    <input type="text" class="form-control " name="youtube" placeholder="Youtube Profile"
                                                           aria-describedby="basic-addon1" value="{{ $user->student_profile ? $user->student_profile->youtube : '' }}">
                                                </div>
                                                <p style="margin-top: 5px">Input your Youtube username (e.g. johnsmith).</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group margin-none">
                                        <div class="col-md-offset-2 col-md-10">
                                            <button type="submit" class="btn btn-primary paper-shadow relative"
                                                    data-z="0.5" data-hover-z="1" data-animated="">Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- // END Panes -->

                    </div>
                    <!-- // END Tabbable Widget -->

                    <br>
                    <br>

                </div> <div class="col-md-3">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">My Account</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{  route('student.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="list-group-item "><a class="link-text-color"
                                                                      href="{{ url('student/enroll') }}">My Courses</a>
                                </li>
                                <li class="list-group-item active"><a class="link-text-color"
                                                               href="{{ route('student.profile',str_slug( Auth::user()->name)) }}">Profile</a>
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
                </div>
            </div>
        </div>
    </div>
@endsection
