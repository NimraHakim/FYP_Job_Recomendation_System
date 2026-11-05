@extends('front.layouts.app')

@section('main')

<div class="container py-5">

    <div class="card shadow border-0">

        <div class="card-header">
            <h4>Applicants List</h4>
        </div>

        <div class="card-body">

            @if($job->applications->count() > 0)

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Applicant Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($job->applications as $application)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $application->user->name }}</td>

                        <td>{{ $application->user->email }}</td>

                        <td>
                            <a href="{{ route('applicant.profile',$application->user->id) }}"
                               class="btn btn-sm btn-primary">
                                View Complete Profile
                            </a>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            @else

                <div class="alert alert-info">
                    No Applicants Found
                </div>

            @endif

        </div>

    </div>

</div>

@endsection