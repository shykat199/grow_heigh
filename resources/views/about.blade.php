@extends('layout.app')
@section('title', 'About Us')
@push('style')
@endpush

@section('content')

    <!-- Start Page Title Area -->
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>About</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>About</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start About Area -->
    <section class="uk-about about-area uk-section">
        <div class="uk-container">
            <div
                class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-2@m uk-child-width-1-1@s"
            >
                <div class="item">
                    <div class="about-content">
                        <div class="uk-section-title section-title">
                            <span>About Us</span>
                            <h2>{{ $siteSettingData['about_us_title'] ?? '' }}</h2>
                            <div class="bar"></div>
                        </div>

                        <div class="about-text">
                            <div class="icon">
                                <i class="flaticon-quality"></i>
                            </div>
                            {!! $siteSettingData['about_us_description'] ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="about-img">
                        <img
                            src="{{ asset('assets/img/about1.jpg') }}"
                            class="about-img1"
                            alt="about-img"
                        />
                        <img
                            src="{{ asset('assets/img/about2.jpg') }}"
                            class="about-img2"
                            alt="about-img"
                        />
                        <img src="{{ asset('assets/img/1.png') }}" class="shape-img" alt="shape" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <div class="separate">
        <div class="br-line"></div>
    </div>

    <!-- Start Feedback Area -->
    <section id="clients" class="feedback-area uk-section uk-feedback">
        <div class="uk-container">
            <div
                class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-2@m uk-child-width-1-1@s"
            >
                <div class="item">
                    <div class="feedback-img">
                        <img src="{{ asset('assets/img/women.jpg') }}" alt="image" />

                        <img src="{{ asset('assets/img/1.png') }}" class="shape-img" alt="image" />

                        <a href="https://www.youtube.com/watch?v=bk7McNUjWgw" class="video-btn popup-youtube">
                            <i class="fa-brands fa-youtube"></i> Watch Video
                        </a>
                    </div>
                </div>

                <div class="item">
                    <div class="feedback-inner">
                        <div class="uk-section-title section-title">
                            <span>What Client Says About US</span>
                            <h2>Our Testimonials</h2>
                            <div class="bar"></div>
                        </div>

                    <div class="feedback-slides owl-carousel owl-theme">
                        @foreach ($testimonial as $item)
                            <div class="single-feedback">
                                <i class="flaticon-quote"></i>
                                <div>
                                    {!! $item->message !!}
                                </div>

                                <div class="client">
                                    <h3>{{ $item->name }}</h3>
                                    <span>{{ $item->title }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feedback Area -->

    <!-- Start Partner Area -->
    <div class="partner-area uk-section uk-padding-remove-top">
        <div class="uk-container">
            <div class="partner-slides owl-carousel owl-theme">
                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-one.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-two.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-three.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-four.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-five.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-six.png') }}" alt="image" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Partner Area -->

    <!-- Start Team Area -->
    <section id="team" class="team-area uk-team uk-section">
        <div class="uk-container">
            <div class="uk-section-title section-title">
                <span>Meet Our Experts</span>
                <h2>Our Team</h2>
                <div class="bar"></div>

                <a href="{{ route('team') }}" class="uk-button uk-button-default">View All</a>
            </div>
        </div>

        <div class="team-slides owl-carousel owl-theme">
            @foreach ($team as $item)

                <div class="single-team">

                    <ul class="team-social">

                        @if($item->fb_link)
                            <li>
                                <a href="{{ $item->fb_link }}" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                        @endif

                        @if($item->twitter_link)
                            <li>
                                <a href="{{ $item->twitter_link }}" target="_blank">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </li>
                        @endif

                        @if($item->linkedin_link)
                            <li>
                                <a href="{{ $item->linkedin_link }}" target="_blank">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </li>
                        @endif

                        @if($item->insta_link)
                            <li>
                                <a href="{{ $item->insta_link }}" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                        @endif

                    </ul>

                    <img src="{{ asset($item->image) }}" alt="image" />

                    <div class="team-content">
                        <h3>{{ $item->name }}</h3>
                        <span>{{ $item->title }}</span>
                    </div>

                </div>

            @endforeach
        </div>
    </section>
    <!-- End Team Area -->

@endsection
@push('scripts')
@endpush
