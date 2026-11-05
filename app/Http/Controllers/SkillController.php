<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    // SHOW PAGE
    public function index()
    {
        $skills = Skill::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('front.account.skills', compact('skills'));
    }

    // STORE
    public function store(Request $request)
    {
        $validator = validator($request->all(), [

            'name' => 'required',

            'level' => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'errors' => $validator->errors()

            ]);
        }

        Skill::create([

            'user_id' => Auth::id(),

            'name' => $request->name,

            'level' => $request->level,

        ]);

        return response()->json([

            'status' => true,

            'message' => 'Skill added successfully'

        ]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), [

            'name' => 'required',

            'level' => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'errors' => $validator->errors()

            ]);
        }

        $skill = Skill::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $skill->update([

            'name' => $request->name,

            'level' => $request->level,

        ]);

        return response()->json([

            'status' => true,

            'message' => 'Skill updated successfully'

        ]);
    }

    // DELETE
    public function destroy(Request $request)
    {
        Skill::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json([

            'status' => true

        ]);
    }
}