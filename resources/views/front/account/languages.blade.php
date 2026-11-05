{{-- =====================================
6) BLADE FILE
resources/views/front/account/languages.blade.php
===================================== --}}

@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-light">

    <div class="container py-5">

       <div class="row">

            <!-- LEFT SIDEBAR -->
            <div class="col-lg-3">

                <!-- Profile Card -->
              @include('front.account.sidebar2')

            </div>         

       

            <!-- RIGHT SIDE -->
            <div class="col-lg-9">
         

                <form id="createLanguageForm">

                    @csrf

                    <input type="hidden" id="language_id">

                    <div class="card border-0 shadow mb-4">

                        <div class="card-body p-4">

                            <h3 class="fs-4 mb-4">
                                Languages
                            </h3>

                            <div class="mb-4">

                                <label class="mb-2">
                                    Language
                                </label>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control">

                                <p class="text-danger"></p>

                            </div>

                            <div class="mb-4">

                                <label class="mb-2">
                                    Language Expert Level
                                </label>

                                <select name="level"
                                        id="level"
                                        class="form-control">

                                    <option value="">
                                        Select Language Level
                                    </option>

                                    <option value="Expert">
                                        Expert
                                    </option>

                                    <option value="Intermediate">
                                        Intermediate
                                    </option>

                                    <option value="Beginner">
                                        Beginner
                                    </option>

                                </select>

                                <p class="text-danger"></p>

                            </div>

                        </div>

                        <div class="card-footer p-4 d-flex justify-content-between">

                            <button type="submit"
                                    class="btn btn-success"
                                    id="saveBtn">

                                Save Data

                            </button>

                            <a href="{{ route('jobs') }}"
                               class="btn btn-danger">

                                Complete

                            </a>

                            <a href="{{ route('profile.review') }}" class="btn btn-warning">
    Review Profile
</a>

                        </div>

                    </div>

                </form>

                <!-- SHOW LANGUAGES -->

                <div class="card border-0 shadow">

                    <div class="card-body">

                        <h3 class="fs-4 mb-4">
                            My Languages
                        </h3>

                        @if($languages->count() > 0)

                            @foreach($languages as $language)

                                <div class="border rounded p-3 mb-3">

                                    <div class="d-flex justify-content-between">

                                        <div>

                                            <h5>
                                                {{ $language->name }}
                                            </h5>

                                            <p>
                                                <strong>Level:</strong>
                                                {{ $language->level }}
                                            </p>

                                        </div>

                                        <div class="d-flex gap-2">

                                            <button
                                                class="btn btn-primary btn-sm editLanguage"
                                                data-id="{{ $language->id }}"
                                                data-name="{{ $language->name }}"
                                                data-level="{{ $language->level }}"
                                            >
                                                Edit
                                            </button>

                                            <button
                                                class="btn btn-danger btn-sm deleteLanguage"
                                                data-id="{{ $language->id }}"
                                            >
                                                Delete
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        @else

                            <p>No languages added yet.</p>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection

@section('customJs')

<script>

// STORE + UPDATE

$("#createLanguageForm").submit(function(e){

    e.preventDefault();

    let languageId = $('#language_id').val();

    let url = '';

    if(languageId == ''){

        url = '{{ route("languages.store") }}';

    } else {

        url = '/languages/update/' + languageId;
    }

    $("button[type='submit']").prop('disabled', true);

    $.ajax({

        url: url,

        type: 'POST',

        data: $(this).serialize(),

        success: function(response){

            $("button[type='submit']").prop('disabled', false);

            if(response.status == true){

                alert(response.message);

                window.location.reload();

            } else {

                var errors = response.errors;

                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                $.each(errors, function(key, value){

                    $('#' + key)
                        .addClass('is-invalid')
                        .after('<p class="invalid-feedback text-danger">'+value[0]+'</p>');
                });
            }
        }
    });
});

// EDIT

$(document).on('click', '.editLanguage', function(){

    $('#language_id').val($(this).data('id'));

    $('#name').val($(this).data('name'));

    $('#level').val($(this).data('level'));

    $('#saveBtn').text('Update Language');

});

// DELETE

$(document).on('click', '.deleteLanguage', function(){

    if(confirm('Are you sure you want to delete this language?')){

        var languageId = $(this).data('id');

        $.ajax({

            url: '{{ route("languages.delete") }}',

            type: 'POST',

            data: {

                _token: '{{ csrf_token() }}',

                id: languageId

            },

            success: function(response){

                if(response.status == true){

                    window.location.reload();
                }
            }
        });
    }
});

</script>

@endsection