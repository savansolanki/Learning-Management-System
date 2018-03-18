<?php

namespace LMS\Http\Controllers\Tutor;

use LMS\Http\Controllers\Controller;
use LMS\TutorProfile;
use LMS\User;
use Auth;
use Illuminate\Http\Request;
use Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('tutor')->except('show');
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user()->load('tutor_profile');
        return view('tutor.profile', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'headline' => 'required|max:60',
            'biography' => 'required',
        ]);

        /** @var TutorProfile $tutorProfile */
        $tutorProfile = Auth::user()->tutor_profile;

        if (!$tutorProfile) {
            Auth::user()->tutor_profile()->create([
                'headline' => $request->headline,
                'biography' => $request->biography,
                'web' => $request->web,
                'google' => $request->google,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
            ]);
        } else {
            $tutorProfile->headline = $request->headline;
            $tutorProfile->biography = $request->biography;
            $tutorProfile->web = $request->web;
            $tutorProfile->google = $request->google;
            $tutorProfile->linkedin = $request->linkedin;
            $tutorProfile->youtube = $request->youtube;
            $tutorProfile->save();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null ) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->back()->with(['error' => 'Updated Profile']);
    }

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
        return redirect()->back()->with(['error' => 'Profile Photo Updated']);
    }

    /**
     * @param $profile
     * @return mixed
     */
    public function show($profile)
    {
        if(!$user = User::where('slug',$profile)->with('tutorCourses')->first())
        {
            return redirect()->back()->with(['error' => 'Unauthorised Access Denied ']);
        }
        return view('PublicProfile',compact('user'));
    }
}
