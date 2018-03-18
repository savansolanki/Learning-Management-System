<?php

namespace LMS\Http\Controllers\Tutor;

use LMS\Chapter;
use LMS\Course;
use LMS\Http\Controllers\Controller;
use LMS\Lesson;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('tutor');
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
     * @param $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function create($course)
    {
        if(!$course =  Course::where("slug",$course)->with('chapters')->first())
            {
                 return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
            }
        return view('tutor.chapter_create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:5'
        ]);
        
        if(!$course = Course::where('slug',$request->course)->first())
            {
                 return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
            }
        Chapter::create([
            'course_id' =>  $course->id,
            'title' => $request->title,
        ]);
        return redirect()->back()->with(['error' => 'New Chapter Added']);
    }

    /**
     * @param $course
     * @param $lesson
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($course,$lesson)
    {
        if(!$course=Course::where('slug',$course)->owner()->first()){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$lesson = Lesson::where('id',$lesson)->with('chapter')->first()) {
            return redirect()->back()->with(['error' => 'Invalid Chapter Identifier.']);
        }
        $chapters = Chapter::where('course_id',$course->id)->with('lessons')->get();
        return view('tutor.lessons.showLesson',compact('lesson','course','chapters'));
    }

    /**
     * @param $course
     * @param $chapter
     */
    public function edit($course,$chapter)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $course
     * @param  \LMS\Chapter $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course ,$chapter)
    {
        $this->validate($request,[
            'title' => 'required|min:5'
        ]);
        if(!$course=Course::where('slug',$course)->owner()->first()){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$chapter = Chapter::where('id',$chapter)->where('course_id',$course->id)->first()) {
            return redirect()->back()->with(['error' => 'Invalid Chapter Identifier.']);
        }
        $chapter->title = $request->title;
        $chapter->save();
        return redirect()->back()->with(['error' => 'Chapter Updated ']);
    }

    /**
     * @param $course
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($course,$id)
    {
        if(!$course=Course::where('slug',$course)->owner()->first()){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$chapter = Chapter::where('id',$id)->where('course_id',$course->id)->first()) {
            return redirect()->back()->with(['error' => 'Invalid Chapter Identifier.']);
        }
        $chapter->delete();
        return redirect()->back()->with(['error' => 'Deleted']);
    }
}
