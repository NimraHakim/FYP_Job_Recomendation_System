@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow border-0">

                    <div class="card-header bg-danger text-white">

                        <h3 class="mb-0">Reject Applicant</h3>

                    </div>

                    <div class="card-body text-center">

                        <i class="fa fa-user-times fa-5x text-danger mb-4"></i>

                        <h2>Reject Applicant</h2>

                        <p class="mt-3">
                            Click the button below to reject this applicant.
                        </p>

                        <button class="btn btn-danger btn-lg mt-3"
                                onclick="rejectApplicant()">
                            Confirm Rejection
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

function rejectApplicant(){

    if(confirm("Are you sure you want to reject this applicant?")){

        alert("Applicant Rejected Successfully!");
        window.location.href = "{{ url()->previous() }}";
    }

}

</script>

@endsection