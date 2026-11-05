
<style>
.ai-bg{
    background-color: #F5FFF1;
}
</style>
@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="card border-0 shadow-lg rounded-4">

                    <!-- Header -->

                    <div class="card-header bg-success text-white py-4">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <div>

                                <h2 class="mb-1">
                                    🤖 AI Job Recommendations
                                </h2>

                                <small>
                                    Personalized jobs based on your profile skills
                                </small>

                            </div>

                            @if(!empty($jobs))

                                <span class="badge bg-light text-success fs-6 px-3 py-2">

                                    {{ count($jobs) }} Jobs Found

                                </span>

                            @endif

                        </div>

                    </div>

                    <div class="card-body p-4">

                        @if(isset($message))

                            <div class="alert alert-warning">

                                {{ $message }}

                            </div>

                        @endif


                        @if(!empty($jobs))

                            @foreach($jobs as $job)

                                @php

                                    $match = round($job['score'] * 100);

                                @endphp


                                <div class="card border-0 shadow-sm mb-4 rounded-4">

                                    <div class="card-body">

                                        <div class="d-flex justify-content-between align-items-start flex-wrap">

                                            <div>

                                                <h3 class="text-success fw-bold">

                                                    {{ $job['title'] }}

                                                </h3>

                                                <h6 class="text-secondary">

                                                    <i class="fa fa-building"></i>

                                                    {{ $job['company'] }}

                                                </h6>

                                            </div>


                                            <div>

                                                @if($match >= 80)

                                                    <span class="badge bg-success fs-6">

                                                        Excellent Match {{ $match }}%

                                                    </span>

                                                @elseif($match >= 60)

                                                    <span class="badge bg-primary fs-6">

                                                        Good Match {{ $match }}%

                                                    </span>

                                                @elseif($match >= 40)

                                                    <span class="badge bg-warning text-dark fs-6">

                                                        Average Match {{ $match }}%

                                                    </span>

                                                @else

                                                    <span class="badge bg-danger fs-6">

                                                        Low Match {{ $match }}%

                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                        <hr>

                                        <div class="row">

                                            <div class="col-md-4 mb-3">

                                                <strong>

                                                    <i class="fa fa-map-marker text-danger"></i>

                                                    Location

                                                </strong>

                                                <br>

                                                {{ $job['location'] }}

                                            </div>

                                            <div class="col-md-4 mb-3">

                                                <strong>

                                                    <i class="fa fa-money text-success"></i>

                                                    Salary

                                                </strong>

                                                <br>

                                                Rs. {{ number_format($job['salary']) }}

                                            </div>

                                            <div class="col-md-4 mb-3">

                                                <strong>

                                                    AI Match Score

                                                </strong>

                                                <div class="progress mt-2" style="height:22px;">

                                                    <div class="progress-bar bg-success"

                                                         style="width:{{ $match }}%">

                                                        {{ $match }}%

                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="mt-3">

                                            <h5>

                                                Job Description

                                            </h5>

                                            <p class="text-muted">

                                                {{ $job['description'] }}

                                            </p>

                                        </div>


                                        <div class="alert alert-success mt-3">

                                            <strong>

                                                🤖 Why AI Recommended This Job?

                                            </strong>

                                            <br><br>

                                            This recommendation is generated by comparing
                                            your profile skills with the job requirements
                                            using AI-based TF-IDF and Cosine Similarity.

                                        </div>


                                        <div class="d-flex justify-content-between align-items-center mt-4">

                                            <small class="text-muted">

                                                Recommendation generated using Artificial Intelligence

                                            </small>

                                            <a href="{{ route('details',$job['id']) }}"

                                               class="btn btn-success px-4">

                                                <i class="fa fa-eye"></i>

                                                View Details

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        @else

                            <div class="text-center py-5">

                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                     width="120"
                                     class="mb-3">

                                <h3>

                                    No Matching Jobs Found

                                </h3>

                                <p class="text-muted">

                                    Complete your profile and add more skills to receive
                                    personalized AI recommendations.

                                </p>

                                <a href="{{ route('account.profile') }}"
                                   class="btn btn-success">

                                    Update Profile

                                </a>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection