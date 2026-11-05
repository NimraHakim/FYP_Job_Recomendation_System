<!DOCTYPE html>
<html class="no-js" lang="en_AU">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Jobs For Everyone | Find Best Jobs</title>

    <meta name="description" content="" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <!-- Main CSS -->
    <link rel="stylesheet"
          type="text/css"
          href="{{ asset('assets/css/style.css') }}" />

    <!-- AOS Animation -->
    <link rel="stylesheet"
          href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>

<body data-instant-intensity="mousedown">

<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3"
         data-aos="fade-down"
         data-aos-duration="900">

        <div class="container">

            <a class="navbar-brand"
               href="{{ route('home') }}">
                Make Your Future Secure
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse"
                 id="navbarSupportedContent">

                <ul class="navbar-nav ms-0 me-auto mb-2 mb-lg-0 ms-lg-4">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('jobs') }}">
                            Find Jobs
                        </a>
                    </li>

                </ul>

                @if(!Auth::check())

                    <a class="btn btn-outline-primary me-2"
                       href="{{ route('account.login') }}">
                        Login
                    </a>

                @else

                    @if(Auth::user()->user_role == 'job_provider')

                        <a class="btn btn-outline-primary me-2"
                           href="{{ route('account.profile') }}">
                            Account
                        </a>

                    @else

                        <a class="btn btn-outline-primary me-2"
                           href="{{ route('seeker_profile') }}">
                            Account
                        </a>

                    @endif

                @endif


                @if(Auth::check() && Auth::user()->user_role == 'job_provider')

                    <a class="btn btn-primary"
                       href="{{ route('account.createJob') }}">
                        Post a Job
                    </a>

                @else

                    <a class="btn btn-secondary"
                       href="{{ route('home') }}">
                        Home
                    </a>

                @endif

            </div>

        </div>

    </nav>

</header>


{{-- Main Page --}}
<main data-aos="fade-up" data-aos-duration="800">

    @yield('main')

</main>



<!-- Profile Picture Modal -->

<div class="modal fade"
     id="exampleModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Change Profile Picture
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <form id="profilePicForm"
                      name="profilePicForm"
                      action="{{ route('account.updateProfilepic') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Profile Image
                        </label>

                        <input type="file"
                               class="form-control"
                               name="image"
                               id="image">

                    </div>

                    <div class="d-flex justify-content-end">

                        <button class="btn btn-primary me-2"
                                type="submit">

                            Update

                        </button>

                        <button class="btn btn-secondary"
                                type="button"
                                data-bs-dismiss="modal">

                            Close

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



<footer class="bg-dark py-3 bg-2"
        data-aos="fade-up"
        data-aos-duration="900">

    <div class="container">

        <p class="text-center text-white pt-3 fw-bold fs-6">

            © 2023 XYZ Company. All Rights Reserved.

        </p>

    </div>

</footer>



<!-- Scripts -->

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>

<script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>

<script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>


<!-- AOS -->

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>

AOS.init({

    duration:1000,

    easing:'ease-in-out',

    once:false,

    mirror:true,

    offset:80

});

</script>



<script>

$.ajaxSetup({

    headers:{

        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')

    }

});

</script>


@yield('customJs')


<!-- ElevenLabs AI Chatbot -->
<elevenlabs-convai agent-id="agent_3801kxb0y8e3er3vf8q4z81dt2sr"></elevenlabs-convai><script src="https://unpkg.com/@elevenlabs/convai-widget-embed" async type="text/javascript"></script>

</html>