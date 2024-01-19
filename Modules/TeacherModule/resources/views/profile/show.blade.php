@extends('teachermodule::layouts.master')

@section('page_title', 'Teacher profile')

@push('page_css')
@endpush

@section('main_content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile edit form</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.profile.update') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <center>
                                    <img id="profile_image"
                                        @if (!empty($user['profile_image'])) src="{{ asset('storage/users/profile_images') }}/{{ $user['profile_image'] }}"
                                        @else
                                        src="{{ asset('assets/placeholder-image.png') }}" @endif
                                        class="img-responsive br-5" width="300">
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="form-group">
                                    <label for="profile_image" class="form-label">Profile image</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image"
                                        onchange="read_image(this, 'profile_image')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">First name<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required
                                        placeholder="Enter first name" value="{{ $user['first_name'] }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">Last name<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required
                                        placeholder="Enter last name" value="{{ $user['last_name'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email<span class="text-red"> *</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        placeholder="Enter email" value="{{ $user['email'] }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone number<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" required
                                        placeholder="Enter phone number" value="{{ $user['phone'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="department" class="form-label">Department<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="department" name="department" required
                                        placeholder="Enter department" value="{{ $user->teacher['department'] }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="teacher_id" class="form-label">Teacher id<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="teacher_id" name="teacher_id" required
                                        placeholder="Enter teacher id" value="{{ $user->teacher['teacher_id'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xl-12 mt-3">
                                <button type="submit" class="btn btn-primary float-end mb-0">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.profile.update-password') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="old_pass" class="form-label">Old password<span class="text-red">
                                            *</span></label>
                                    <input type="password" class="form-control" id="old_pass" name="old_pass" required
                                        placeholder="Enter old password">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="new_pass" class="form-label">New password<span class="text-red">
                                            *</span></label>
                                    <input type="password" class="form-control" id="new_pass" name="new_pass" required
                                        placeholder="Enter new password">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="confirm_pass" class="form-label">Confirm new password<span
                                            class="text-red"> *</span></label>
                                    <input type="password" class="form-control" id="confirm_pass"
                                        name="confirm_pass" required placeholder="Enter password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xl-12 mt-3">
                                <button type="submit" class="btn btn-primary float-end mb-0">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('page_js')
@endpush
