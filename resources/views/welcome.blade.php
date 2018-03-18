@extends('layouts.app')

@section('content')

    <div class="parallax bg-white page-section">
        <div class="container parallax-layer" data-opacity="true">
            <div class="media v-middle">
                <div class="media-body">
                    <h1 class="text-display-2 margin-none">Library</h1>
                    <p class="text-light lead">Browse through thousands of lessons.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="row" data-toggle="isotope">
                        @if(count($courses))
                            @foreach($courses as $key => $course)
                                <div class="item col-xs-12 col-sm-6 col-lg-4"
                                     style="position: absolute; left: 0px; top: 418px;">
                                    <div class="panel panel-default paper-shadow" data-z="0.5">

                                        <div class="cover overlay cover-image-full hover" style="height: 151px;">
                                            <img src="/uploads/course_image/{{ $course->course_image }}"
                                                 class="img icon-block height-150">
                                        </div>

                                        <div class="panel-body">
                                            <p class="text-headline margin-v-0-10"><a
                                                        href="{{ route('tutor.course.show',$course->slug ) }}">{{ $course->title }}</a>
                                                <a class="btn btn-primary btn-stroke btn-circle pull-right"
                                                   href="{{ route('tutor.course.show',$course->slug ) }}"><i
                                                            class="fa fa-angle-double-right"></i></a></p>
                                        </div>
                                        <hr class="margin-none">
                                        <div class="panel-body">
                                            <div class="expandable expandable-indicator-white expandable-trigger">

                                            </div>
                                            <div class="media v-middle">
                                                <div class="media-left">
                                                    <img src="/uploads/profile_image/{{ $course->user->avatar }}"
                                                         alt="People"
                                                         class="img-circle width-40">
                                                </div>
                                                <div class="media-body">
                                                    <h4>
                                                        <a href="{{  route('tutor.profile.show',$course->user->slug) }}">{{ $course->user->name }}</a>
                                                        <br>
                                                    </h4>
                                                    Instructor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="item col-xs-12 col-sm-6 col-lg-4"
                                 style="position: absolute; left: 0px; top: 418px;">
                                <div class="panel panel-default paper-shadow" data-z="0.5">
                                    <div class="panel-body">
                                        <p class="text-headline margin-v-0-10">
                                            <a> Sorry no course found !! </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <ul class="pagination margin-top-none">
                        {{ $courses->links() }}
                    </ul>
                    <br/>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">Category</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group">
                                @foreach($categories as $category)
                                    <li class="list-group-item">
                                        <span class="badge pull-right">{{ count($category->courses) }}</span>
                                        <a class="list-group-link"
                                           href="{{  url('/?category='.$category->id) }}">{{ $category->category }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="page-section-heading">
            <h2 class="text-display-1">Features</h2>
            <p class="lead text-muted">Learn about all of the features we offer.</p>
        </div>
        <div class="row" data-toggle="gridalicious">

            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-green-300 text-white">
                        <div class="panel-body">
                            <i class="fa fa-film fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-headline">Learn Free Courses </div>
                            <p>Every Course starting from Beginner to Expert learn are available free </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-purple-300 text-white">
                        <div class="panel-body">
                            <i class="fa fa-life-bouy fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-headline">Learn from Top Tutors</div>
                            <p>Tutor from affiliated universities and institutes are present here to guides your throughout</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-orange-400 text-white">
                        <div class="panel-body">
                            <i class="fa fa-user fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-headline">Quiz Test</div>
                            <p>In the end of the course  candidate will be assessed on the base of Quiz/Test in end </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-cyan-400 text-white">
                        <div class="panel-body">
                            <i class="fa fa-code fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-headline">Lesson Source Files</div>
                            <p> For every examples are provided in courses all source files will be available for download   </p>  </div>
                    </div>
                </div>
            </div>

            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-pink-400 text-white">
                        <div class="panel-body">
                            <i class="fa fa-print fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-headline">Learning Material</div>
                            <p>For each and every lessons document files will be available</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-red-400 text-white">
                        <div class="panel-body">
                            <i class="fa fa-tasks fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-headline">New Lessons Every Day</div>
                            <p> Lessons will be updated regularly by tutors if any technology update has arrived. </p> </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <br/>
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <h4 class="text-headline text-light">Explore</h4>
                    <ul class="list-unstyled">
                        <li><a href="">Courses</a></li>
                        <li><a href="{{ url('tutorList') }}">Tutors</a></li>
                        <li><a href="{{ route('register') }}">Become Tutor</a></li>
                        <li><a href="{{ route('register') }}">Sign Up</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-6 pull-right">

                    <br/>
                    <p>
                        <a href="https://www.facebook.com/svn9033" class="btn btn-indigo-500 btn-circle"><i
                                    class="fa fa-facebook"></i></a>
                        <a href="https://twitter.com/savansolanki22" class="btn btn-blue-500 btn-circle"><i
                                    class="fa fa-twitter"></i></a>
                        <a href="https://plus.google.com/u/0/111563341953071998765"
                           class="btn btn-primary btn-circle"><i class="fa fa-google-plus"></i></a>
                        <a href="https://www.linkedin.com/in/savan-solanki-07469a85/" class="btn btn-danger btn-circle"><i
                                    class="fa fa-linkedin"></i></a>
                    </p>

                    <p class="text-subhead">
                        &copy; {{ date("Y") }} Learning App by Savan and Siddharth.
                    </p>

                </div>
            </div>
        </div>
    </section>
@endsection
