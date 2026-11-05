<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Skill;

class AIJobController extends Controller
{
    public function recommendJobs()
    {
        // Get user skills

        $skills = Skill::where('user_id', Auth::id())
            ->pluck('name')
            ->toArray();

        if (empty($skills)) {
            return view('front.account.ai-jobs', [
                'jobs' => [],
                'message' => 'Please add your skills first.'
            ]);
        }

        // Convert skills into string

        $skillsText = implode(' ', $skills);

        // Python file path

        $pythonScript = base_path('/ai/recommend.py');


        // Check file exists

        if (!file_exists($pythonScript)) {

            return view('front.account.ai-jobs', [
                'jobs' => [],
                'message' => 'recommend.py file not found.'
            ]);
        }

        // Execute Python
$python = 'C:\\Users\\ABC\\AppData\\Local\\Programs\\Python\\Python310\\python.exe';

$command = '"' . $python . '" "' . $pythonScript . '" "' . $skillsText . '" 2>&1';

$output = shell_exec($command);

        // Python execution failed

        if ($output === null || trim($output) === '') {

            return view('front.account.ai-jobs', [
                'jobs' => [],
                'message' => 'Python did not return any result.'
            ]);
        }

        // Decode JSON

        $jobs = json_decode($output, true);

        if (json_last_error() !== JSON_ERROR_NONE) {

            return view('front.account.ai-jobs', [
                'jobs' => [],
                'message' => 'Invalid JSON received from Python.'
            ]);
        }

        return view('front.account.ai-jobs', compact('jobs'));
    }
}