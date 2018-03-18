<?php

namespace LMS\Http\Controllers\Student;

use LMS\Course;
use LMS\CourseQuestion;
use LMS\Http\Controllers\Controller;
use LMS\Score;

class DashboardController extends Controller
{
     public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $enrolledCourses = $this->user->courses()->withCount('lessons')->latest()->paginate(5);
        $readCourseLessons = $this->user->lessons()->with('chapter.course')->get()->groupBy('chapter.course.id');
        $que = $this->user->courses->pluck('id');
        $questions = CourseQuestion::whereIn('course_id', $que)->with(['course', 'user'])->latest()->paginate(7);
        $scores = Score::where('user_id', auth()->id())->with('course')->get();
        return view('student.dashboard', compact('enrolledCourses', 'readCourseLessons', 'questions', 'scores'));
    }
}
