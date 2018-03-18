@extends('layouts.app')

@section('content')
    @include('student.headers.courseHeader')
    <div class="parallax overflow-hidden bg-blue-400" >
        <div class="media v-middle">
            <h1 class="text-white text-display-1 margin-v-0 text-center" style="padding: 10%; font-size: 90px">Your Score is {{ $score }} out of {{ $course->quiz_questions_count }}</h1>
        </div>
    </div>
@endsection