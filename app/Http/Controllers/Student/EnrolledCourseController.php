<?php

namespace LMS\Http\Controllers\Student;

use LMS\Chapter;
use LMS\Course;
use LMS\EnrolledCourse;
use LMS\Http\Controllers\Controller;
use LMS\LessonUser;

class EnrolledCourseController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index()
    {
        $enrolledCourses = $this->user->courses()->withCount('lessons')->latest()->paginate(6);

        $readCourseLessons = $this->user->lessons()->with('chapter.course')->get()->groupBy('chapter.course.id');

        return view('student.myCourses', compact('enrolledCourses', 'readCourseLessons'));
    }

    public function store($slug)
    {
        if (!$course = Course::where('slug', $slug)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $chapters = Chapter::where('course_id', $course->id)->with('lessons')->get();
        if (!$enroll = EnrolledCourse::where('user_id', auth()->id())->where('course_id', $course->id)->first()) {
            EnrolledCourse::create([
                'user_id' => auth()->id(),
                'course_id' => $course->id
            ]);
        } else {
            return view('student.singleCourse', compact('course', 'chapters'));
        }

        return view('student.singleCourse', compact('course', 'chapters'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     *
     */
    public function show($slug)
    {
        if (!$course = Course::where('slug', $slug)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $chapters = Chapter::where('course_id', $course->id)->with('lessons')->get();

        $userLesson =$this->user->lessons;

        foreach ($userLesson as $user)
        {
           $read[] =  $user->pivot->lesson_id;
        }
        return view('student.singleCourse', compact('course', 'chapters','read'));
    }
}
