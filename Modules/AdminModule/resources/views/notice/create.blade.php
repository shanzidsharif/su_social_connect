@extends('adminmodule::layouts.master')

@section('page_title', 'Admin notice create')

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
                    <form action="{{ route('admin.notices.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title<span class="text-red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required
                                        placeholder="Enter title">
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description<span class="text-red">
                                            *</span></label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter description" rows="3"></textarea>
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
