<?php

namespace LMS\Http\Controllers;

use LMS\Course;
use LMS\CourseCategory;
use LMS\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $course = Course::query();
        if($request->get('category'))
        {
            $course =  $course->where('category',$request->category);
        }
        $courses =  $course->with('user')->latest()->paginate(9);
        return view('welcome',compact('categories','courses'));
    }

    public function show()
    {
        $users=User::where('role', User::TUTOR)->with('tutor_profile')->latest()->paginate(6);
        return view('tutorlist', compact('users'));
    }
}
