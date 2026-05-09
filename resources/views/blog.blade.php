@extends('layout.app')
@section('title', 'Blog')
@push('style')
@endpush

@section('content')
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>Blog</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Blog</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start Blog Area -->
    <section class="blog-area uk-blog uk-section">
        <div class="uk-container">
            <div
                class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s"
            >
            @foreach($blogs as $blog)
                <div class="single-blog-post">
                    <div class="blog-post-image">
                        <a href="single-blog.html">
                            <img src="{{ asset($blog->image) }}" alt="image" />
                        </a>
                    </div>

                    <div class="blog-post-content">
                        <span class="date">{{ $blog->created_at->format('d F Y') }}</span>
                        <h3>
                            <a href="{{ route('blog.show', $blog->slug) }}"
                            >{{ $blog->title }}</a
                            >
                        </h3>
                        <a href="{{ route('blog.show', $blog->slug) }}" class="read-more">Read More</a>
                    </div>
                </div>
            @endforeach
            </div>

    
        </div>
    </section>
    <!-- End Blog Area -->
@endsection
@push('scripts')
@endpush
