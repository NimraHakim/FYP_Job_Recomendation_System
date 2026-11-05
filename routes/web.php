<?php
use App\Http\Controllers\EducationController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\jobsController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileReviewController;
use App\Http\Controllers\AIJobController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/job-applicants/{id}',
[AccountController::class,'jobApplicants'])
->name('job.applicants');
Route::get('/applicant-profile/{id}',
    [AccountController::class,'applicantProfile'])
    ->name('applicant.profile');
route::get('/',[homeController::class,'index'])->name('home');
route::get('/jobs',[jobsController::class,'index'])->name('jobs');
route::get('/jobs/details/{id}',[jobsController::class,'details'])->name('details');
route::post('/applyjob',[jobsController::class,'applyjob'])->name('applyjob');




route::get('/account/logout',[accountController::class,'logout'])->name('account.logout');
route::group(['middleware'=>'guest'],function(){
//guest routes

route::get('/account/register',[accountController::class,'registration'])->name('account.registration');
route::post('/account/processregister',[accountController::class,'processregistration'])->name('account.processregistration');
Route::get('/account/login',[AccountController::class,'login'])->name('account.login');
route::post('/account/authenticate',[accountController::class,'authenticate'])->name('account.authenticate');


});
route::group(['middleware'=>'auth'],function(){
    //authenticated routes
    route::get('/account/profile',[accountController::class,'profile'])->name('account.profile');
    route::put('/account/update-profile',[accountController::class,'updateProfile'])->name('account.updateProfile');
    
    Route::post('/account/updateProfilepic', [AccountController::class, 'updateProfilepic'])->name('account.updateProfilepic');
    route::get('/account/create-job',[accountController::class,'createJob'])->name('account.createJob');
    Route::post('/account/save-job', [AccountController::class, 'savejob'])->name('account.savejob');
    Route::get('/account/my-jobs', [AccountController::class, 'myjobs'])->name('account.myjobs');
    Route::get('/account/my-jobs/edit/{jobid}', [AccountController::class, 'editJob'])->name('account.editJob');
    Route::post('/account/update-job/{jobid}', [AccountController::class, 'updatejob'])->name('account.updatejob');
    Route::post('/account/delete-job', [AccountController::class, 'deletejob'])->name('account.deletejob'); 
    Route::get('/account/my-job-applications', [AccountController::class, 'myjobsApplications'])->name('account.myjobsApplications');
    Route::post('/remove-jobs', [AccountController::class, 'removejobs'])->name('account.removejobs');
});

Route::get('/seeker_profile', [HomeController::class, 'seeker_profile'])->name('seeker_profile');
route::get('/personal_details',[homeController::class,'personal_details'])->name('personal_details');
route::get('/adress',[homeController::class,'adress'])->name('adress');
route::get('/skills',[homeController::class,'skills'])->name('skills');
route::get('/languages',[homeController::class,'languages'])->name('languages');
route::get('/education',[homeController::class,'education'])->name('education');
route::get('/experience',[homeController::class,'experience'])->name('experience');



Route::get('/seeker_profile',[HomeController::class,'seeker_profile'])->name('seeker_profile');

Route::get('/account/profile',[AccountController::class,'profile'])->name('account.profile');


Route::post('/save-personal-details',[AccountController::class,'savePersonalDetails'])
    ->name('account.savePersonalDetails'); 

Route::post('/account/save-address', [AccountController::class, 'saveAddress'])->name('account.saveAddress');





Route::middleware(['auth'])->group(function () {

    Route::get('/education', [EducationController::class, 'index'])
        ->name('education');

    Route::post('/education/store', [EducationController::class, 'store'])
        ->name('education.store');

    Route::get('/education/edit/{id}', [EducationController::class, 'edit'])
        ->name('education.edit');

    Route::post('/education/update/{id}', [EducationController::class, 'update'])
        ->name('education.update');

    Route::post('/education/delete', [EducationController::class, 'destroy'])
        ->name('education.delete');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/skills', [SkillController::class, 'index'])
        ->name('skills');

    Route::post('/skills/store', [SkillController::class, 'store'])
        ->name('skills.store');

    Route::post('/skills/update/{id}', [SkillController::class, 'update'])
        ->name('skills.update');

    Route::post('/skills/delete', [SkillController::class, 'destroy'])
        ->name('skills.delete');

});


Route::middleware(['auth'])->group(function () {

    Route::get('/experience', [ExperienceController::class, 'index'])
        ->name('experience');

    Route::post('/experience/store', [ExperienceController::class, 'store'])
        ->name('experience.store');

    Route::post('/experience/update/{id}', [ExperienceController::class, 'update'])
        ->name('experience.update');

    Route::post('/experience/delete', [ExperienceController::class, 'destroy'])
        ->name('experience.delete');

});


Route::middleware(['auth'])->group(function () {

    Route::get('/languages', [LanguageController::class, 'index'])
        ->name('languages');

    Route::post('/languages/store', [LanguageController::class, 'store'])
        ->name('languages.store');

    Route::post('/languages/update/{id}', [LanguageController::class, 'update'])
        ->name('languages.update');

    Route::post('/languages/delete', [LanguageController::class, 'destroy'])
        ->name('languages.delete');

});



Route::get('/profile-review', [ProfileReviewController::class, 'index'])
    ->name('profile.review');



    Route::get('/ai-recommendations', [AIJobController::class, 'recommendJobs'])
    ->name('ai.recommendations');


   Route::get('/applicant-profile/{id}/{job}',
    [AccountController::class,'applicantProfile'])
    ->name('applicant.profile');

Route::get('/selected-applicant/{application}/{job}',
    [AccountController::class,'selectedApplicant'])
    ->name('account.selectedApplicant');

Route::get('/rejected-applicant/{application}/{job}',
    [AccountController::class,'rejectedApplicant'])
    ->name('account.rejectedApplicant');

  Route::get('/job-applicants/{id}', [AccountController::class, 'jobApplicants'])
    ->name('account.jobApplicants');

   Route::get('/account/selected-candidates',
    [AccountController::class,'selectedCandidates'])
    ->name('account.selectedCandidates');