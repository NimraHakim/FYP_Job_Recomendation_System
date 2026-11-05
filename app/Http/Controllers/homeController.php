<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\job;
use App\Models\Address;
use App\Models\PersonalDetail;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Language;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class homeController extends Controller
{

    // =========================================
    // SEEKER PROFILE
    // =========================================

   public function seeker_profile()
{

    $hasProfile = PersonalDetail::where(
        'user_id',
        Auth::id()
    )->exists();

    $hasEducation = Education::where(
        'user_id',
        Auth::id()
    )->exists();

    $hasSkills = Skill::where(
        'user_id',
        Auth::id()
    )->exists();

    $hasExperience = Experience::where(
        'user_id',
        Auth::id()
    )->exists();

    $hasLanguages = Language::where(
        'user_id',
        Auth::id()
    )->exists();


    // FETCH DATA

    $educations = Education::where(
        'user_id',
        Auth::id()
    )->get();

    $skills = Skill::where(
        'user_id',
        Auth::id()
    )->get();

    $experiences = Experience::where(
        'user_id',
        Auth::id()
    )->get();

    $languages = Language::where(
        'user_id',
        Auth::id()
    )->get();


    return view(
        'seeker_profile',
        compact(
            'hasProfile',
            'hasEducation',
            'hasSkills',
            'hasExperience',
            'hasLanguages',
            'educations',
            'skills',
            'experiences',
            'languages'
        )
    );
}

    // =========================================
    // HOME PAGE
    // =========================================

    public function index()
    {

       $categories = category::withCount([
    'jobs' => function ($query) {
        $query->where('status', 1);
    }
])
->where('status',1)
->orderBy('name','ASC')
->take(8)
->get();

        $newcategories = category::withCount([
    'jobs' => function ($query) {
        $query->where('status', 1);
    }
])
->where('status',1)
->orderBy('name','ASC')
->get();

        $featuredjob = job::where('status',1)
            ->orderBy('created_at','DESC')
            ->with('jobType')
            ->where('isFeatured',1)
            ->take(6)
            ->get();

        $latestjob = job::where('status',1)
            ->orderBy('created_at','DESC')
            ->with('jobType')
            ->take(6)
            ->get();

        return view(
            'front.home',
            [
                'categories' => $categories,
                'featuredjob' => $featuredjob,
                'latestjob' => $latestjob,
                'newcategories' => $newcategories
            ]
        );
    }


    // =========================================
    // PERSONAL DETAILS
    // =========================================

    public function personal_details()
    {
        $profile = PersonalDetail::where('user_id', Auth::id())->first();

    return view('personal_details', compact('profile'));
    }


    // =========================================
    // ADDRESS
    // =========================================

    public function adress()
    {
        $address = Address::where('user_id', Auth::id())->first();

    return view('adress', compact('address'));
    }


    // =========================================
    // SKILLS
    // =========================================

    public function skills()
    {
        return view('skills');
    }


    // =========================================
    // LANGUAGES
    // =========================================

    public function languages()
    {
        return view('languages');
    }


    // =========================================
    // EDUCATION
    // =========================================

    public function education()
    {
        return view('education');
    }


    // =========================================
    // EXPERIENCE
    // =========================================

    public function experience()
    {
        return view('experience');
    }

}