<?php

namespace LMS\Http\Controllers\Tutor;

use LMS\Course;
use LMS\CourseAnswer;
use LMS\CourseQuestion;
use LMS\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseAnswerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @param $course
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(Request $request, $course)
    {
        $this->validate($request, [
            'body' => 'required|min:10'
        ]);
        if (!$course = Course::where('slug', $course)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$question = CourseQuestion::where('slug', $request->question)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        CourseAnswer::create([
            'course_question_id' => $question->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);
        return redirect()->back()->with(['error' => 'Submitting Answer']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \LMS\CourseAnswer $courseAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(CourseAnswer $courseAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \LMS\CourseAnswer $courseAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseAnswer $courseAnswer)
    {
        //
    }

    /**
     * @param Request $request
     * @param $course
     * @param $courseAnswer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $course, $courseAnswer)
    {
        if (!$course = Course::where('slug', $course)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$courseAnswer = CourseAnswer::where('id', $courseAnswer)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $courseAnswer->body = $request->body;
        $courseAnswer->save();
        return redirect()->back()->with(['error' => 'Answer is Updated ']);
    }

    /**
     * @param $course
     * @param $courseAnswer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($course, $courseAnswer)
    {
        if (!$course = Course::where('slug', $course)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$courseAnswer = CourseAnswer::where('id', $courseAnswer)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $courseAnswer->delete();
        return redirect()->back()->with(['error' => 'Deleted']);
    }
}
