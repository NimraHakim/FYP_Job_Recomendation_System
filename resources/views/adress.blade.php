@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-light">
    <div class="container py-5">

        <div class="row">

            <!-- LEFT SIDEBAR -->
            <div class="col-lg-3">
                @include('front.account.sidebar2')
            </div>

            <!-- RIGHT CONTENT -->
            <div class="col-lg-9">

                <form id="addressForm">
                    @csrf

                    <div class="card border-0 shadow">

                        <div class="card-body p-4">

                            <h3 class="mb-4">
                                Address Details
                            </h3>

                            <!-- COUNTRY -->

                            <div class="mb-3">
                                <label>Country *</label>

                                <input type="text"
                                       name="country"
                                       id="country"
                                       class="form-control"
                                       value="{{ $address->country ?? '' }}">

                                <p class="text-danger"></p>
                            </div>

                            <!-- CITY -->

                            <div class="mb-3">
                                <label>City *</label>

                                <input type="text"
                                       name="city"
                                       id="city"
                                       class="form-control"
                                       value="{{ $address->city ?? '' }}">

                                <p class="text-danger"></p>
                            </div>

                            <!-- STATE -->

                            <div class="mb-3">
                                <label>State</label>

                                <input type="text"
                                       name="state"
                                       id="state"
                                       class="form-control"
                                       value="{{ $address->state ?? '' }}">

                                <p class="text-danger"></p>
                            </div>

                            <!-- POSTAL CODE -->

                            <div class="mb-3">
                                <label>Postal Code</label>

                                <input type="text"
                                       name="postal_code"
                                       id="postal_code"
                                       class="form-control"
                                       value="{{ $address->postal_code ?? '' }}">

                                <p class="text-danger"></p>
                            </div>

                            <!-- FULL ADDRESS -->

                            <div class="mb-3">
                                <label>Full Address</label>

                                <textarea
                                    name="full_address"
                                    id="full_address"
                                    class="form-control"
                                    rows="4">{{ $address->full_address ?? '' }}</textarea>

                                <p class="text-danger"></p>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-between p-4">

                            <!-- SAVE / UPDATE -->

                            <button type="submit"
                                    name="action"
                                    value="save"
                                    class="btn btn-success">

                                {{ isset($address) ? 'Update Address' : 'Save Address' }}

                            </button>

                            <!-- NEXT -->

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

$("#addressForm").submit(function(e){

    e.preventDefault();

    let action = $(document.activeElement).val();

    $(".form-control").removeClass('is-invalid');
    $(".text-danger").html('');

    $.ajax({

        url: "{{ route('account.saveAddress') }}",

        type: "POST",

        data: $(this).serialize(),

        dataType: "json",

        success: function(response){

            if(response.status === true){

                if(action === 'next'){

                    window.location.href =
                    "{{ route('education') }}";

                }else{

                    alert('Address saved successfully!');
                }

            }else{

                $.each(response.errors,function(key,value){

                    $("#" + key)
                        .addClass("is-invalid");

                    $("#" + key)
                        .siblings(".text-danger")
                        .html(value[0]);

                });

            }

        },

        error:function(){

            alert("Something went wrong");

        }

    });

});

</script>

@endsection