@extends('frontendmodule::layouts.master')

@section('title', 'Student login')

@push('css')
    <style>
        form .error {
            color: #ff0000;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="h1 text-center mb-5">Student Login</h1>
            <form method="POST" action="{{ route('student.auth.login-submit') }}" name="login-form">
                @csrf
                <div class="row justify-content-center" style="padding: 0 30%;">
                    <div class="col-12 mb-4">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                            required>
                    </div>
                    <div class="col-12 mb-2">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password" required>
                    </div>
                    <div class="col-12 mb-3">

                            <a href="{{ route('student.auth.forgot-password-email') }}" class="text-blue font-weight-bold">forgot password?</a>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-lg btn-outline-primary" type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(function() {
                $("form[name='login-form']").validate({
                    rules: {
                        first_name: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 8
                        }
                    },
                    messages: {
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 8 characters long"
                        },
                        email: "Please enter a valid email address"
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
        })
    </script>
@endpush
