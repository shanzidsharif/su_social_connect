@extends('adminmodule::layouts.master')

@section('page_title', 'Admin teacher create')

@push('page_css')
@endpush

@section('main_content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create form</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.teachers.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <input type="hidden" name="image-source"
                                    value="{{ asset('assets/placeholder-image.png') }}" id="image-source" />
                                <center>
                                    <img id="profile_image" src="{{ asset('assets/placeholder-image.png') }}"
                                        class="img-responsive br-5 preview" width="300">
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="profile_image" class="form-label">Profile image<span
                                            class="text-red"> *</span></label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image"
                                        required onchange="read_image(this, 'profile_image')">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="teacher_id" class="form-label">Teacher id<span
                                            class="text-red"> *</span></label>
                                    <input type="text" class="form-control" id="teacher_id" name="teacher_id" required
                                        placeholder="Enter teacher id">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">First name<span
                                            class="text-red"> *</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required
                                        placeholder="Enter first name">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">Last name<span
                                            class="text-red"> *</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required
                                        placeholder="Enter last name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email<span class="text-red"> *</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone number<span
                                            class="text-red"> *</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" required
                                        placeholder="Enter phone number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="department" class="form-label">Department<span
                                            class="text-red"> *</span></label>
                                    <input type="text" class="form-control" id="department" name="department" required
                                        placeholder="Enter department">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xl-12 mt-3">
                                <button type="submit" class="btn btn-primary float-end mb-0">Submit</button>
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
