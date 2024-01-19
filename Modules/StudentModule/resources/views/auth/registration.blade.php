@extends('frontendmodule::layouts.master')

@section('title', 'Student registration')

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
            <h1 class="h1 text-center mb-5">Student registration</h1>
            <form method="POST" action="{{ route('student.auth.registration') }}" name="registration-form"
                enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="First name" name="first_name" id="first_name"
                            required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Last name" name="last_name" id="last_name"
                            required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                            required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone"
                            required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password"
                            required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="password" class="form-control" placeholder="Confirm password" name="confirm_password"
                            id="confirm_password" required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Student id" name="student_id"
                            id="student_id" required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Department" name="department"
                            id="department" required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Subject" name="subject" id="subject"
                            required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="file" class="form-control" name="profile_image" id="profile_image">
                        <label for="profile_image">Profile image</label>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-lg btn-outline-primary" type="submit">Submit</button>
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
                $("form[name='registration-form']").validate({
                    rules: {
                        first_name: "required",
                        last_name: "required",
                        student_id: "required",
                        department: "required",
                        subject: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        phone: {
                            required: true,
                            phoneBD: true,
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        confirm_password: {
                            required: true,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        first_name: "Please enter your first name",
                        last_name: "Please enter your last name",
                        student_id: "Please enter your student id",
                        department: "Please enter your department",
                        subject: "Please enter your subject",
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 8 characters long"
                        },
                        confirm_password: {
                            required: "Please confirm your password",
                            equalTo: "Passwords do not match"
                        },
                        email: "Please enter a valid email address",
                        phone: {
                            required: "Please enter your phone number",
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
            $.validator.addMethod("phoneBD", function(phoneNumber, element) {
                phoneNumber = phoneNumber.replace(/\s+/g, "");
                return this.optional(element) || phoneNumber.match(/^(?:\+8801\d{9}|\d{11})$/);
            }, "Please enter a valid Bangladeshi phone number");
        })
    </script>
@endpush
