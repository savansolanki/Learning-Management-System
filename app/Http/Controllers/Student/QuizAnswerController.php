<?php

namespace LMS\Http\Controllers\Student;

use LMS\Course;
use LMS\Http\Controllers\Controller;
use LMS\QuizAnswer;
use LMS\QuizQuestion;
use LMS\Score;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index($course)
    {
        if (!$totalLesson = Course::where('slug', $course)->withCount(['lessons', 'quizQuestions'])->with('quizQuestions')->first()) {
            return redirect()->back()->with('error', 'Invalid Course Identifier');
        }


        if ($score = Score::where('course_id', $totalLesson->id)->where('user_id', auth()->id())->first()) {
            return redirect()->back()->with('error', 'You can not attempt quiz again');
        }

        $readLesson = $this->user->lessons()->with('chapter.course')->get()->groupBy('chapter.course.id');
        if (count($readLesson)) {
            if (isset($readLesson[$totalLesson->id])) {
                if ($readLesson[$totalLesson->id]->count() == $totalLesson->lessons_count) {
                    $course = $totalLesson;
                    return view('student.quiz.startQuiz', compact('course'));

                } else {
                    return redirect()->back()->with('error', 'Please complete all lesson first');
                }
            }
            else{
                return redirect()->back()->with('error', 'Please complete all lesson first');
            }
        }
        else {
            return redirect()->back()->with('error', 'Please complete all lesson first');
        }
    }

    /**
     * @param $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($course)
    {
        if (!$course = Course::where('slug', $course)->withCount('quizQuestions')->first()) {
            return redirect()->back()->with('error', 'Invalid Course Identifier');
        }
        if ($score = Score::where('course_id', $course->id)->where('user_id', auth()->id())->first()) {
            return redirect(route('tutor.dashboard'))->with('error', 'You can not attempt quiz again');
        }
        if (!$questions = QuizQuestion::where('course_id', $course->id)->paginate(1)) {
            return redirect()->back()->with('error', 'Invalid Question Identifier');
        }
        $questionId = QuizAnswer::where('user_id', auth()->id())->pluck('quiz_question_id');
        foreach ($questionId as $answer) {
            $answers[] = $answer;
        }
        if (!isset($answers)) {
            $answers = [0, 0];
        }
        return view('student.quiz.quizQuestions', compact('course', 'questions', 'answers'));
    }

    /**
     * @param Request $request
     * @param $course
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $course, $question)
    {
        $this->validate($request, [
            'answer' => 'required'
        ], [
            'answer.required' => 'Please select Answer'
        ]);

        if (!$course = Course::where('slug', $course)->withCount('quizQuestions')->first()) {
            return redirect()->back()->with('error', 'Invalid Course Identifier');
        }

        if ($score = Score::where('course_id', $course->id)->where('user_id', auth()->id())->first()) {
            return redirect()->back()->with('error', 'You can not attempt quiz again');
        }

        if (!$question = QuizQuestion::where('course_id', $course->id)->where('id', $question)->first()) {
            return redirect()->back()->with('error', 'Invalid Question Identifier');
        }

        if ($answer = QuizAnswer::where('user_id', auth()->id())->where('quiz_question_id', $question->id)->exists()) {
            return redirect()->back()->with('error', 'Answer Already Stored');
        }

        QuizAnswer::create([
            'quiz_question_id' => $question->id,
            'user_id' => auth()->id(),
            'answer' => $request->answer,
        ]);
        return redirect()->back();
    }


    public function submitQuiz($course)
    {
        if (!$course = Course::where('slug', $course)->withCount('quizQuestions')->first()) {
            return redirect()->back()->with('error', 'Invalid Course Identifier');
        }

        if ($score = Score::where('course_id', $course->id)->where('user_id', auth()->id())->first()) {
            return redirect()->back()->with('error', 'You can not attempt quiz again');
        }

        if (!$questions = QuizQuestion::where('course_id', $course->id)->get()) {
            return redirect()->back()->with('error', 'Invalid Question Identifier');
        }

        foreach ($questions as $key => $question) {
            $questionId[] = $question->id;
        }

        if (!$totalQuestions = QuizAnswer::where('user_id', auth()->id())->whereIn('quiz_question_id',$questionId)->pluck('answer')) {
            return redirect()->back()->with('error', 'Please Try Again');
        }

        if ($course->quiz_questions_count != $totalQuestions->count()) {
            return redirect()->back()->with('error', 'Submit all question answers');
        }

        foreach ($totalQuestions as $answer) {
            $userAnswers[] = $answer;
        }

        $score = 0;
        foreach ($questions as $key => $question) {
            if ($question->correct_answer == $userAnswers[$key]) {
                $score++;
            }
        }
        $result = ($score/$course->quiz_questions_count) * 100 ;
        Score::create([
            'course_id' => $course->id,
            'user_id' => auth()->id(),
            'score' => $result
        ]);
        return view('student.quiz.score', compact('course', 'score'));
    }
}
