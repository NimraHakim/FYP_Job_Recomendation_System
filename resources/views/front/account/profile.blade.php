@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">

        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
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

            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>

            <div class="col-lg-9">

                @include('front.message')

                <div class="card border-0 shadow mb-4">

                    <form id="userform">

                        @csrf
                        @method('PUT')

                        <div class="card-body p-4">

                            <h3 class="fs-4 mb-4">
                                My Profile
                            </h3>

                            <div class="mb-3">
                                <label>Name *</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    value="{{ Auth::user()->name }}"
                                >

                                <small class="text-danger" id="nameError"></small>
                            </div>

                            <div class="mb-3">
                                <label>Email *</label>

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ Auth::user()->email }}"
                                >

                                <small class="text-danger" id="emailError"></small>
                            </div>

                            <div class="mb-3">
                                <label>Designation</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="desigination"
                                    name="desigination"
                                    value="{{ Auth::user()->desigination }}"
                                >

                                <small class="text-danger" id="desiginationError"></small>
                            </div>

                            <div class="mb-3">
                                <label>Mobile</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="mobile"
                                    name="mobile"
                                    value="{{ Auth::user()->mobile }}"
                                >

                                <small class="text-danger" id="mobileError"></small>
                            </div>

                        </div>

                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">
                                Update Profile
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection


@section('customJs')

<script>

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("userform");

    form.addEventListener("submit", function(e){

        e.preventDefault();

        document.getElementById("nameError").innerHTML = "";
        document.getElementById("emailError").innerHTML = "";
        document.getElementById("desiginationError").innerHTML = "";
        document.getElementById("mobileError").innerHTML = "";

        fetch("{{ route('account.updateProfile') }}", {

            method: "POST",

            headers: {

                "X-CSRF-TOKEN": "{{ csrf_token() }}",

                "Accept": "application/json",

                "Content-Type": "application/x-www-form-urlencoded"

            },

            body: new URLSearchParams(new FormData(form))

        })

        .then(response => response.json())

        .then(data => {

            if(data.status == true || data.status == "true")
            {
                alert("Profile Updated Successfully!");

                window.location.href = "{{ route('account.profile') }}";
            }
            else
            {
                if(data.errors)
                {
                    if(data.errors.name)
                        document.getElementById("nameError").innerHTML = data.errors.name[0];

                    if(data.errors.email)
                        document.getElementById("emailError").innerHTML = data.errors.email[0];

                    if(data.errors.desigination)
                        document.getElementById("desiginationError").innerHTML = data.errors.desigination[0];

                    if(data.errors.mobile)
                        document.getElementById("mobileError").innerHTML = data.errors.mobile[0];
                }
            }

        })

        .catch(error => {

            console.log(error);

            alert("Something went wrong!");

        });

    });

});

</script>

@endsection