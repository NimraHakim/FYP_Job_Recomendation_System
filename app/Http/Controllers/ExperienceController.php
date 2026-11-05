<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    // SHOW PAGE
    public function index()
    {
        $experiences = Experience::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('front.account.experience', compact('experiences'));
    }

    // STORE
    public function store(Request $request)
    {
        $validator = validator($request->all(), [

            'field_name' => 'required',

            'company_name' => 'required',

            'years' => 'required|numeric',

            'certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'errors' => $validator->errors()

            ]);
        }

        $fileName = null;

        if ($request->hasFile('certificate')) {

            $file = $request->file('certificate');

            $fileName = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('certificates'), $fileName);
        }

        Experience::create([

            'user_id' => Auth::id(),

            'field_name' => $request->field_name,

            'company_name' => $request->company_name,

            'years' => $request->years,

            'certificate' => $fileName,

        ]);

        return response()->json([

            'status' => true,

            'message' => 'Experience added successfully'

        ]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), [

            'field_name' => 'required',

            'company_name' => 'required',

            'years' => 'required|numeric',

        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'errors' => $validator->errors()

            ]);
        }

        $experience = Experience::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $fileName = $experience->certificate;

        if ($request->hasFile('certificate')) {

            $file = $request->file('certificate');

            $fileName = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('certificates'), $fileName);
        }

        $experience->update([

            'field_name' => $request->field_name,

            'company_name' => $request->company_name,

            'years' => $request->years,

            'certificate' => $fileName,

        ]);

        return response()->json([

            'status' => true,

            'message' => 'Experience updated successfully'

        ]);
    }

    // DELETE
    public function destroy(Request $request)
    {
        Experience::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json([

            'status' => true

        ]);
    }
}
