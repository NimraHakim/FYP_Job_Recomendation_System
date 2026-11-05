

@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light">

    <div class="container py-5">

        <div class="row">

            <!-- LEFT SIDEBAR -->
            <div class="col-lg-3">

                <div class="card border-0 shadow mb-4 p-3 text-center">

                    <h5 class="mt-3 mb-0">
                        {{ Auth::user()->name }}
                    </h5>

                    <p class="text-muted mb-2">
                        {{ Auth::user()->designation ?? 'No Designation' }}
                    </p>

                </div>

                <div class="card border-0 shadow">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <a href="{{ route('personal_details') }}">
                                Personal Details
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('adress') }}">
                                Address
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('education') }}">
                                Education
                            </a>
                        </li>

                        <li class="list-group-item active">
                            <a href="{{ route('skills') }}" class="text-white">
                                Skills
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('experience') }}">
                                Experience
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('languages') }}">
                                Languages
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-lg-9">

                <form id="createSkillForm">

                    @csrf

                    <input type="hidden" id="skill_id">

                    <div class="card border-0 shadow mb-4">

                        <div class="card-body p-4">

                            <h3 class="fs-4 mb-4">
                                Skills
                            </h3>

                            <div class="mb-4">

                                <label class="mb-2">
                                    Name of Skill
                                </label>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control">

                                <p class="text-danger"></p>

                            </div>

                            <div class="mb-4">

                                <label class="mb-2">
                                    Level of Skill
                                </label>

                                <select name="level"
                                        id="level"
                                        class="form-control">

                                    <option value="">
                                        Select Skill Level
                                    </option>

                                    <option value="Expert">
                                        Expert
                                    </option>

                                    <option value="Intermediate">
                                        Intermediate
                                    </option>

                                    <option value="Beginner">
                                        Beginner
                                    </option>

                                </select>

                                <p class="text-danger"></p>

                            </div>

                        </div>

                        <div class="card-footer p-4 d-flex justify-content-between">

                            <button type="submit"
                                    class="btn btn-success"
                                    id="saveBtn">

                                Save Data

                            </button>

                            <a href="{{ route('experience') }}"
                               class="btn btn-primary">

                                Next →

                            </a>

                        </div>

                    </div>

                </form>

                <!-- SHOW SKILLS -->

                <div class="card border-0 shadow">

                    <div class="card-body">

                        <h3 class="fs-4 mb-4">
                            My Skills
                        </h3>

                        @if($skills->count() > 0)

                            @foreach($skills as $skill)

                                <div class="border rounded p-3 mb-3">

                                    <div class="d-flex justify-content-between">

                                        <div>

                                            <h5>
                                                {{ $skill->name }}
                                            </h5>

                                            <p>
                                                <strong>Level:</strong>
                                                {{ $skill->level }}
                                            </p>

                                        </div>

                                        <div class="d-flex gap-2">

                                            <button
                                                class="btn btn-primary btn-sm editSkill"
                                                data-id="{{ $skill->id }}"
                                                data-name="{{ $skill->name }}"
                                                data-level="{{ $skill->level }}"
                                            >
                                                Edit
                                            </button>

                                            <button
                                                class="btn btn-danger btn-sm deleteSkill"
                                                data-id="{{ $skill->id }}"
                                            >
                                                Delete
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        @else

                            <p>
                                No skills added yet.
                            </p>

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

// STORE + UPDATE

$("#createSkillForm").submit(function(e){

    e.preventDefault();

    let skillId = $('#skill_id').val();

    let url = '';

    if(skillId == ''){

        url = '{{ route("skills.store") }}';

    } else {

        url = '/skills/update/' + skillId;
    }

    $("button[type='submit']").prop('disabled', true);

    $.ajax({

        url: url,

        type: 'POST',

        dataType: 'json',

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
                        .after('<p class="invalid-feedback text-danger">'+value[0]+'</p>');

                });
            }
        }
    });
});

// EDIT

$(document).on('click', '.editSkill', function(){

    $('#skill_id').val($(this).data('id'));

    $('#name').val($(this).data('name'));

    $('#level').val($(this).data('level'));

    $('#saveBtn').text('Update Skill');

    $('html, body').animate({

        scrollTop: $("#createSkillForm").offset().top

    }, 500);

});

// DELETE

$(document).on('click', '.deleteSkill', function(){

    if(confirm('Are you sure you want to delete this skill?')){

        var skillId = $(this).data('id');

        $.ajax({

            url: '{{ route("skills.delete") }}',

            type: 'POST',

            data: {

                _token: '{{ csrf_token() }}',

                id: skillId

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