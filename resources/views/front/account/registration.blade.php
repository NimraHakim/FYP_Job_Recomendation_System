@extends('front.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow p-5">
                    <h1 class="h3 mb-3">Register</h1>

                    <form id="registrationForm">
                        @csrf

                        <div class="mb-3">
                            <label>Name*</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label>Email*</label>
                            <input type="email" name="email" id="email" class="form-control">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label>Password*</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password*</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"  class="form-control">
                            <p></p>
                        </div>
                       

                         <div class="mb-3">
                                 <label>User Role*</label>
                           <select name="user_role" id="user_role" class="form-control">
                            <option value="">-- Select Role --</option>
                            <option value="job_seeker">Job Seeker</option>
                            <option value="job_provider">Job Provider</option>
                          </select>
                          <p></p>
                    </div>


                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <div class="mt-3 text-center">
                        Already have an account? <a href="{{ route('account.login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
$('#registrationForm').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        url: "{{ route('account.processregistration') }}",
        type: "POST",
        data: $(this).serializeArray(),
        dataType: "json",
        success: function(response){
            if(response.status === false){
                // Show validation errors
                $('#name').toggleClass('is-invalid', response.errors.name)
                    .siblings('p').html(response.errors.name ?? '');
                $('#email').toggleClass('is-invalid', response.errors.email)
                    .siblings('p').html(response.errors.email ?? '');
                $('#password').toggleClass('is-invalid', response.errors.password)
                    .siblings('p').html(response.errors.password ?? '');
                $('#password_confirmation').toggleClass('is-invalid', response.errors.password)
                    .siblings('p').html(response.errors.password ?? '');
            } else {
                alert('Registered successfully');
                window.location.href = "{{ route('account.login') }}";
            }
        },
        error: function(xhr){
            console.log(xhr.responseText); // debug server error
            alert('Server error! Check console.');
        }
    });
});
</script> --}}
<script>
$('#registrationForm').on('submit', function(e){
    e.preventDefault();

    // reset errors (IMPORTANT)
    $('.form-control').removeClass('is-invalid');
    $('p').html('');

    $.ajax({
        url: "{{ route('account.processregistration') }}",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function(response){

            if(response.status === false){

                if(response.errors.name){
                    $('#name').addClass('is-invalid')
                        .siblings('p').html(response.errors.name[0]);
                }

                if(response.errors.email){
                    $('#email').addClass('is-invalid')
                        .siblings('p').html(response.errors.email[0]);
                }

                if(response.errors.password){
                    $('#password').addClass('is-invalid')
                        .siblings('p').html(response.errors.password[0]);
                    $('#password_confirmation').addClass('is-invalid');
                }
                if(response.errors.user_role){
    $('#user_role').addClass('is-invalid')
        .siblings('p').html(response.errors.user_role[0]);
}

            } else {
                alert('Registered successfully');
                window.location.href = "{{ route('account.login') }}";
            }
        },
        error: function(xhr){
            console.log(xhr.responseText);
            alert('Server error');
        }
    });
});
</script>

@endsection
