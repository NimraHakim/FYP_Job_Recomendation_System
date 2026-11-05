@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow border-0">

                    <div class="card-header bg-success text-white">

                        <h3 class="mb-0">Applicant Selection</h3>

                    </div>

                    <div class="card-body text-center">

                        <i class="fa fa-user-check fa-5x text-success mb-4"></i>

                        <h2>Selected Applicant</h2>

                        <p class="mt-3">
                            Click the button below to confirm applicant selection.
                        </p>

                        <button class="btn btn-success btn-lg mt-3"
                                onclick="selectApplicant()">
                            Confirm Selection
                        </button>

                        <br><br>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            Back
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection


@section('customJs')

<script>

function selectApplicant(){

    if(confirm("Are you sure you want to select this applicant?")){

        alert("Applicant Selected Successfully!");
        window.location.href = "{{ url()->previous() }}";
    }

}

</script>

@endsection