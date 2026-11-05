@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">

        <div class="row">

            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>

            <div class="col-lg-9">

                @include('front.message')

                <div class="card border-0 shadow">

                    <div class="card-header bg-white">
                        <h4 class="mb-0">
                            Applicants For:
                            <strong>{{ $job->title }}</strong>
                        </h4>
                    </div>

                    <div class="card-body">

                        @if($job->applications->count())

                        <table class="table table-bordered table-hover">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Applied Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($job->applications as $application)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $application->user->name }}</td>

                                    <td>{{ $application->user->email }}</td>

                                    <td>{{ $application->created_at->format('d M Y') }}</td>

                                    <td>

                                        @if($application->status == 'selected')

                                            <span class="badge bg-success">
                                                <i class="fa fa-check"></i>
                                                Selected
                                            </span>

                                        @elseif($application->status == 'rejected')

                                            <span class="badge bg-danger">
                                                <i class="fa fa-times"></i>
                                                Rejected
                                            </span>

                                        @else

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('applicant.profile',[
                                                'id'=>$application->user->id,
                                                'job'=>$job->id
                                            ]) }}"
                                           class="btn btn-primary btn-sm">

                                            <i class="fa fa-user"></i>
                                            View Profile

                                        </a>

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                        @else

                            <div class="alert alert-warning text-center">
                                No Applicants Found.
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection