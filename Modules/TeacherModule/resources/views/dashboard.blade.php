@extends('teachermodule::layouts.master')

@section('page_title', 'Teacher dashboard')

@push('page_css')
<style>
    .table-responsive.table-lg {
        overflow-x: auto; /* Enable horizontal scroll for large tables */
    }

    .table-responsive.table-lg table {
        min-width: 100%; /* Ensure the table takes up the full width of its container */
    }

    .table-responsive.table-lg td.description-column p {
        max-width: 200px; /* Set a maximum width for the description column */
        word-wrap: break-word; /* Enable word-wrap for long text */
        white-space: break-spaces;
    }
</style>

@endpush

@section('main_content')
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="mt-2">
                                    <h6 class="">Active Student Follower</h6>
                                    <h2 class="mb-0 number-font">{{ $follow_count }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="mt-2">
                                    <h6 class="">Active Blogs</h6>
                                    <h2 class="mb-0 number-font">{{ $blog_count }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-1 END -->

    <!-- ROW-2 -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Blogs</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-lg">
                        <table class="table border-top table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Created By</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $key => $item)
                                    <tr>
                                        <td class="align-middle text-center">
                                            {{ ($blogs->currentPage() - 1) * $blogs->perPage() + $key + 1 }}</td>
                                        <td class="align-middle text-center">
                                            <img alt="image" class="avatar avatar-md br-7"
                                                src="{{ asset('storage/blog/images/') }}/{{ $item['image'] }}">
                                        </td>
                                        <td class="text-nowrap align-middle">{{ $item['title'] }}</td>
                                        <td class="text-nowrap align-middle description-column">
                                            <p>{!! $item['description'] !!}</p></td>
                                        <td class="text-nowrap align-middle text-capitalize">{{ $item->owner->first_name }}
                                            {{ $item->owner->last_name }}
                                            ({{ $item->owner->user_type }})
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="g-2">
                                                <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Comments"
                                                    href="{{ route('teacher.blogs.comment.get', $item['id']) }}"><span
                                                        class="fe fe-message-circle fs-14"></span></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center align-middle"
                                            style="padding: 3rem 0 !important;">
                                            Nothing to show !</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        {!! $blogs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-2 END -->
@endsection

@push('script')
@endpush
