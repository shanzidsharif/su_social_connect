@extends('adminmodule::layouts.master')

@section('page_title', 'Admin teachers list')

@push('page_css')
    <style>
    </style>
@endpush

@section('main_content')
    <!-- Row -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card-header border-bottom-0">
                            <form action="{{ route('admin.teachers.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ request()->input('search') }}"
                                        id="search" name="search">
                                    <button class="input-group-text btn btn-primary" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-header border-bottom-0 float-end">
                            <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary mb-4">Add new<i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="e-table px-5 pb-5">
                    <div class="table-responsive table-lg">
                        <table class="table border-top table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl</th>
                                    <th class="text-center">Profile image</th>
                                    <th class="text-center">First name</th>
                                    <th class="text-center">Last name</th>
                                    <th class="text-center">Email</th>
                                    {{-- <th class="text-center">Phone</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Teacher id</th> --}}
                                    <th class="text-center">Is active</th>
                                    <th class="text-center">Is varified</th>
                                    <th class="text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('teachermodule::admin.teacher.partials._table-rows', [
                                    'items' => $teachers,
                                ])
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="pagination m-l-20 m-b-10 float-end" id="pagination">
                        {!! $teachers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('page_js')
@endpush
