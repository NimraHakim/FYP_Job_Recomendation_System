@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light">

    <div class="container py-5">

        <!-- Breadcrumb -->
        <div class="row">
            <div class="col">
                <nav class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Account Settings
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">

            <!-- LEFT SIDEBAR -->
            <div class="col-lg-3">

                <!-- Profile Card -->
              @include('front.account.sidebar2')

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-lg-9">

                @include('front.message')

                <form id="createExperienceForm">

                    @csrf

                    <input type="hidden" id="experience_id">

                    <div class="card border-0 shadow mb-4">

                        <div class="card-body p-4">

                            <h3 class="fs-4 mb-4">
                                Experience
                            </h3>

                            <!-- FIELD NAME -->

                            <div class="mb-4">

                                <label class="mb-2">
                                    Field Name
                                </label>

                                <input type="text"
                                       name="field_name"
                                       id="field_name"
                                       class="form-control"
                                       placeholder="Enter field name">

                                <p class="text-danger"></p>

                            </div>

                            <!-- COMPANY NAME -->

                            <div class="mb-4">

                                <label class="mb-2">
                                    Company / Organization Name
                                </label>

                                <input type="text"
                                       name="company_name"
                                       id="company_name"
                                       class="form-control"
                                       placeholder="Enter company name">

                                <p class="text-danger"></p>

                            </div>

                            <!-- YEARS -->

                            <div class="mb-4">

                                <label class="mb-2">
                                    Years of Experience
                                </label>

                                <input type="number"
                                       name="years"
                                       id="years"
                                       class="form-control"
                                       placeholder="Enter years of experience">

                                <p class="text-danger"></p>

                            </div>

                            <!-- DESCRIPTION -->

                            <div class="mb-4">

                                <label class="mb-2">
                                    Experience Description
                                </label>

                                <textarea
                                    name="description"
                                    id="description"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Explain your work experience, responsibilities, projects, achievements, technologies, and skills..."
                                ></textarea>

                                <p class="text-danger"></p>

                            </div>

                        </div>

                        <!-- BUTTONS -->

                        <div class="card-footer p-4 d-flex justify-content-between">

                            <button type="submit"
                                    class="btn btn-success"
                                    id="saveBtn">

                                Save Data

                            </button>

                            <a href="{{ route('languages') }}"
                               class="btn btn-primary">

                                Next →

                            </a>

                        </div>

                    </div>

                </form>

                <!-- EXPERIENCE LIST -->

                <div class="card border-0 shadow">

                    <div class="card-body">

                        <h3 class="fs-4 mb-4">
                            My Experience
                        </h3>

                        @if($experiences->count() > 0)

                            @foreach($experiences as $experience)

                                <div class="border rounded p-4 mb-3">

                                    <div class="d-flex justify-content-between">

                                        <div>

                                            <h5>
                                                {{ $experience->field_name }}
                                            </h5>

                                            <p>
                                                <strong>Company:</strong>
                                                {{ $experience->company_name }}
                                            </p>

                                            <p>
                                                <strong>Experience:</strong>
                                                {{ $experience->years }} Years
                                            </p>

                                            <p>
                                                <strong>Description:</strong>
                                                {{ $experience->description }}
                                            </p>

                                        </div>

                                        <div class="d-flex gap-2">

                                            <!-- EDIT -->

                                            <button
                                                class="btn btn-primary btn-sm editExperience"
                                                data-id="{{ $experience->id }}"
                                                data-field="{{ $experience->field_name }}"
                                                data-company="{{ $experience->company_name }}"
                                                data-years="{{ $experience->years }}"
                                                data-description="{{ $experience->description }}"
                                            >
                                                Edit
                                            </button>

                                            <!-- DELETE -->

                                            <button
                                                class="btn btn-danger btn-sm deleteExperience"
                                                data-id="{{ $experience->id }}"
                                            >
                                                Delete
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        @else

                            <p>No experience added yet.</p>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection


@section('customJs')

<script>

// SAVE + UPDATE

$("#createExperienceForm").submit(function(e){

    e.preventDefault();

    let experienceId = $('#experience_id').val();

    let url = '';

    if(experienceId == ''){

        url = '{{ route("experience.store") }}';

    } else {

        url = '/experience/update/' + experienceId;
    }

    $("button[type='submit']").prop('disabled', true);

    $.ajax({

        url: url,

        type: 'POST',

        data: $(this).serialize(),

        success: function(response){

            $("button[type='submit']").prop('disabled', false);

            if(response.status == true){

                alert(response.message);

                window.location.reload();

            } else {

                var errors = response.errors;

                $('.invalid-feedback').remove();

                $('.is-invalid').removeClass('is-invalid');

                $.each(errors, function(key, value){

                    $('#' + key)
                        .addClass('is-invalid')
                        .after('<p class=\"invalid-feedback text-danger\">'+value[0]+'</p>');
                });
            }
        }
    });
});


// EDIT

$(document).on('click', '.editExperience', function(){

    $('#experience_id').val($(this).data('id'));

    $('#field_name').val($(this).data('field'));

    $('#company_name').val($(this).data('company'));

    $('#years').val($(this).data('years'));

    $('#description').val($(this).data('description'));

    $('#saveBtn').text('Update Experience');

});


// DELETE

$(document).on('click', '.deleteExperience', function(){

    if(confirm('Are you sure you want to delete this experience?')){

        var experienceId = $(this).data('id');

        $.ajax({

            url: '{{ route("experience.delete") }}',

            type: 'POST',

            data: {

                _token: '{{ csrf_token() }}',

                id: experienceId
            },

            success: function(response){

                if(response.status == true){

                    window.location.reload();
                }
            }
        });
    }
});

</script>

@endsection