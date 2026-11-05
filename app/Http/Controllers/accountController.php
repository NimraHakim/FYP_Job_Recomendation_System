<?php

namespace App\Http\Controllers;

//
use App\Models\Job;
use App\Models\category;
use App\Models\JobApplication;
use App\Models\jobType;
use App\Models\User;
use App\Models\PersonalDetail;
use App\Models\Address;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class accountController extends Controller
{
    //this method will show user registration page 
 
  
     public function registration()
    {
        return view('front.account.registration');
    }

    public function processregistration(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:password_confirmation',
            'password_confirmation' => 'required' ,// must match password_confirmation
            'user_role' => 'required|in:job_seeker,job_provider'          
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
else{
        // Save user
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // HASHED PASSWORD
                'user_role' => $request->user_role
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Registered successfully'
            ]);

        } catch (\Exception $e) {
            // Debug: if user not saved
            return response()->json([
                'status' => false,
                'errors' => ['server' => $e->getMessage()]
            ]);
        }
    }
    }
    // Show login page
  

    // Authenticate user
    
 //this method will show user login page 
    public function  login(){
      return view('front.account.login');
  
    }
   public function authenticate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if ($validator->passes()) {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $user = Auth::user();

            if ($user->user_role == 'job_seeker') {
                return redirect()->route('seeker_profile');
            } else {
                return redirect()->route('account.profile'); // provider dashboard
            }

        } else {
            return redirect()->route('account.login')
                ->with('error', 'Either email/password is incorrect');
        }

    } else {
        return redirect()->route('account.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
    }
}
    
    public function profile(){
      $id=auth::user()->id;
      $user=User::find($id);

     return view('front.account.profile',['user'=>$user]);
    }

public function updateProfile(Request $request){
  $id=auth::user()->id;
$validator=Validator::make($request->all(),[
  'name'=>'required|min:5|max:20',
 'email'=>'required|email|unique:users,email,'.$id.',id']);

 if($validator->passes()){
  $user=User::find($id);
  $user->name=$request->name;
  $user->email=$request->email;
  $user->desigination=$request->desigination;
  $user->mobile=$request->mobile;
  $user->save();

session()->flash('success','profile updated successfully.');

  return response()->json([
    'status'=>'true',
    'errors'=>[]
      ]);
 }
 else{
  return response()->json([
'status'=>'false',
'errors'=>$validator->errors()
  ]);
 }
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('account.login');
}

public function updateProfilepic(Request $request){
// dd($request->all());
$id=auth::user()->id;
$validator=Validator::make($request->all(),[
  'image'=> 'required|image'
]);
if($validator->passes()){
$image=$request->image;
$ext = $image->getClientOriginalExtension();

$imageName=$id.'-'.time().'.'.$ext;
$image->move(public_path('/profile_pic/',$imageName));

User::where('id',$id)->update(['image'=>$imageName ]);

 session()->flash('success','profile pic updated successfully');
return response()->json([
  'status'=> true,
  'errors'=>[]
]);

}else{
  return response()->json([
    'status'=> false,
    'errors'=>$validator->errors()
    ]);
  }
 }
public function createJob()
{
    $categories = Category::orderBy('name', 'ASC')
        ->where('status', 1)
        ->get();

    $jobType = JobType::orderBy('name', 'ASC')
        ->where('status', 1)
        ->get();

    return view("front.account.job.create", [
        'categories' => $categories,
        'jobType' => $jobType
    ]);
}


public function savejob(Request $request){
$rule=[
'title'=>'required|min:5|max:200',
'category'=>'required',
'jobType'=>'required',
'vacancy'=>'required|integer|max:50',
'location'=>'required',
'description'=>'required',
'experience'=>'required',
'company_name'=>'required|min:3|max:75',
];

$validator=Validator::make($request->all(),$rule);

if($validator->passes()){
$job= new job();
$job->title=$request->title;
$job->category_id=$request->category;
$job->job_type_id=$request->jobType;
$job->	user_id=Auth::user()->id;
$job->Vacancy=$request->vacancy;
$job->salary=$request->salary;
$job->location=$request->location;
$job->description=$request->description;
$job->benefits=$request->benefits;
$job->responsibality=$request->responsibility;
$job->qualifications=$request->qualifications;
$job->keywords=$request->keywords;
$job->experiance=$request->experience;
$job->company_name=$request->company_name;
$job->company_location=$request->com_location;
$job->comapny_website=$request->website;
$job->save();

session()->flash('success','job added successfully');

return response()->json([
  'status' => true,
  'errors' => []
]);

}else{
  return response()->json([
    'status'=>false,
    'errors'=>$validator->errors()
  ]);
}

}
public function myjobs()
{
    $jobs = Job::with([
                'jobType',
                'applications'
            ])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

    return view('front.account.job.myjobs', [
        'jobs' => $jobs
    ]);
}
public function editJob(Request $request,$id){
  $categories = Category::orderBy('name', 'ASC')
  ->where('status', 1)
  ->get();

$jobType = JobType::orderBy('name', 'ASC')
  ->where('status', 1)
  ->get();

  $job=job::where([
 'user_id'=>Auth::user()->id,
 'id'=>$id
  ])->first();

  if($job==null){
    abort(404);
  }
 return view('front.account.job.edit',['categories'=>$categories 
 ,'jobType'=>$jobType,'job'=>$job ]);

}



public function updatejob(Request $request, $id){
  $rule=[
  'title'=>'required|min:5|max:200',
  'category'=>'required',
  'jobType'=>'required',
  'vacancy'=>'required|integer|max:50',
  'location'=>'required',
  'description'=>'required',
  'experience'=>'required',
  'company_name'=>'required|min:3|max:75',
  ];
  
  $validator=Validator::make($request->all(),$rule);
  
  if($validator->passes()){
  $job=job::find($id);
  $job->title=$request->title;
  $job->category_id=$request->category;
  $job->job_type_id=$request->jobType;
  $job->	user_id=Auth::user()->id;
  $job->Vacancy = $request->vacancy;
  $job->salary=$request->salary;
  $job->location=$request->location;
  $job->description=$request->description;
  $job->benefits=$request->benefits;
  $job->responsibality=$request->responsibility;
  $job->qualifications=$request->qualifications;
  $job->keywords=$request->keywords;
  $job->experiance=$request->experience;
  $job->company_name=$request->company_name;
  $job->company_location=$request->com_location;
  $job->comapny_website=$request->website;
  $job->save();
  
  session()->flash('success','job updated  successfully');
  
  return response()->json([
    'status' => true,
    'errors' => []
]);
  
  }else{
    return response()->json([
      'status'=>false,
      'errors'=>$validator->errors()
    ]);
  }
  
  }


  public function deletejob(Request $request){
$job=job::where([
'user_id'=>Auth::user()->id,
'id'=>$request->jobid,
])->first();

if($job==null){
  session()->flash('error','Either job deleted or  not found');
  return response()->json([
 'status'=>true,

  ]);
}
job::where('id',$request->jobid)->delete();
session()->flash('success','job deleted successfully');
  return response()->json([
 'status'=>true,
  ]);
  }

  public function myjobsApplications(){

    $jobApplications=JobApplication::where('user_id',Auth::user()->id)->with(['job','job.jobType'])->paginate(10);
    return view('front.my-job-applications',['jobApplications'=> $jobApplications]);
  }


  public function removejobs(Request $request){
 $jobApplications=JobApplication::where(['id'=>$request->id, 'user_id'=>Auth::user()->id])->first()->get();
 if($jobApplications==null){
  return response()->json([
'status'=>false,
'message'=>'job already removed or not fount'
  ]);
 }
 JobApplication::find($request)->delete();
 return response()->json([
  'status'=>true,
  'message'=>'job removed successfully'
    ]);
  

}


//profile building of the user 



public function savePersonalDetails(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'fname' => 'required',
        'phone' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

    // ✅ MAIN FIX HERE
    PersonalDetail::updateOrCreate(
        ['user_id' => Auth::id()], // condition (find record)
        [
            'name' => $request->name,
            'cnic' => $request->cnic,
            'fname' => $request->fname,
            'phone' => $request->phone,
            'landline' => $request->landline,
            'gmail' => $request->gmail,
        ]
    );

    return response()->json([
        'status' => true
    ]);
}


public function saveAddress(Request $request)
{
    $validator = Validator::make($request->all(), [
        'country' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:50',
        'full_address' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

    try {

        Address::updateOrCreate(

            ['user_id' => Auth::id()],

            [
                'country'      => $request->country,
                'city'         => $request->city,
                'state'        => $request->state,
                'postal_code'  => $request->postal_code,
                'full_address' => $request->full_address,
            ]

        );

        return response()->json([
            'status' => true,
            'message' => 'Address saved successfully'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}


public function applicantProfile($id, $job)
{
    $jobId = $job;

    // Applicant User
    $user = User::findOrFail($id);

    // Applicant ki job application
    $application = JobApplication::where('job_id', $jobId)
                    ->where('user_id', $id)
                    ->firstOrFail();

    // Personal Details
    $personal = PersonalDetail::where('user_id', $id)->first();

    // Address
    $address = Address::where('user_id', $id)->first();

    // Education
    $educations = Education::where('user_id', $id)->get();

    // Skills
    $skills = Skill::where('user_id', $id)->get();

    // Experience
    $experiences = Experience::where('user_id', $id)->get();

    // Languages
    $languages = Language::where('user_id', $id)->get();

    return view(
        'front.account.job.applicant-profile',
        compact(
            'user',
            'application',
            'personal',
            'address',
            'educations',
            'skills',
            'experiences',
            'languages',
            'jobId'
        )
    );
}

public function jobApplicants($id)
{
    $job = Job::findOrFail($id);

    return view('front.account.job.applicants', compact('job'));
}


public function selectedApplicant($application, $job)
{
    $application = JobApplication::findOrFail($application);

    $application->status = 'selected';
    $application->save();

    return redirect()
        ->route('account.jobApplicants', $job)
        ->with('success', 'Applicant Selected Successfully!');
}

public function rejectedApplicant($application, $job)
{
    $application = JobApplication::findOrFail($application);

    $application->status = 'rejected';
    $application->save();

    return redirect()
        ->route('account.jobApplicants', $job)
        ->with('success', 'Applicant Rejected Successfully!');
}

public function selectedCandidates()
{
    $jobs = Job::where('user_id', Auth::id())
        ->with([
            'applications' => function ($query) {
                $query->where('status', 'selected');
            },
            'applications.user',
            'applications.user.personalDetail'
        ])
        ->get();

    return view('front.account.selected-candidates', compact('jobs'));
}

}




