@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">

        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Account Settings
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>

            <div class="col-lg-9">

                @include('front.message')

                <div class="card border-0 shadow mb-4 p-3">

                    <div class="card-body card-form">

                        <div class="d-flex justify-content-between">

                            <div>
                                <h3 class="fs-4 mb-1">
                                    My Jobs
                                </h3>
                            </div>

                            <div style="margin-top:-10px;">
                                <a href="{{ route('account.createJob') }}"
                                   class="btn btn-primary">
                                    Post a Job
                                </a>
                            </div>

                        </div>

                        <div class="table-responsive mt-3">

                            <table class="table">

                                <thead class="bg-light">

                                    <tr>
                                        <th>Title</th>
                                        <th>Job Created</th>
                                        <th>Applicants</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>

                                <tbody>

                                @if($jobs->isNotEmpty())

                                    @foreach($jobs as $job)

                                    <tr>

                                        <td>
                                            <div class="job-name fw-500">
                                                {{ $job->title }}
                                            </div>

                                            <div class="info1">
                                                {{ $job->jobType->name }}
                                                |
                                                {{ $job->location }}
                                            </div>
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}
                                        </td>

                                        <td>

                                            <a href="{{ route('account.jobApplicants', $job->id) }}"
   class="btn btn-sm btn-outline-primary">
    {{ $job->applications->count() }} Applicants
</a>

                                        </td>

                                        <td>

                                            @if($job->status == 1)

                                                <span class="badge bg-success">
                                                    Active
                                                </span>

                                            @else

                                                <span class="badge bg-danger">
                                                    Blocked
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            <div class="action-dots float-end">

                                                <a href="#"
                                                   data-bs-toggle="dropdown">

                                                    <i class="fa fa-ellipsis-v"></i>

                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="{{ route('details',$job->id) }}">

                                                            <i class="fa fa-eye"></i>
                                                            View

                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="{{ route('account.editJob',$job->id) }}">

                                                            <i class="fa fa-edit"></i>
                                                            Edit

                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item"
   href="{{ route('account.jobApplicants', $job->id) }}">
    <i class="fa fa-users"></i>
    View Applicants
</a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="#"
                                                           onclick="deletejob({{ $job->id }})">

                                                            <i class="fa fa-trash"></i>
                                                            Delete

                                                        </a>
                                                    </li>

                                                </ul>

                                            </div>

                                        </td>

                                    </tr>

                                    @endforeach

                                @else

                                    <tr>
                                        <td colspan="5" class="text-center">
                                            No Jobs Found
                                        </td>
                                    </tr>

                                @endif

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection


@section('customJs')

<script>

function deletejob(jobid)
{
    if(confirm("Are you sure you want to delete this job?"))
    {
        $.ajax({

            url: '{{ route("account.deletejob") }}',

            type: 'POST',

            data: {
                jobid: jobid,
                _token: '{{ csrf_token() }}'
            },

            dataType: 'json',

            success: function(response)
            {
                window.location.href =
                "{{ route('account.myjobs') }}";
            }

        });
    }
}

</script>

@endsection