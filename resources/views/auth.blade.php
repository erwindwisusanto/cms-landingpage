<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login CMS</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h4>Login CMS</h4>
                            <form class="pt-3" id="loginForm" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="username"
                                        id="username" placeholder="username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" id="password"
                                        placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                    id="signinBtn">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>

    <script>
        "use strict";
        $(document).ready(function() {
            $('#signinBtn').on('click', function() {
                var $btn = $(this);
                var $spinner = $('#spinner');

                $btn.prop('disabled', true);
                $spinner.removeClass('d-none');

                $.ajax({
                    type: "POST",
                    url: "{{ route('signin') }}",
                    data: $('#loginForm').serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.status === true) {
                            Swal.fire({
                                title: "Success",
                                text: "Logged in successfully",
                                icon: "success",
                                timer: 800,
                                showConfirmButton: false
                            }).then(() => {
                                setTimeout(() => {
                                    window.location.href = "{{ route('index') }}";
                                }, 850);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Failed',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        $('.invalid-feedback').text('').hide();
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $("#" + key + "Error").text(value[0]).show();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'An error occurred',
                                text: 'Please try again.',
                            });
                        }
                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $spinner.addClass('d-none');
                    }
                });
            });
        });
    </script>
</body>

</html>
