@extends('layout.app')
@section('title', $blog->title)
@push('style')

@section('content')

    <!-- Start Page Title Area -->
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>Project Details</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Project Details</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start Project Details Area -->
    <section class="project-details-area uk-project-details uk-section">
        <div class="uk-container">
            <div class="uk-grid uk-flex project-details">
                <div class="project-details-img uk-width-expand">
                    <img src="{{ asset($blog->image) }}" alt="image" />
                </div>

                <div class="item uk-width-1-5">
                    <div class="project-details-info">
                        <ul>
                            <li><span>Author:</span> Admin</li>
                            <li><span>Category:</span> {{ $blog->category->name }}</li>
                            <li><span>Date:</span> {{ $blog->created_at->format('d M Y') }}</li>
                            <li>

                                <span>Share:</span>

                                <ul>

                                    <!-- Facebook -->
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                            target="_blank">

                                            <i class="fa-brands fa-facebook-f"></i>

                                        </a>
                                    </li>

                                    <!-- Twitter / X -->
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                            target="_blank">

                                            <i class="fa-brands fa-x-twitter"></i>

                                        </a>
                                    </li>

                                    <!-- Instagram -->
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">

                                            <i class="fa-brands fa-instagram"></i>

                                        </a>
                                    </li>

                                    <!-- LinkedIn -->
                                    <li>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                            target="_blank">

                                            <i class="fa-brands fa-linkedin-in"></i>

                                        </a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="project-details-desc">
                <h3>{{ $blog->title }}</h3>
                <div>
                    {!! $blog->description !!}
                </div>
            </div>
        </div>
    </section>
    <!-- End Project Details Area -->

@endsection
@push('scripts')
@endpush