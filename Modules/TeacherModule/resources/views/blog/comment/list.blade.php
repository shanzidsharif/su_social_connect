@extends('teachermodule::layouts.master')

@section('page_title', 'Teacher blog comments')

@push('page_css')
@endpush

@section('main_content')
    <!-- Row -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('teacher.blogs.comment.store', $blog_id) }}" method="post">
                            @csrf
                            <div class="card-header border-bottom-0">
                                <div class="input-group w-50">
                                    <input type="text" class="form-control" placeholder="Enter your comment"
                                        id="comment" name="comment">
                                    <button class="input-group-text btn btn-primary" type="submit">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="e-table px-5 pb-5">
                    <div class="table-responsive table-lg">
                        <table class="table border-top table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl</th>
                                    <th class="text-center">Comment</th>
                                    <th class="text-center">Created By</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $key => $item)
                                    <tr>
                                        <td class="align-middle text-center">
                                            {{ ($comments->currentPage() - 1) * $comments->perPage() + $key + 1 }}</td>
                                        <td class="text-nowrap align-middle">{{ $item['comment'] }}</td>
                                        <td class="text-nowrap align-middle text-capitalize">{{ $item->owner->first_name }}
                                            {{ $item->owner->last_name }}
                                            ({{ $item->owner->user_type }})
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="g-2">
                                                <a class="btn text-danger btn-sm" href="javascript:void(0)"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete"
                                                    onclick="alert_function('delete-{{ $item['id'] }}')">
                                                    <span class="fe fe-trash-2 fs-14"></span></a>
                                                <form action="{{ route('teacher.blogs.comment.destroy', $item['id']) }}"
                                                    id="delete-{{ $item['id'] }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center align-middle"
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
                        {!! $comments->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('page_js')
@endpush
