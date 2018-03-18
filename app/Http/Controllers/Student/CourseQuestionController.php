<?php

namespace LMS\Http\Controllers\Student;


use LMS\Course;
use LMS\CourseAnswer;
use LMS\CourseQuestion;
use LMS\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseQuestionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    /**
     * @param $slug
     * @return \View
     */
    public function index($slug)
    {
        if (!$course = Course::where('slug', $slug)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $courseQuestions = CourseQuestion::where('course_id', $course->id)->with('user')->withcount('courseAnswers')->latest()->paginate(5);
        return view('student.question.Questions', compact('course', 'courseQuestions'));
    }

    /**
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $slug)
    {
        $this->validate($request, [
            'title' => 'required|unique:course_questions,title',
            'body' => 'required|min:20',
        ]);
        if (!$course = Course::where('slug', $slug)->with('courseQuestions')->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        CourseQuestion::create([
            'course_id' => $course->id,
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return redirect()->back()->with(['error' => 'Your Question is Submitted ']);
    }

    /**
     * @param $course
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($course, $question)
    {
        if (!$course = Course::where('slug', $course)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$question = CourseQuestion::where('slug', $question)->with('user')->first()) {
            return redirect()->back()->with(['error' => 'Invalid Question']);
        }
        $courseAnswers = CourseAnswer::where('course_question_id',$question->id)->with('user')->paginate(5);
        return view('student.question.SingleQuestion', compact('course', 'question','courseAnswers'));
    }

    /**
     * @param Request $request
     * @param $course
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $course, $question)
    {
        $this->validate($request, [
            'title' => ['required',
                Rule::unique('course_questions', 'slug')->ignore($question)
            ],
            'body' => 'required|min:20',
        ]);

        if (!$course = Course::where('slug', $course)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }

        CourseQuestion::where('slug', $question)->update([
            'course_id' => $course->id,
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->back()->with(['error' => 'Question is Updated ']);
    }

    /**
     * @param $course
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($course, $question)
    {
        if (!$course = Course::where('slug', $course)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$question = CourseQuestion::where('slug', $question)->first()) {
            return redirect()->back()->with(['error' => 'Invalid Question']);
        }

        $question->delete();

        return redirect()->back()->with(['error' => 'Deleted']);
    }
}
