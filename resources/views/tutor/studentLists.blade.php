@extends('layouts.app')

@section('content')
    @include('tutor.headers.course ')
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default paper-shadow" data-z="0.5">
                        <div class="table-responsive">
                            <table class="table text-subhead v-middle">
                                <thead>
                                <tr>
                                    <th class="text-center">Student Name</th>
                                    <th class=" text-center">Course Complete</th>
                                    <th class="text-center">Quiz Score</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($course->enrolledUser as $key => $user)
                                    <tr>
                                        <td class="text-center"><a href="{{ route('student.profile.show',$user->slug) }}">{{ $user->name }}</a></td>
                                        <td>
                                            <div class="progress" style="height: 19px;">
                                                <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                     aria-valuenow="{{ (count($count[$key])/$course->lessons_count)*100 }}"
                                                     aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                    {{ round((count($count[$key])/$course->lessons_count)*100) . '% Completed ' }}
                                                </div>
                                            </div>
                                        </td>
                                        @if(isset($course->scores[$key]))
                                            @foreach($course->scores as $score)
                                            @if( $score->user_id == $user->id)
                                            <td class="text-center">{{ $score->score }}</td>
                                            @endif
                                            @endforeach
                                        @else
                                            <td class="text-center">Pending</td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <ul class="pagination margin-none">
                                {{--{{ links() }}--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">My Account</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item active"><a class="link-text-color"
                                                                      href="{{  route('tutor.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{ route('tutor.course.index') }}">My Courses</a>
                                </li>
                                <li class="list-group-item"><a class="link-text-color"
                                                               href="{{ route('tutor.profile')}}">Profile</a></li>
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
