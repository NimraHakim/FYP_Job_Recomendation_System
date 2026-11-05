@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light">
<div class="container py-5">

    <div class="row">
        <div class="col">
            <nav class="mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Education
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-lg-3">

            <div class="card border-0 shadow mb-4 p-3 text-center">

                <h5 class="mt-3 mb-0">
                    {{ Auth::user()->name }}
                </h5>

                <p class="text-muted mb-2">
                    {{ Auth::user()->desigination ?? 'No Designation' }}
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

                    <li class="list-group-item active">
                        <a href="{{ route('education') }}">
                            Education
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a href="{{ route('skills') }}">
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

                    <li class="list-group-item">
                        <a href="{{ route('account.logout') }}"
                           class="text-danger">
                            Logout
                        </a>
                    </li>

                </ul>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="col-lg-9">

            <form id="createjobform">

                @csrf

                <div class="card border-0 shadow mb-4">

                    <div class="card-body p-4">

                        <h3 class="fs-4 mb-4">
                            Education
                        </h3>

                        <div class="mb-4">

                            <label class="mb-2">
                                Degree Level *
                            </label>

                            <select
                                name="degree_level"
                                id="degree_level"
                                class="form-control">

                                <option value="">
                                    Select Education Level
                                </option>

                                <option value="10-year">
                                    10-year
                                </option>

                                <option value="12-year">
                                    12-year
                                </option>

                                <option value="14-year">
                                    14-year
                                </option>

                                <option value="16-year">
                                    16-year
                                </option>

                                <option value="18-year">
                                    18-year
                                </option>

                                <option value="20-year">
                                    20-year
                                </option>

                            </select>

                            <p class="text-danger"></p>

                        </div>

                        <div class="mb-4">

                            <label class="mb-2">
                                School / College *
                            </label>

                            <input
                                type="text"
                                name="school"
                                id="school"
                                class="form-control">

                            <p class="text-danger"></p>

                        </div>

                        <div class="mb-4">

                            <label class="mb-2">
                                Board / University *
                            </label>

                            <input
                                type="text"
                                name="board"
                                id="board"
                                class="form-control">

                            <p class="text-danger"></p>

                        </div>

                        <div class="mb-4">

                            <label class="mb-2">
                                Total Marks *
                            </label>

                            <input
                                type="number"
                                name="total_marks"
                                id="total_marks"
                                class="form-control">

                            <p class="text-danger"></p>

                        </div>

                        <div class="mb-4">

                            <label class="mb-2">
                                Obtained Marks *
                            </label>

                            <input
                                type="number"
                                name="obtained_marks"
                                id="obtained_marks"
                                class="form-control">

                            <p class="text-danger"></p>

                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between p-4">

                        <button
                            type="submit"
                            class="btn btn-success">

                            Save Data

                        </button>

                        <a href="{{ route('skills') }}"
                           class="btn btn-primary">

                            Next →

                        </a>

                    </div>

                </div>

            </form>

            <!-- EDUCATION LIST -->

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h3 class="fs-4 mb-4">
                        My Education
                    </h3>

                    @forelse($educations as $education)

                        <div class="border rounded p-3 mb-3">

                            <h5>
                                {{ $education->degree_level }}
                            </h5>

                            <p>
                                <strong>School:</strong>
                                {{ $education->school }}
                            </p>

                            <p>
                                <strong>Board:</strong>
                                {{ $education->board }}
                            </p>

                            <p>
                                <strong>Total Marks:</strong>
                                {{ $education->total_marks }}
                            </p>

                            <p>
                                <strong>Obtained Marks:</strong>
                                {{ $education->obtained_marks }}
                            </p>

                        </div>

                    @empty

                        <p>
                            No education added yet.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>
</section>

@endsection


@section('customJs')

<script>

$("#createjobform").submit(function(e){

    e.preventDefault();

    $(".form-control").removeClass('is-invalid');
    $(".text-danger").html('');

    $.ajax({

        url: "{{ route('education.store') }}",

        type: "POST",

        data: $(this).serialize(),

        dataType: "json",

        success: function(response){

            if(response.status == true){

                alert(response.message);

                location.reload();

            }else{

                $.each(response.errors,function(key,value){

                    $("#" + key)
                        .addClass('is-invalid');

                    $("#" + key)
                        .next(".text-danger")
                        .html(value[0]);

                });

            }

        },

        error:function(xhr){

            console.log(xhr.responseText);

            alert("Error - Check Console");

        }

    });

});

</script>

@endsection