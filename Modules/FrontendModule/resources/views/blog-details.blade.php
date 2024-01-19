@extends('frontendmodule::layouts.master')

@section('title', 'Blog details')

@push('css')
@endpush

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs mb-4"> <a href="{{ route('frontend.home') }}">Home</a>
                        <span class="mx-1">/</span> <a href="#">Blog details</a>
                    </div>
                    <h1 class="mb-4 border-bottom border-primary d-inline-block">Blog</h1>
                </div>
                <div class="col-12">
                    <article>
                        <img loading="lazy" decoding="async" src="{{ asset('storage') }}/blog/images/{{ $blog['image'] }}"
                            alt="Blog Image" class="w-100">
                        <ul class="post-meta mb-2 mt-4">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                                    <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                    <path
                                        d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                </svg> <span>{{ $blog->created_at->format('d F, Y') }}</span>
                            </li>
                        </ul>
                        <ul class="post-meta mb-2">
                            <li><a href="#" class="text-capitalize">Author:
                                    {{ $blog->owner->first_name }} {{ $blog->owner->last_name }}
                                    ({{ $blog->owner->user_type }})
                                </a>
                            </li>
                        </ul>
                        <h1 class="my-3">{{ $blog['title'] }}</h1>
                        <div class="content text-left">
                            {!! $blog['description'] !!}
                        </div>
                    </article>
                    <hr>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>Comments</h1>
                        </div>
                        <div class="card-body">
                            @forelse ($blog->comments as $comment)
                                <div class="row">
                                    <div class="col-10">
                                        <h3>
                                            {{ $comment->owner->first_name }} {{ $comment->owner->last_name }} (
                                            {{ $comment->owner->user_type }} )
                                        </h3>
                                    </div>
                                    <div class="col-2">
                                        <p class="float-right">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="col-12">
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @empty
                            <div class="row">
                                <div class="col-12">
                                    <p>No comment added yet !</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        <div class="card-footer">
                            @if (auth()->check())
                                <form action="{{ route('frontend.blog-comment', $blog['id']) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-11">
                                            <input type="text" class="form-control" name="comment" id="comment"
                                                placeholder="Enter your comment">
                                        </div>
                                        <div class="col-1">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <p>Please login to make comment.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
