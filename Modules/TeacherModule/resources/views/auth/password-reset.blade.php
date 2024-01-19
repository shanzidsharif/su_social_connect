@extends('frontendmodule::layouts.master')

@section('title', 'Teacher Password Reset')

@push('css')
    <style>
        form .error {
            color: #ff0000;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-heading">
                    <h1 class="banner-title" style="color: #ff9800">Reset Password</h1>
                </div>
            </div><!-- Col end -->
        </div><!-- Row end -->
    </div><!-- Container end -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-2 mb-4">
                    <div class="card-body">
                        <form action="{{ route('teacher.auth.password-reset') }}" method="post" id="product-select-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">

                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
                                </div>
                                <div class="col-md-6">

                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password">
                                </div>
                                <div class="col-md-12">

                                    <button type="submit" class="btn btn-primary float-right mt-4">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
