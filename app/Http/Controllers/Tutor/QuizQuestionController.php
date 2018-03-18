<?php

namespace LMS\Http\Controllers\Tutor;

use LMS\Course;
use LMS\Http\Controllers\Controller;
use LMS\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    /**
     * QuizQuestionController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index($slug)
    {
        if (!$course = Course::where('slug', $slug)->owner()->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        return view('tutor.quiz.createQuiz', compact('course'));
    }

    /**
     * @param Request $request
     * @param $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request,$course)
    {
        if (!$course = Course::where('slug', $course)->owner()->with('quizQuestions')->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $this->validate($request,[
            'question'=>'required',
            'choice_1' =>'required',
            'choice_2' =>'required',
            'choice_3' =>'required',
            'choice_4' =>'required',
            'correct_answer' =>'required',
        ]);
        QuizQuestion::create([
            'course_id' =>  $course->id,
            'question' =>  request('question'),
            'choice_1' =>  request('choice_1'),
            'choice_2' =>  request('choice_2'),
            'choice_3' =>  request('choice_3'),
            'choice_4' =>  request('choice_4'),
            'correct_answer' =>  request('correct_answer'),
        ]);
        return redirect()->back()->with(['error' => 'New Question is added']);
    }

    public function update(Request $request,$course,$question)
    {
        if (!$course = Course::where('slug', $course)->owner()->with('quizQuestions')->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$question = QuizQuestion::where('id', $question)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $this->validate($request,[
            'question'=>'required',
            'choice_1' =>'required',
            'choice_2' =>'required',
            'choice_3' =>'required',
            'choice_4' =>'required',
            'correct_answer' =>'required',
        ]);
        $question->question = $request->question;
        $question->choice_1 = $request->choice_1 ;
        $question->choice_2 = $request->choice_2;
        $question->choice_3 = $request->choice_3;
        $question->choice_4 = $request->choice_4;
        $question->correct_answer = $request->correct_answer;
        $question->save();
        return redirect()->back()->with(['error' => 'Question Updated']);
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
        if (!$question = QuizQuestion::where('id', $question)->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $question->delete();
        return redirect()->back()->with(['error' => 'Deleted']);
    }

}
