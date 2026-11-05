@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light py-5">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="fw-bold">
                Profile Review
            </h2>

            <button onclick="window.print()" class="btn btn-dark">
                Print Profile
            </button>

        </div>

        <!-- PERSONAL INFO -->

        <div class="card shadow border-0 mb-4">

            <div class="card-body">

                <h4 class="mb-3 text-primary">
                    Personal Information
                </h4>

                <div class="row">

                    <div class="col-md-6">

                        <p>
                            <strong>Name:</strong>
                            {{ $personal->name ?? 'N/A' }}
                        </p>

                        <p>
                            <strong>Father Name:</strong>
                            {{ $personal->fname ?? 'N/A' }}
                        </p>

                        <p>
                            <strong>CNIC:</strong>
                            {{ $personal->cnic ?? 'N/A' }}
                        </p>

                    </div>

                    <div class="col-md-6">

                        <p>
                            <strong>Phone:</strong>
                            {{ $personal->phone ?? 'N/A' }}
                        </p>

                        <p>
                            <strong>Landline:</strong>
                            {{ $personal->landline ?? 'N/A' }}
                        </p>

                        <p>
                            <strong>Email:</strong>
                            {{ $personal->gmail ?? 'N/A' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- EDUCATION -->

        <div class="card shadow border-0 mb-4">

            <div class="card-body">

                <h4 class="mb-3 text-primary">
                    Education
                </h4>

                @forelse($educations as $education)

                    <div class="border rounded p-3 mb-3">

                        <div class="row">

                            <div class="col-md-6">

                                <p>
                                    <strong>Degree Level:</strong>
                                    {{ $education->degree_level }}
                                </p>

                                <p>
                                    <strong>School:</strong>
                                    {{ $education->school }}
                                </p>

                                <p>
                                    <strong>Board:</strong>
                                    {{ $education->board }}
                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>
                                    <strong>Total Marks:</strong>
                                    {{ $education->total_marks }}
                                </p>

                                <p>
                                    <strong>Obtained Marks:</strong>
                                    {{ $education->obtained_marks }}
                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <p>No education added.</p>

                @endforelse

            </div>

        </div>

        <!-- SKILLS -->

        <div class="card shadow border-0 mb-4">

            <div class="card-body">

                <h4 class="mb-3 text-primary">
                    Skills
                </h4>

                @forelse($skills as $skill)

                    <div class="border rounded p-3 mb-3">

                        <p>
                            <strong>Skill:</strong>
                            {{ $skill->name }}
                        </p>

                        <p>
                            <strong>Level:</strong>
                            {{ $skill->level }}
                        </p>

                    </div>

                @empty

                    <p>No skills added.</p>

                @endforelse

            </div>

        </div>

        <!-- EXPERIENCE -->

        <div class="card shadow border-0 mb-4">

            <div class="card-body">

                <h4 class="mb-3 text-primary">
                    Experience
                </h4>

                @forelse($experiences as $experience)

                    <div class="border rounded p-3 mb-3">

                        <p>
                            <strong>Field:</strong>
                            {{ $experience->field_name }}
                        </p>

                        <p>
                            <strong>Company:</strong>
                            {{ $experience->company_name }}
                        </p>

                        <p>
                            <strong>Years:</strong>
                            {{ $experience->years }}
                        </p>

                        <p>
                            <strong>Description:</strong>
                            {{ $experience->description }}
                        </p>

                    </div>

                @empty

                    <p>No experience added.</p>

                @endforelse

            </div>

        </div>

        <!-- LANGUAGES -->

        <div class="card shadow border-0 mb-4">

            <div class="card-body">

                <h4 class="mb-3 text-primary">
                    Languages
                </h4>

                @forelse($languages as $language)

                    <div class="border rounded p-3 mb-3">

                        <p>
                            <strong>Language:</strong>
                            {{ $language->name }}
                        </p>

                        <p>
                            <strong>Level:</strong>
                            {{ $language->level }}
                        </p>

                    </div>

                @empty

                    <p>No languages added.</p>

                @endforelse

            </div>

        </div>

    </div>

</section>

@endsection