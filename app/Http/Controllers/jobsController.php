<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\job;
use App\Models\JobApplication;
use App\Models\jobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
class jobsController extends Controller
{
    //this method will show jobs page 
    public function index(Request $request){
       $categories=category::where('status',1)->get();
       $jobTypes=jobType::where('status',1)->get();

      $jobs=job::where('status',1);
//seach on the bases of keywords
if(!empty($request->keyword)){
    //group where clause because when we use or clause then we need to create group
$jobs=$jobs->where(function($query) use($request){
$query->orwhere('title','like','%'.$request->keyword.'%' );
$query->orwhere('keywords','like','%'.$request->keyword.'%' );
});
}

//seach using location 
if(!empty($request->location)){
    $jobs=$jobs->where('location',$request->location);
}

//search using category
if(!empty($request->category)){
    $jobs=$jobs->where('category_id',$request->category);
}

//search using experience
if(!empty($request->experience)){
    $jobs=$jobs->where('experiance',$request->experience);
}
$jobsTypeArray=[];
//search using type
if(!empty($request->jobType)){
    //1,2,3
   $jobsTypeArray= explode(',',$request->jobType);
    $jobs=$jobs->whereIn('job_type_id',$jobsTypeArray);
}

$jobs=$jobs->with(['jobType','category']);
if( $request->sort=='0'){
    $jobs=$jobs->orderBy('created_at','ASC');
}else{
    $jobs=$jobs->orderBy('created_at','DESC');
}

$jobs=$jobs->paginate(12);
return view('front.jobs',['categories'=>$categories,'jobTypes'=> $jobTypes,
'jobs'=> $jobs,'jobsTypeArray'=>$jobsTypeArray]);
    }
//this method willshow job details
    public function details($id){
$job=job::where(['id'=>$id, 'status'=>1])->with(['jobType','category'])->first();
// dd($job);
if($job==null){
    abort(404);
}
return view('front.jobDetail',['job'=>$job]);
    }

    public function applyjob(Request $request){
$id=$request->id;
$jobs=job::where('id',$id)->first();
//if job not found in db
if($jobs==null){
    session()->flash('error','job does not exist');
return response()->json([
    'status'=>false,
    'message'=>'job does not exist'
]);
}
//you can't apply on your own job 
$employer_id=$jobs->user_id;
if($employer_id==Auth::user()->id){
    session()->flash('error','you cannot apply on your own job');
return response()->json([
    'status'=>false,
    'message'=>'you cannot apply on your own job'
]); 
}

//you can not apply on ingle job more than once  
$jobApplicationcount=JobApplication::where([
'user_id'=>Auth::user()->id,
'job_id'=>$id
])->count();
if($jobApplicationcount>0){
    session()->flash('error','you already apply on this job');
    return response()->json([
        'status'=>false,
        'message'=>'you calready apply on this job '
    ]); 
}

$jobApplication=new JobApplication();
$jobApplication->job_id=$id;
$jobApplication->user_id=Auth::user()->id;
$jobApplication->employer_id=$employer_id;
$jobApplication->applied_date=now();
$jobApplication->save();

session()->flash('success','apply in job successfully');
return response()->json([
    'status'=>true,
    'message'=>'apply in job successfully'
]); 
    }



    
}


