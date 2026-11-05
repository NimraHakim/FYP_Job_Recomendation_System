@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-2">
<div class="container py-5">

<div class="row">

<div class="col-lg-3">
    @include('front.account.sidebar')
</div>

<div class="col-lg-9">

<div class="card shadow">

<div class="card-header bg-success text-white">
    <h3>Selected Candidates</h3>
</div>

<div class="card-body">

@forelse($jobs as $job)

    @if($job->applications->count())

        <h4 class="mt-4 mb-3">
            Job Title: <strong>{{ $job->title }}</strong>
        </h4>

        <table class="table table-bordered">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>

            <tbody>

            @foreach($job->applications as $application)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $application->user->name }}</td>

                    <td>{{ $application->user->email }}</td>

                    <td>{{ optional($application->user->personalDetail)->phone ?? '-' }}</td>

                </tr>

            @endforeach

            </tbody>

        </table>

    @endif

@empty

<div class="alert alert-warning">
    No Selected Candidates Found.
</div>

@endforelse

</div>

</div>

</div>

</div>

</div>
</section>

@endsection