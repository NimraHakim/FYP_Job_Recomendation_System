<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    // SHOW PAGE
    public function index()
    {
        $languages = Language::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('front.account.languages', compact('languages'));
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

        Language::create([

            'user_id' => Auth::id(),

            'name' => $request->name,

            'level' => $request->level,

        ]);

        return response()->json([

            'status' => true,

            'message' => 'Language added successfully'

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

        $language = Language::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $language->update([

            'name' => $request->name,

            'level' => $request->level,

        ]);

        return response()->json([

            'status' => true,

            'message' => 'Language updated successfully'

        ]);
    }

    // DELETE
    public function destroy(Request $request)
    {
        Language::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json([

            'status' => true

        ]);
    }
}