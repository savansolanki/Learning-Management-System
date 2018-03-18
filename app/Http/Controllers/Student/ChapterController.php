<?php

namespace LMS\Http\Controllers\Student;

use LMS\Chapter;
use LMS\Course;
use LMS\Http\Controllers\Controller;
use LMS\Lesson;

class ChapterController extends Controller
{
     public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    /**
     * @param $course
     * @param $lesson
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($course, $lesson)
    {
        if (!$course = Course::where('slug', $course)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$lesson = Lesson::where('id', $lesson)->first()) {
            return redirect()->back()->with(['error' => 'Invalid Chapter Identifier.']);
        }

        if (!$this->user->lessons()->where('lesson_id', $lesson->id)->exists()) {
            $this->user->lessons()->attach($lesson);
        }

        $userLesson =$this->user->lessons;

        foreach ($userLesson as $user)
        {
            $read[] =  $user->pivot->lesson_id;
        }

        $chapters = Chapter::where('course_id', $course->id)->with('lessons')->get();
        return view('student.lessons.showLesson', compact('lesson', 'course', 'chapters','read'));
    }
}
