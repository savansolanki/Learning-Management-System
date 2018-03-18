<?php

namespace LMS\Http\Controllers\Student;

use LMS\Http\Controllers\Controller;
use LMS\StudentProfile;
use LMS\User;
use Auth;
use Illuminate\Http\Request;
use Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('student.profile', array('user' => \Auth::user()));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'headline' => 'required|max:60',
            'biography' => 'required',
        ]);

        /** @var StudentProfile $studentProfile */
        $studentProfile = Auth::user()->student_profile;

        if (!$studentProfile) {
            Auth::user()->student_profile()->create([
                'headline' => $request->headline,
                'biography' => $request->biography,
                'web' => $request->web,
                'google' => $request->google,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
            ]);
        } else {
            $studentProfile->headline = $request->headline;
            $studentProfile->biography = $request->biography;
            $studentProfile->web = $request->web;
            $studentProfile->google = $request->google;
            $studentProfile->linkedin = $request->linkedin;
            $studentProfile->youtube = $request->youtube;
            $studentProfile->save();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null ) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->back()->with(['error' => 'Profile Updated']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image',
        ]);
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $fileName = str_random(6) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save(public_path('/uploads/profile_image/' . $fileName));

            $user = Auth::user();
            $user->avatar = $fileName;
            $user->save();
        }
        return redirect()->back()->with(['error' => 'Profile Photo Updated ']);
    }

    /**
     * @param $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($profile)
    {
        if (!$user = User::where('slug', $profile)->with('tutorCourses')->first()) {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        return view('PublicProfile', compact('user'));
    }
}
