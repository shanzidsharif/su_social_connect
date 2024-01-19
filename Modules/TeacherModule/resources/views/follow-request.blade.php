@extends('teachermodule::layouts.master')

@section('page_title', 'Student follow requests')

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
                                    <th class="text-center">Student id</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($follow_requests as $key => $follow_request)
                                    <tr>
                                        <td class="align-middle text-center" style="width: 2%;">
                                            {{ ($follow_requests->currentPage() - 1) * $follow_requests->perPage() + $key + 1 }}
                                        </td>
                                        <td class="align-middle text-center" style="width: 4%;">
                                            <img alt="image" class="avatar avatar-md br-7"
                                                src="{{ asset('storage/users/profile_images/') }}/{{ $follow_request->student['profile_image'] }}">
                                        </td>
                                        <td class="text-nowrap align-middle" style="width: 2%;">
                                            {{ $follow_request->student['first_name'] }}
                                        </td>
                                        <td class="text-nowrap align-middle" style="width: 2%;">
                                            {{ $follow_request->student['last_name'] }}
                                        </td>
                                        <td class="text-nowrap align-middle" style="width: 2%;">
                                            {{ $follow_request->student->student['student_id'] }}
                                        </td>
                                        <td class="text-nowrap align-middle" style="width: 2%;">
                                            {{ $follow_request->student->student['department'] }}
                                        </td>
                                        <td class="text-nowrap align-middle" style="width: 2%;">
                                            {{ $follow_request->student->student['subject'] }}
                                        </td>
                                        <td class="text-center align-middle" style="width: 2%;">
                                            <div class="g-2">
                                                @if ($follow_request->status == 'accepted')
                                                    <a class="btn btn-warning" data-bs-toggle="tooltip"
                                                        href="#">Accepted</a>
                                                @else
                                                    <a class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                                        href="{{ route('teacher.follow-request.accept', $follow_request['id']) }}">Accept</a>
                                                    <a class="btn btn-danger btn-sm" href="javascript:void(0)"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Delete"
                                                        onclick="alert_function('delete-{{ $follow_request['id'] }}')">Delete</a>
                                                    <form
                                                        action="{{ route('teacher.follow-request.destroy', $follow_request['id']) }}"
                                                        id="delete-{{ $follow_request['id'] }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
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
                    <div class="pagination m-l-20 m-b-10 float-end" id="pagination">
                        {!! $follow_requests->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('page_js')
@endpush
