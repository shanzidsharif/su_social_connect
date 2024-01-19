@extends('frontendmodule::layouts.master')

@section('title', 'Teacher Forgot-Password')

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
            <h1 class="h1 text-center mb-5">Enter Your Email</h1>
            <form method="POST" action="{{ route('teacher.auth.forgot-password-email') }}" name="forgot-email-form">
                @csrf
                <div class="row justify-content-center" style="padding: 0 30%;">
                    <div class="col-12 mb-4">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                               required>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-lg btn-outline-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

