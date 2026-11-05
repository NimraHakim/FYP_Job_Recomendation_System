<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\PersonalDetail;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Language;

class ProfileReviewController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // PERSONAL DETAILS

        $personal = PersonalDetail::where(
            'user_id',
            Auth::id()
        )->first();

        // EDUCATION

        $educations = Education::where(
            'user_id',
            Auth::id()
        )->get();

        // SKILLS

        $skills = Skill::where(
            'user_id',
            Auth::id()
        )->get();

        // EXPERIENCE

        $experiences = Experience::where(
            'user_id',
            Auth::id()
        )->get();

        // LANGUAGES

        $languages = Language::where(
            'user_id',
            Auth::id()
        )->get();

        return view(
            'front.account.review-profile',
            compact(
                'user',
                'personal',
                'educations',
                'skills',
                'experiences',
                'languages'
            )
        );
    }
}