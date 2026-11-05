@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-light">
    <div class="container py-5">

        <div class="row">
            <div class="col">
                <nav class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">

            <!-- LEFT SIDEBAR -->
            <div class="col-lg-3">
                @include('front.account.sidebar2')
            </div>

            <!-- RIGHT CONTENT -->
            <div class="col-lg-9">

                <form id="createjobform" method="POST">
                    @csrf

                    <div class="card border-0 shadow mb-4">

                        <div class="card-body p-4">

                            <h3 class="fs-4 mb-3">
                                Personal Details
                            </h3>

                            <!-- NAME -->

                            <div class="mb-4">
                                <label>Name*</label>

                                <input type="text"
                                       id="name"
                                       name="name"
                                       class="form-control"
                                       value="{{ $profile->name ?? Auth::user()->name }}">

                                <p class="text-danger"></p>
                            </div>

                            <!-- CNIC + FATHER NAME -->

                            <div class="row">

                                <div class="col-md-6 mb-4">

                                    <label>CNIC</label>

                                    <input type="text"
                                           id="cnic"
                                           name="cnic"
                                           class="form-control"
                                           value="{{ $profile->cnic ?? '' }}">
                                </div>

                                <div class="col-md-6 mb-4">

                                    <label>Father Name*</label>

                                    <input type="text"
                                           id="fname"
                                           name="fname"
                                           class="form-control"
                                           value="{{ $profile->fname ?? '' }}">

                                    <p class="text-danger"></p>

                                </div>

                            </div>

                            <!-- PHONE -->

                            <div class="mb-4">

                                <label>Phone*</label>

                                <input type="text"
                                       id="phone"
                                       name="phone"
                                       class="form-control"
                                       value="{{ $profile->phone ?? '' }}">

                                <p class="text-danger"></p>

                            </div>

                            <!-- LANDLINE -->

                            <div class="mb-4">

                                <label>Landline</label>

                                <input type="text"
                                       id="landline"
                                       name="landline"
                                       class="form-control"
                                       value="{{ $profile->landline ?? '' }}">

                            </div>

                            <!-- EMAIL -->

                            <div class="mb-4">

                                <label>Email</label>

                                <input type="email"
                                       id="gmail"
                                       name="gmail"
                                       class="form-control"
                                       value="{{ Auth::user()->email }}"
                                       readonly>

                            </div>

                        </div>

                        <!-- BUTTONS -->

                        <div class="card-footer d-flex justify-content-between p-4">

                            <button type="submit"
                                    name="action"
                                    value="save"
                                    class="btn btn-success">

                                {{ $profile ? 'Update Profile' : 'Save Data' }}

                            </button>

                            <button type="submit"
                                    name="action"
                                    value="next"
                                    class="btn btn-primary">

                                Next →

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
</section>
@endsection


@section('customJs')

<script>

$("#createjobform").submit(function(e){

    e.preventDefault();

    let action = $(document.activeElement).val();

    $("button[type='submit']").prop('disabled', true);

    $(".form-control").removeClass('is-invalid');

    $(".text-danger").html('');

    $.ajax({

        url: '{{ route("account.savePersonalDetails") }}',

        type: 'POST',

        dataType: 'json',

        data: $(this).serialize(),

        success: function(response){

            $("button[type='submit']").prop('disabled', false);

            if(response.status === true){

                if(action === 'next'){

                    window.location.href =
                    '{{ route("adress") }}';

                }else{

                    alert('Profile saved successfully!');
                }

            }else{

                $.each(response.errors, function(field, messages){

                    $("#" + field)
                        .addClass('is-invalid');

                    $("#" + field)
                        .closest('div')
                        .find('.text-danger')
                        .html(messages[0]);
                });
            }
        },

        error: function(){

            $("button[type='submit']").prop('disabled', false);

            alert('Something went wrong!');
        }

    });

});

</script>

@endsection