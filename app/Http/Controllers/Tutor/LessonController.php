<?php

namespace LMS\Http\Controllers\Tutor;

use LMS\Chapter;
use LMS\Course;
use LMS\Lesson;
use Illuminate\Http\Request;
use LMS\Http\Controllers\Controller;

class LessonController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:5' ,
            'description' => 'required|min:20',
        ]);

        if ($request->hasFile('resource')) {
            $file_name = str_random(10) . '.' . $request->resource->getClientOriginalExtension();
            $request->resource->storeAs('public/material', $file_name);
            Lesson::create([
                'chapter_id' => $request->chapter,
                'title' => $request->title,
                'description' => $request->description,
                'resource' => $file_name,
            ]);
        }else{
            Lesson::create([
                'chapter_id' => $request->chapter,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }

        return redirect()->back()->with(['error' => 'New Lesson added']);
    }

    /**
     * @param $course
     * @param $lesson
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($course,$lesson)
    {
        $course = Course::where('slug',$course)->first();
        $lesson = Lesson::where('id',$lesson)->with('chapter')->with('course')->first();
        return view('tutor.lessons.showLesson',compact('lesson','course'));
    }

    /**
     * @param $course
     * @param $lesson
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($course,$lesson)
    {
        if(!$course=Course::where('slug',$course)->owner()->first()){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$lesson = Lesson::where('id',$lesson)->with('chapter')->first()) {
            return redirect()->back()->with(['error' => 'Invalid Lesson Identifier.']);
        }
        $chapters = Chapter::where('course_id',$course->id)->with('lessons')->get();
        return view('tutor.lessons.editLesson',compact('lesson','course','chapters'));
    }

    /**
     * @param Request $request
     * @param $course
     * @param $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$course , $lesson)
    {

        if(!$course=Course::where('slug',$course)->owner()->first()){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$lesson = Lesson::where('id',$lesson)->with('chapter')->first()) {
            return redirect()->back()->with(['error' => 'Invalid Lesson Identifier.']);
        }

        $this->validate($request,[
            'title' => 'required|min:5' ,
            'description' => 'required|min:20',
        ]);

        if ($request->hasFile('resource')) {
            $file_name = str_random(10) . '.' . $request->resource->getClientOriginalExtension();
            $request->resource->storeAs('public/material', $file_name);
            $lesson->title = $request->title;
            $lesson->description = $request->description;
            $lesson->resource = $file_name;
            $lesson->save();
        }else{
            $lesson->title = $request->title;
            $lesson->description = $request->description;
            $lesson->save();
        }

        return redirect()->back()->with(['error' => 'Updating Lesson']);
    }

    /**
     * @param $course
     * @param $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($course,$lesson)
    {
        if(!$course=Course::where('slug',$course)->owner()->first()){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        if (!$lesson = Lesson::where('id',$lesson)->with('chapter')->first()) {
            return redirect()->back()->with(['error' => 'Invalid Lesson Identifier.']);
        }
        $lesson->delete();
        return redirect(route('tutor.course.show',$course->slug))->with(['error' => 'Deleted']);
    }
}
