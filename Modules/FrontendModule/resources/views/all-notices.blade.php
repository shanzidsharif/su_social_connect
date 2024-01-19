@extends('frontendmodule::layouts.master')

@section('title', 'Notices')

@push('css')
@endpush

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs mb-4"> <a href="{{ route('frontend.home') }}">Home</a>
                        <span class="mx-1">/</span> <a href="#">All Notices</a>
                    </div>
                    <h1 class="mb-4 border-bottom border-primary d-inline-block">Notices</h1>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notices as $key => $notice)
                                <tr>
                                    <th scope="row">{{ ($notices->currentPage() - 1) * $notices->perPage() + $key + 1 }}
                                    </th>
                                    <td>{{ $notice['title'] }}</td>
                                    <td>{{ $notice['description'] }}</td>
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
                    {{ $notices->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
