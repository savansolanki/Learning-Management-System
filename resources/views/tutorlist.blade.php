@extends('layouts.app')

@section('content')
    <div class="parallax cover overlay height-300 height-500-lg height-320-xs">
        <img class="parallax-layer" src="images/photodune-6745585-modern-creative-workspace-m.jpg" alt="parallax image"
             style="width: 535px; height: 362.269px;">
        <div class="parallax-layer overlay overlay-full" data-opacity="true">
            <div class="v-center">
                <div class="container">
                    <h1 class="text-display-1 overlay-bg-white-strong display-inline-block">Learn from the best
                        Tutors</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="page-section">
        <div class="container">

            <div class="row" data-toggle="isotope" style="position: relative; height: 2214px;">
                @foreach($users as $user)
                    <div class="item col-xs-12 col-sm-6 col-lg-4" style="position: absolute; left: 0px; top: 0px;">
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center"><a href="">{{ $user->name }}</a></h3>
                            </div>
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="{{ route('tutor.profile.show',$user->slug) }}">
                                            <img src="/uploads/profile_image/{{ $user->avatar }}" alt="people" style="width: 80px">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $user->tutor_profile ? substr($user->tutor_profile->biography,0,70).'.....' : 'No Details to Display' }}</p>
                                        @if(isset( $user->tutor_profile ))
                                            <span class="label label-default">{{ $user->tutor_profile->headline }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <a href="{{ route('tutor.profile.show',$user->slug) }}" class="btn btn-sm btn-primary">View profile</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <ul class="pagination margin-top-none">
                {{ $users->links() }}
            </ul>
        </div>
    </div>

@endsection