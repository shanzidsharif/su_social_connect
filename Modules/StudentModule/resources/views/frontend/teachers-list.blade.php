@extends('frontendmodule::layouts.master')

@section('title', 'Teachers list')

@push('css')
@endpush

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs mb-4"> <a href="{{ route('frontend.home') }}">Home</a>
                        <span class="mx-1">/</span> <a href="#">Teachers list</a>
                    </div>
                    <h1 class="mb-4 border-bottom border-primary d-inline-block">Teachers</h1>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Profile image</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Department</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teachers as $key => $teacher)
                                <tr>
                                    <th scope="row">
                                        {{ ($teachers->currentPage() - 1) * $teachers->perPage() + $key + 1 }}
                                    </th>
                                    <td>
                                        <img src="{{ asset('storage/users/profile_images') }}/{{ $teacher['profile_image'] }}"
                                            alt="" height="50" width="50">
                                    </td>
                                    <td>{{ $teacher['first_name'] }}</td>
                                    <td>{{ $teacher['last_name'] }}</td>
                                    <td>{{ $teacher->teacher->department }}</td>
                                    @php
                                        $send_request = $follow_requests->where('teacher_user_id', $teacher->id)->first();
                                    @endphp
                                    <td class="text-center">
                                        @if (!empty($send_request))
                                            @if ($send_request['status'] === 'pending')
                                                <a href="#" class="btn btn-info btn-sm" disabled>Pending request</a>
                                                <a href="{{ route('student.delete-follow-request', $teacher->id) }}"
                                                    class="btn btn-danger btn-sm">Cancel request</a>
                                            @endif
                                            @if ($send_request['status'] === 'accepted')
                                                <a href="#" class="btn btn-warning btn-sm" disabled>Following</a>
                                                <a href="{{ route('student.delete-follow-request', $teacher->id) }}"
                                                    class="btn btn-danger btn-sm">Unfollow</a>
                                            @endif
                                        @else
                                            <a href="{{ route('student.send-follow-request', $teacher['id']) }}"
                                                class="btn btn-primary">Send follow request</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nothing added yet !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
