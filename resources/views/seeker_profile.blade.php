@extends('front.layouts.app')

@section('main')

<style>
    .profile-menu a{
        text-decoration: none;
        color: #333;
        display: block;
        padding: 10px 15px;
        border-radius: 8px;
        transition: all .3s ease;
        font-weight: 500;
    }

    
    .profile-menu a:hover{
    background: #A8DB87;
    color: #fff !important;
}

.profile-menu a.active{
    background: #A8DB87;
    color: #fff !important;
}

    .profile-menu .logout:hover{
        background: #dc3545;
        color: #fff !important;
    }
</style>

<section class="section-5 bg-light py-5">

    <div class="container">

        <div class="row">

            <!-- LEFT SIDEBAR -->

            <div class="col-lg-3">

                <div class="card border-0 shadow mb-4 p-3 text-center">

                    <h5 class="mt-3 mb-0">
                        {{ Auth::user()->name }}
                    </h5>

              <p class="text-muted mb-2">
    <i class="fa fa-map-marker-alt text-danger"></i>
    {{ optional(Auth::user()->address)->city ?? 'City Not Added' }}
</p>

                </div>

                <div class="card border-0 shadow">

                    <ul class="list-group list-group-flush profile-menu">

                        <li class="list-group-item">
                            <a href="{{ route('personal_details') }}"
                               class="{{ request()->routeIs('personal_details') ? 'active' : '' }}">
                                Personal Details
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('adress') }}"
                               class="{{ request()->routeIs('adress') ? 'active' : '' }}">
                                Address
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('education') }}"
                               class="{{ request()->routeIs('education') ? 'active' : '' }}">
                                Education
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('skills') }}"
                               class="{{ request()->routeIs('skills') ? 'active' : '' }}">
                                Skills
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('experience') }}"
                               class="{{ request()->routeIs('experience') ? 'active' : '' }}">
                                Experience
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('languages') }}"
                               class="{{ request()->routeIs('languages') ? 'active' : '' }}">
                                Languages
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('account.logout') }}"
                               class="text-danger logout">
                                Logout
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

            <!-- RIGHT CONTENT -->

            <div class="col-lg-9">

                <div class="card border-0 shadow">

                    <div class="card-body text-center p-5">

                        <h2 class="mb-4">
                            Welcome Job Seeker
                        </h2>

                        <p class="mb-4">
                            Complete your profile to get AI-based job recommendations.
                        </p>

                        @if(
                            !$hasProfile ||
                            !$hasEducation ||
                            !$hasSkills ||
                            !$hasExperience ||
                            !$hasLanguages
                        )

                            <a href="{{ route('personal_details') }}"
                               class="btn btn-primary btn-lg">
                                Create Profile
                            </a>

                        @else

                            <a href="{{ route('ai.recommendations') }}"
                               class="btn btn-primary btn-lg">
                                Recommended Jobs
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection