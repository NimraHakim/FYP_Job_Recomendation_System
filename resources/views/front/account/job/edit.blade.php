@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <form name="editjobform" id="editjobform" >
                    @csrf
                
                <div class="card border-0 shadow mb-4 ">
                    <div class="card-body card-form p-4">
                        <h3 class="fs-4 mb-1">Edit Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Title<span class="req">*</span></label>
                                <input value="{{ $job->title }}" type="text" placeholder="Job Title" id="title" name="title" class="form-control">
                            <p></p>
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Category<span class="req">*</span></label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a Category</option>
                                    @if($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                            <option  {{ ($job->category_id)==$category->id? 'selected':'' }}  value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>  
                                <p></p>                              
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                                <select name="jobType" id="jobType" class="form-select">
                                    @if($jobType->isNotEmpty())
                             
                                    <option value="">Select Job Type</option>
                                        @foreach ($jobType as $type)
                                   <option value="{{ $type->id }}" {{ $job->job_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                      </option>
                                       @endforeach

                                @endif                                
                                </select>
                                <p></p>
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                <input type="number"  value="{{ $job->Vacancy }}" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                            <p></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Salary</label>
                                <input value="{{ $job->salary }}" type="text" placeholder="Salary" id="salary" name="salary" class="form-control">
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location<span class="req">*</span></label>
                                <input value="{{ $job->location }}" type="text" placeholder="location" id="location" name="location" class="form-control">
                            <p></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Description<span class="req">*</span></label>
                           <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $job->description }}</textarea>
                        <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Benefits</label>
                            <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Responsibility</label>
                            <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $job->responsibality }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Qualifications</label>
                            <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ $job->qualifications }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Experience<span class="req">*</span></label>
                            <select name="experience" id="experience" class="form-control">
                                <option value="1" {{ ($job->experiance==1)?'selected':'' }}>1 year</option>
                                <option value="2" {{ ($job->experiance==2)?'selected':'' }}>2 year</option>
                                <option value="3" {{ ($job->experiance==3)?'selected':'' }}>3 year</option>
                                <option value="4" {{ ($job->experiance==4)?'selected':'' }}>4 year</option>
                                <option value="5" {{ ($job->experiance==5)?'selected':'' }}>5 year</option>
                                <option value="6" {{ ($job->experiance==6)?'selected':'' }}>6 year</option>
                                <option value="7" {{ ($job->experiance==7)?'selected':'' }}>7 year</option>
                                <option value="8" {{ ($job->experiance==8)?'selected':'' }}>8 year</option>
                                <option value="9" {{ ($job->experiance==9)?'selected':'' }}>9 year</option>
                                <option value="10" {{ ($job->experiance==10)?'selected':'' }}>10 year</option>
                                <option value="10_plus" {{ ($job->experiance=='10_plus')?'selected':'' }}>10+ year</option>
                            </select>
                            <p></p>
                        </div>
                        

                        <div class="mb-4">
                            <label for="" class="mb-2">Keywords</label>
                            <input value="{{ $job->keywords }}" type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                        </div>

                        <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Name<span class="req">*</span></label>
                                <input value="{{ $job->company_name }}" type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                            <p></p>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location</label>
                                <input value="{{ $job->company_location }}" type="text" placeholder="Location" id="com_location" name="com_location" class="form-control">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Website</label>
                            <input value="{{ $job->comapny_website }}" type="text" placeholder="Website" id="website" name="website" class="form-control">
                        </div>
                    </div> 
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update Job</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
        <script type="text/javascript">
    $("#editjobform").submit(function(e) {
    e.preventDefault();
    $("button[type='submit']").prop('disabled',true)
    $.ajax({
        url: '{{ route("account.updatejob", $job->id) }}',
        type: 'POST',
        dataType: 'json',
        data: $("#editjobform").serialize(),
        success: function(response) {
            if (response.status === true) {
                $("button[type='submit']").prop('disabled',false)
                alert('Job updated successfully!');
                window.location.href = '{{ route("account.editJob", $job->id) }}';
            } else {
                var errors = response.errors;
                $.each(errors, function(field, errorMessages) {
                    var input = $("#" + field);
                    if (errorMessages.length > 0) {
                        input.addClass('is-invalid')
                            .siblings('p').addClass('invalid-feedback')
                            .html(errorMessages[0]);
                    } else {
                        input.removeClass('is-invalid')
                            .siblings('p').removeClass('invalid-feedback')
                            .html('');
                    }
                });
            }
        },
  
    });
});

</script>

@endsection
