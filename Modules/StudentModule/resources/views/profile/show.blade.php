@extends('frontendmodule::layouts.master')

@section('title', 'Student profile')

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
            <h1 class="h1 text-center mb-5">Student profile</h1>
            <form method="POST" action="{{ route('student.profile.update') }}" name="registration-form"
                enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 mb-4">
                        <center>
                            <img 
                                @if (!empty($user['profile_image'])) 
                                    src="{{ asset('storage/users/profile_images') }}/{{ $user['profile_image'] }}"
                                @else
                                    src="{{ asset('assets/placeholder-image.png') }}" 
                                @endif
                                alt="student image">
                        </center>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="First name" name="first_name"
                            id="first_name" required value="{{ $user['first_name'] }}">
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Last name" name="last_name" id="last_name"
                            required value="{{ $user['last_name'] }}">
                    </div>
                    <div class="col-6 mb-4">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                            required value="{{ $user['email'] }}">
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone"
                            required value="{{ $user['phone'] }}">
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Student id" name="student_id"
                            id="student_id" required value="{{ $user->student['student_id'] }}">
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Department" name="department"
                            id="department" required value="{{ $user->student['department'] }}">
                    </div>
                    <div class="col-6 mb-4">
                        <input type="text" class="form-control" placeholder="Subject" name="subject" id="subject"
                            required value="{{ $user->student['subject'] }}">
                    </div>
                    <div class="col-6 mb-4">
                        <input type="file" class="form-control" name="profile_image" id="profile_image">
                        <label for="profile_image">Profile image</label>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-lg btn-outline-primary float-right" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container mt-5">
            <h1 class="h1 text-center mb-5">Update password</h1>
            <form method="POST" action="{{ route('student.profile.update-password') }}" name="update-password-form"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 mb-4">
                        <input type="password" class="form-control" placeholder="Old password" name="old_pass"
                            id="old_pass" required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="password" class="form-control" placeholder="New password" name="new_pass" id="new_pass"
                            required>
                    </div>
                    <div class="col-6 mb-4">
                        <input type="password" class="form-control" placeholder="Confirm new password" name="confirm_pass" id="confirm_pass"
                            required>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-lg btn-outline-primary float-right" type="submit">Update</button>
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
                        }
                    },
                    messages: {
                        first_name: "Please enter your first name",
                        last_name: "Please enter your last name",
                        student_id: "Please enter your student id",
                        department: "Please enter your department",
                        subject: "Please enter your subject",
                        email: "Please enter a valid email address",
                        phone: {
                            required: "Please enter your phone number",
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });

                $("form[name='update-password-form']").validate({
                    rules: {
                        old_pass: {
                            required: true,
                            minlength: 8
                        },
                        new_pass: {
                            required: true,
                            minlength: 8
                        },
                        confirm_pass: {
                            required: true,
                            equalTo: "#new_pass"
                        }
                    },
                    messages: {
                        old_pass: {
                            required: "Please provide your old password",
                            minlength: "Your password must be at least 8 characters long"
                        },
                        new_pass: {
                            required: "Please provide your new password",
                            minlength: "Your password must be at least 8 characters long"
                        },
                        confirm_pass: {
                            required: "Please confirm your new password",
                            equalTo: "Passwords do not match"
                        },
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
