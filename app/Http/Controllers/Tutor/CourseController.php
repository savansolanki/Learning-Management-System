<?php

namespace LMS\Http\Controllers\Tutor;

use LMS\Course;
use LMS\CourseCategory;
use LMS\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Image;

class CourseController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('tutor')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$courses = Course::where('user_id', auth()->id())->with('user')->latest()->paginate(5)){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        return view('tutor.my_courses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CourseCategory::with('subcategories')->get();
        return view('tutor.create_course', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:courses,title',
            'description' => 'required|min:100',
            'category' => 'required',
            'sub_category' => 'required',
            'level' => 'required',
            'question_1' => 'required|nullable',
            'question_2' => 'required|nullable',
            'question_3' => 'required|nullable',
            'course_image' => 'required|image',
        ]);
        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $fileName = str_random(6) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(348, 150)->save(public_path('/uploads/course_image/' . $fileName));
            Course::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'sub_category' => $request->sub_category,
                'level' => $request->level,
                'question_1' => $request->question_1,
                'question_2' => $request->question_2,
                'question_3' => $request->question_3,
                'course_image' => $fileName,
            ]);
        } else {
            return redirect()->back()->with(['error' => 'Creating New Course']);
        }
        
        if(!$courses = Course::where('user_id', auth()->id())->with('user')->latest()->paginate(5)){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        return view('tutor.my_courses', compact('courses'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
                if(! $course = Course::where("slug", $slug)->with('chapters')->withcount('enrolledUser')->first()){
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        return view('tutor.show_course', compact('course'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($slug)
    {
        if (!$course = Course::where('slug', $slug)->owner()->with(['chapters', 'lessons'])->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        return view('tutor.edit_course', compact('course'));
    }

    /**
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $slug)
    {
        if (!$course = Course::where('slug', $slug)->owner()->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        $this->validate($request, [
            'title' => ['required',
                Rule::unique('courses', 'slug')->ignore($slug)
            ],
            'description' => 'required|min:100',
            'level' => 'required',
            'question_1' => 'required|nullable',
            'question_2' => 'required|nullable',
            'question_3' => 'required|nullable',
        ]);

        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $fileName = str_random(6) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(348, 150)->save(public_path('/uploads/course_image/' . $fileName));
            $course->title = $request->title;
            $course->description = $request->description;
            $course->level = $request->level;
            $course->question_1 = $request->question_1;
            $course->question_2 = $request->question_2;
            $course->question_3 = $request->question_3;
            $course->course_image = $fileName;
            $course->save();
        } else {
            $course->title = $request->title;
            $course->description = $request->description;
            $course->level = $request->level;
            $course->question_1 = $request->question_1;
            $course->question_2 = $request->question_2;
            $course->question_3 = $request->question_3;
            $course->save();
        }

        return redirect()->back()->with(['error' => 'Updating Course']);
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        if (!$course = Course::where('slug', $slug)->owner()->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }

        $course->delete();

        return redirect()->back()->with(['error' => 'Deleted']);
    }
}
