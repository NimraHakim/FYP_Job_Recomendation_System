@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light py-5">

<div class="container">

    <div class="row">

        <div class="col-lg-12">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h3>Applicant Profile</h3>

                </div>

                <div class="card-body">

                    {{-- PERSONAL DETAILS --}}

                    <h4 class="mb-3">Personal Details</h4>

                    <table class="table table-bordered">

                        <tr>
                            <th width="30%">Name</th>
                            <td>{{ $personal->name ?? $user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>Father Name</th>
                            <td>{{ $personal->fname ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>CNIC</th>
                            <td>{{ $personal->cnic ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>{{ $personal->phone ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Landline</th>
                            <td>{{ $personal->landline ?? '-' }}</td>
                        </tr>

                    </table>


                    {{-- ADDRESS --}}

                    <h4 class="mt-5 mb-3">Address</h4>

                    <table class="table table-bordered">

                        <tr>

                            <th width="30%">Country</th>

                            <td>{{ $address->country ?? '-' }}</td>

                        </tr>

                        <tr>

                            <th>State</th>

                            <td>{{ $address->state ?? '-' }}</td>

                        </tr>

                        <tr>

                            <th>City</th>

                            <td>{{ $address->city ?? '-' }}</td>

                        </tr>

                        <tr>

                            <th>Postal Code</th>

                            <td>{{ $address->postal_code ?? '-' }}</td>

                        </tr>

                        <tr>

                            <th>Full Address</th>

                            <td>{{ $address->full_address ?? '-' }}</td>

                        </tr>

                    </table>



                    {{-- EDUCATION --}}

                    <h4 class="mt-5 mb-3">Education</h4>

                    <table class="table table-bordered">

                        <thead>

                        <tr>

                            <th>Degree</th>

                            <th>School</th>

                            <th>Board</th>

                            <th>Total Marks</th>

                            <th>Obtained Marks</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($educations as $education)

                            <tr>

                                <td>{{ $education->degree_level }}</td>

                                <td>{{ $education->school }}</td>

                                <td>{{ $education->board }}</td>

                                <td>{{ $education->total_marks }}</td>

                                <td>{{ $education->obtained_marks }}</td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    No Education Added

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>



                    {{-- EXPERIENCE --}}

                    <h4 class="mt-5 mb-3">Experience</h4>

                    <table class="table table-bordered">

                        <thead>

                        <tr>

                            <th>Field</th>

                            <th>Company</th>

                            <th>Years</th>

                            <th>Certificate</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($experiences as $experience)

                            <tr>

                                <td>{{ $experience->field_name }}</td>

                                <td>{{ $experience->company_name }}</td>

                                <td>{{ $experience->years }}</td>

                                <td>

                                    @if($experience->certificate)

                                        <a href="{{ asset('storage/'.$experience->certificate) }}"
                                           target="_blank"
                                           class="btn btn-success btn-sm">

                                            View Certificate

                                        </a>

                                    @else

                                        -

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center">

                                    No Experience Added

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>



                    {{-- SKILLS --}}

                    <h4 class="mt-5 mb-3">Skills</h4>

                    <table class="table table-bordered">

                        <thead>

                        <tr>

                            <th>Skill</th>

                            <th>Level</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($skills as $skill)

                            <tr>

                                <td>{{ $skill->name }}</td>

                                <td>{{ $skill->level }}</td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="2" class="text-center">

                                    No Skills Added

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>



                    {{-- LANGUAGES --}}

                    <h4 class="mt-5 mb-3">Languages</h4>

                    <table class="table table-bordered">

                        <thead>

                        <tr>

                            <th>Language</th>

                            <th>Level</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($languages as $language)

                            <tr>

                                <td>{{ $language->name }}</td>

                                <td>{{ $language->level }}</td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="2" class="text-center">

                                    No Languages Added

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                    <div class="mt-4">

                        <a href="{{ route('account.jobApplicants', $jobId) }}" class="btn btn-secondary">
    ← Back
</a>
                <a href="{{ route('account.selectedApplicant', [
    'application' => $application->id,
    'job' => $jobId
]) }}"
class="btn btn-success me-2">
    <i class="fa fa-check"></i> Selected
</a>

<a href="{{ route('account.rejectedApplicant', [
    'application' => $application->id,
    'job' => $jobId
]) }}"
class="btn btn-danger">
    <i class="fa fa-times"></i> Rejected
</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</section>

@endsection