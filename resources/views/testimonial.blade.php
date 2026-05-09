@extends('layout.app')
@section('title', 'Testimonial')
@push('style')
@endpush

@section('content')
    <!-- Start Page Title Area -->
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>Testimonials</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Testimonials</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start Testimonials Area -->
    <section class="testimonials-area uk-testimonials uk-section bg-gray">
        <div class="uk-container">
            <div
                class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s"
            >
                @foreach ($testimonials as $testimonial)
                    <div class="testimonials-item">
                        <div class="testimonials-single-item">
                            {!! $testimonial->message !!}
                        </div>

                        <div class="quotation-profile">
                            <img src="{{ asset($testimonial->image) }}" alt="image" />

                            <div class="profile-info">
                                <h3>{{ $testimonial->name }}</h3>
                                <span>{{ $testimonial->title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Testimonials Area -->
@endsection
@push('scripts')
@endpush
