@extends('teachermodule::layouts.master')

@section('page_title', 'Teacher blog edit')

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
                    <form action="{{ route('teacher.blogs.update', [$blog['id']]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <center>
                                    <img id="image"
                                        @if (!empty($blog['image'])) src="{{ asset('storage/blog/images') }}/{{ $blog['image'] }}"
                                        @else
                                        src="{{ asset('assets/placeholder-image.png') }}" @endif
                                        class="img-responsive br-5" width="300">
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image<span class="text-red">
                                            *</span></label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        onchange="read_image(this, 'image')">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required
                                        placeholder="Enter title" value="{{ $blog['title'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description<span class="text-red">
                                            *</span></label>
                                    <textarea id="summernote" name="description">{{ $blog['description'] }}</textarea>
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
    <!-- INTERNAL SUMMERNOTE Editor JS -->
    <script src="{{ asset('assets/admin-module') }}/plugins/summernote/summernote1.js"></script>
    <script src="{{ asset('assets/admin-module') }}/js/summernote.js"></script>
@endpush
