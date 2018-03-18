<?php

namespace LMS\Http\Controllers\Tutor;


use LMS\Course;
use LMS\CourseQuestion;
use LMS\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('tutor');
    }

    public function index()
    {
//        $courses = Course::where('user_id', auth()->id())->with('enrolledUser')->latest()->get();
        $courses = Course::where('user_id', auth()->id())->latest()->paginate(5);
        $id = Course::where('user_id', auth()->id())->pluck('id');
        $questions = CourseQuestion::whereIn('course_id', $id)->with(['user', 'course'])->latest()->paginate(7);
        return view('tutor.dashboard', compact('courses', 'questions'));
    }


    /**
     * @param $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($course)
    {
        $course = Course::where('slug', $course)->with(['enrolledUser', 'scores'])->withcount('lessons')->first();
        foreach($course->lessons as $lesson){
            $courseLessons[] = $lesson->id;
        }
        foreach ($course->enrolledUser as $key => $user) {
            $lessons[] = $user->lessons()->pluck('id') ;
            $count[]  = array_intersect( $lessons[$key]->toArray() , $courseLessons);
        }return view('tutor.studentLists', compact('course','courseLessons','count'));
    }
}
