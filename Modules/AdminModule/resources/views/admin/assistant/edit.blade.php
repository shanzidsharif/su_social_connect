@extends('adminmodule::layouts.master')

@section('page_title', 'Admin assistant edit')

@push('page_css')
@endpush

@section('main_content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit form</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.assistants.update', [$assistant['id']]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <center>
                                    <img id="profile_image"
                                        @if (!empty($assistant['profile_image'])) src="{{ asset('storage/users/profile_images') }}/{{ $assistant['profile_image'] }}"
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
                                        placeholder="Enter first name" value="{{ $assistant['first_name'] }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">Last name<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required
                                        placeholder="Enter last name" value="{{ $assistant['last_name'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email<span class="text-red"> *</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        placeholder="Enter email" value="{{ $assistant['email'] }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone number<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" required
                                        placeholder="Enter phone number" value="{{ $assistant['phone'] }}">
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
                    <form action="{{ route('admin.assistants.update-password', [$assistant['id']]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password<span class="text-red">
                                            *</span></label>
                                    <input type="password" class="form-control" id="password" name="password" required
                                        placeholder="Enter password">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Confirm password<span
                                            class="text-red"> *</span></label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required placeholder="Enter password">
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
