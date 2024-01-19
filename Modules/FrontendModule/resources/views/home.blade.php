@extends('frontendmodule::layouts.master')

@section('title', 'Home')

@push('css')
    <style>
        .notice-board {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border: none;
        }

        .scrolling-text {
            animation: scrollLeft 20s linear infinite;
            white-space: nowrap;
            display: flex;
            align-items: center;
            z-index: -1;
        }

        @keyframes scrollLeft {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-md-2">
                <p class="notice-board">Notice board</p>
            </div>
            <div class="col-md-8 scrolling-text">
                @forelse ($notices as $notice)
                    <p>{{ $notice['description'] }}
                        @if (!$loop->last)
                            <i class="bi bi-flower2 mx-2" style="color: #4CAF50"></i>
                        @endif
                    </p>
                @empty
                    <p>No notices yet.</p>
                @endforelse
            </div>
            <div class="col-md-2">
                <a href="{{ route('frontend.all-notices') }}" class="btn btn-primary float-right">View all</a>
            </div>
        </div>
    </section>

    <main>
        <section class="section">
            <div class="container">
                <div class="row no-gutters-lg">
                    <div class="col-12">
                        <h2 class="section-title">Latest Blogs</h2>
                    </div>
                    @forelse ($blogs as $blog)
                        @if ($loop->first)
                            <div class="col-12 mb-4">
                                <article class="card article-card">
                                    <a href="{{ route('frontend.blog-details', $blog['id']) }}">
                                        <div class="card-image">
                                            <div class="post-info">
                                                <span class="text-uppercase">{{ $blog->created_at->diffForHumans() }}</span>
                                            </div>
                                            <img loading="lazy" decoding="async"
                                                src="{{ asset('storage') }}/blog/images/{{ $blog['image'] }}"
                                                alt="Blog image" class="w-100">
                                        </div>
                                    </a>
                                    <div class="card-body px-0 pb-1">
                                        <ul class="post-meta mb-2">
                                            <li><a href="{{ route('frontend.blog-details', $blog['id']) }}" class="text-capitalize">Author:
                                                    {{ $blog->owner->first_name }} {{ $blog->owner->last_name }}
                                                    ({{ $blog->owner->user_type }})
                                                </a>
                                            </li>
                                        </ul>
                                        <h2 class="h1"><a class="post-title" href="{{ route('frontend.blog-details', $blog['id']) }}">{{ $blog['title'] }}</a>
                                        </h2>
                                        <p class="card-text">{!! $blog['description'] !!}</p>
                                        <div class="content"> <a class="read-more-btn" href="{{ route('frontend.blog-details', $blog['id']) }}">Read Full
                                                Blog</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @else
                            <div class="col-6 mb-4">
                                <article class="card article-card">
                                    <a href="{{ route('frontend.blog-details', $blog['id']) }}">
                                        <div class="card-image">
                                            <div class="post-info">
                                                <span class="text-uppercase">{{ $blog->created_at->diffForHumans() }}</span>
                                            </div>
                                            <img loading="lazy" decoding="async"
                                                src="{{ asset('storage') }}/blog/images/{{ $blog['image'] }}"
                                                alt="Blog image" class="w-100">
                                        </div>
                                    </a>
                                    <div class="card-body px-0 pb-1">
                                        <ul class="post-meta mb-2">
                                            <li><a href="{{ route('frontend.blog-details', $blog['id']) }}" class="text-capitalize">Author:
                                                    {{ $blog->owner->first_name }} {{ $blog->owner->last_name }}
                                                    ({{ $blog->owner->user_type }})
                                                </a>
                                            </li>
                                        </ul>
                                        <h2 class="h1"><a class="post-title" href="{{ route('frontend.blog-details', $blog['id']) }}">{{ $blog['title'] }}</a>
                                        </h2>
                                        <p class="card-text">{!! $blog['description'] !!}</p>
                                        <div class="content"> <a class="read-more-btn" href="{{ route('frontend.blog-details', $blog['id']) }}">Read Full
                                                Blog</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endif
                    @empty
                        <div class="col-12">
                            <h1>Noting to show !</h1>
                        </div>
                    @endforelse
                    <div class="col-12">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('js')
@endpush
