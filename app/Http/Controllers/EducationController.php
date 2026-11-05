<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::where('user_id', Auth::id())->get();

        return view('front.account.education', compact('educations'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'degree_level'   => 'required',
            'school'         => 'required',
            'board'          => 'required',
            'total_marks'    => 'required|numeric',
            'obtained_marks' => 'required|numeric',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        Education::create([
            'user_id'        => Auth::id(),
            'degree_level'   => $request->degree_level,
            'school'         => $request->school,
            'board'          => $request->board,
            'total_marks'    => $request->total_marks,
            'obtained_marks' => $request->obtained_marks,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Education saved successfully'
        ]);
    }
}