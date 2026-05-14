@extends('layout.app')
@section('title', 'Home')
@push('front-style')

    <style>
        .service-filter-btn {
            cursor: pointer;
        }

        .service-filter-btn.active .single-features-box {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
            border: 1px solid #ff4a17;
        }

        .single-features-box {
            transition: all 0.35s ease;
        }

        .service-card {
            transition: all 0.45s ease;
        }

        .service-card.is-moving {
            opacity: 0;
            transform: translateY(25px) scale(0.96);
        }

        .service-card.is-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    </style>
@endpush

@section('content')
    <!-- Start Main Banner -->
    <div id="home" class="uk-banner uk-dark main-banner item-bg2">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="uk-container">
                    <div class="main-banner-content">
                        <h1>
                            {{ $siteSettingData['homepage_title'] ?? '' }}
                        </h1>
                        <p>
                            {{ $siteSettingData['homepage_subtitle'] ?? '' }}
                        </p>
                        <a href="{{ route('contact') }} " class="uk-button uk-button-default" style="margin-right: 10px"><i
                                class="fas fa-star"></i> Get Started</a>

                        <a href="{{ route('contact') }}" class="uk-button uk-button-default"><i class="fas fa-phone"></i> Free
                            Consultation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Banner -->

    <!-- Start Features Area -->
    <section class="uk-features uk-dark features-area uk-section uk-padding-remove-top">
        <div class="uk-container">
            <div class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m">

                @foreach ($category as $item)
                    <div class="uk-item service-filter-btn" data-id="service-{{ $item->id }}">
                        <div class="single-features-box">
                            <div class="icon">

                                @if($item->icon)

                                    <img src="{{ asset($item->icon) }}" alt="{{ $item->name }}"
                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 12px;">

                                @endif

                            </div>
                            <h3>{{ $item->name }}</h3>
                            <div class="bar"></div>
                            <div>
                                {!! $item->short_description  !!}
                            </div>

                            <div class="dot-img">
                                <img src="{{ asset('assets/img/dot.png') }}" alt="dot" class="color-dot" />
                                <img src="{{ asset('assets/img/white-dot.png') }}" alt="dot" class="white-dot" />
                            </div>

                            <div class="animation-img">
                                <img src="{{ asset('assets/img/shape1.svg') }}" alt="image" />
                                <img src="{{ asset('assets/img/shape2.svg') }}" alt="image" />
                                <img src="{{ asset('assets/img/shape3.svg') }}" alt="image" />
                                <img src="{{ asset('assets/img/shape1.svg') }}" alt="image" />
                                <img src="{{ asset('assets/img/shape2.svg') }}" alt="image" />
                                <img src="{{ asset('assets/img/shape3.svg') }}" alt="image" />
                                <img src="{{ asset('assets/img/shape1.svg') }}" alt="image" />
                                <img src="{{ asset('assets/img/shape3.svg') }}" alt="image" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Features Area -->

    <div class="separate uk-dark">
        <div class="br-line"></div>
    </div>

    <!-- Start About Area -->
    <section id="about" class="uk-about uk-dark about-area uk-section">
        <div class="uk-container">
            <div class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-2@m uk-child-width-1-1@s">
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
                            <h3>Best Digital Agency in the World</h3>
                            <div>
                                {!! $siteSettingData['about_us_short_description'] ?? '' !!}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="about-img">
                        <img src="{{ asset('assets/img/about1.jpg') }}" class="about-img1" alt="about-img" />
                        <img src="{{ asset('assets/img/about2.jpg') }}" class="about-img2" alt="about-img" />
                        <img src="{{ asset('assets/img/1.png') }}" class="shape-img" alt="shape" />

                        <a href="{{ route('about-us') }}" class="uk-button uk-button-default lax"
                            data-lax-preset="driftLeft">More About Us <i class="flaticon-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <div class="separate uk-dark">
        <div class="br-line"></div>
    </div>

    <!-- Start Services Area -->
    <section id="services" class="services-area uk-dark uk-services uk-section">
        <div class="uk-container">
            <div class="uk-section-title section-title">
                <span>What We Do</span>
                <h2>Our Services</h2>
                <div class="bar"></div>
            </div>

            <div id="serviceGrid" class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s">
                @foreach ($service as $item)
                    <div class="item service-card" data-id="service-category-{{ $item->category->id }}">
                        <div class="single-services">
                            <div class="icon" style="width:70px;
                                            height:70px;
                                            border-radius:50%;
                                            background:#000;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;">

                                @if($item->icon)

                                    <img src="{{ asset($item->icon) }}" alt="{{ $item->name }}" style="width:40px;
                                                        height:40px;
                                                        object-fit:cover;
                                                        border-radius:50%;">

                                @else

                                    <img src="https://placehold.co/40x40?text=No" alt="No Image" style="width:40px;
                                                        height:40px;
                                                        object-fit:cover;
                                                        border-radius:50%;">

                                @endif

                            </div>

                            <h3>{{ $item->name }}</h3>

                            <i class="fa-solid fa-arrow-right link-btn"></i>

                            <a href="{{ route('service.show', $item->slug) }}" class="link uk-position-cover"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Services Area -->

    <div class="separate uk-dark">
        <div class="br-line"></div>
    </div>

    <!-- Start Project Area -->
    <section id="project" class="project-area uk-dark uk-project uk-section">
        <div class="uk-container">
            <div class="uk-section-title section-title">
                <span>Our Completed Projects</span>
                <h2>Recent Projects</h2>
                <div class="bar"></div>

                <a href="{{ route('project') }}" class="uk-button uk-button-default">All Projects</a>
            </div>
        </div>

        <div class="project-slides owl-carousel owl-theme">
            @foreach ($projects as $item)
                <div class="single-project">
                    <a href="single-project.html" class="project-img">
                        <img src="{{ asset($item->image) }}" alt="image" />
                    </a>

                    <div class="project-content">
                        <h3><a href="single-project.html">{{ $item->name }}</a></h3>
                        <ul>
                            <li><a href="#">{{ $item->category->name }}</a></li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- End Project Area -->

    <div class="separate uk-dark">
        <div class="br-line"></div>
    </div>

    <!-- Start Feedback Area -->
    <section id="clients" class="feedback-area uk-dark uk-section uk-feedback">
        <div class="uk-container">
            <div class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-2@m uk-child-width-1-1@s">
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
    <div class="partner-area uk-section uk-dark uk-padding-remove-top">
        <div class="uk-container">
            <div class="partner-slides owl-carousel owl-theme">
                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-white-one.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-white-two.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="  {{ asset('assets/img/partner-white-three.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-white-four.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-white-five.png') }}" alt="image" />
                    </a>
                </div>

                <div class="item">
                    <a href="#">
                        <img src="{{ asset('assets/img/partner-white-six.png') }}" alt="image" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Partner Area -->

    <!-- Start Team Area -->
    <section id="team" class="team-area uk-dark uk-team uk-section">
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

    <!-- Start Blog Area -->
    <section id="blog" class="blog-area uk-dark uk-blog uk-section">
        <div class="uk-container">
            <div class="uk-section-title section-title">
                <span>Our Company Blog</span>
                <h2>Latest News</h2>
                <div class="bar"></div>

                <a href="{{ route('blog') }}" class="uk-button uk-button-default">View All</a>
            </div>

            <div class="blog-slides owl-carousel owl-theme">
                @foreach ($blog as $item)
                    <div class="single-blog-post">
                        <div class="blog-post-image">
                            <a href="single-blog.html">
                                <img src="{{ asset($item->image) }}" alt="image" />
                            </a>
                        </div>

                        <div class="blog-post-content">
                            <span class="date">{{ $item->created_at->format('d M Y') }}</span>
                            <h3>
                                <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                            </h3>
                            <a href="{{ route('blog.show', $item->slug) }}" class="read-more">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Blog Area -->

    <div class="separate uk-dark">
        <div class="br-line"></div>
    </div>

    <!-- Start CTA Section -->
    <section style="background: #000000; margin: 0; width: 100%">
        <div style="max-width: 900px; margin: 0 auto; text-align: center">
            <!-- CTA Heading -->
            <h2 style="
                font-size: 45px;
                font-weight: 700;
                color: white;
                margin: 0 0 20px 0;
                letter-spacing: -0.5px;
                line-height: 1.2;
              ">
                Ready to Grow Your Business?
            </h2>

            <!-- CTA Text -->
            <p style="
                font-size: 18px;
                color: rgba(255, 255, 255, 0.95);
                margin: 0 0 40px 0;
                font-weight: 500;
                line-height: 1.6;
                max-width: 700px;
                margin-left: auto;
                margin-right: auto;
              ">
                Let Grow High Agency take your brand to the next level with proven
                marketing strategies.
            </p>

            <!-- CTA Button -->

            <a href="{{ route('contact') }}" class="uk-button uk-button-default">

                <i class="fa-solid fa-rocket"></i>
                Start Your Growth Today

            </a>
        </div>
    </section>
    <!-- End CTA Section -->

    <!-- Start Contact Area -->
    <section id="contact" class="contact-area uk-dark uk-contact uk-section">
        <div class="uk-container">
            <div class="uk-section-title section-title">
                <span>Let's Talk</span>
                <h2>Get in Touch</h2>
            </div>

            <div class="uk-width-1-1">

                <form id="contactForm">

                    <div class="uk-grid uk-grid-medium uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>

                        <div>
                            <input type="text" class="uk-input" name="name" id="name" placeholder="Name">
                        </div>

                        <div>
                            <input type="email" class="uk-input" name="email" id="email" placeholder="Email">
                        </div>

                        <div>
                            <input type="text" class="uk-input" name="phone" placeholder="Phone">
                        </div>

                        <div>
                            <input type="text" class="uk-input" name="subject" id="subject" placeholder="Subject">
                        </div>

                    </div>

                    <div class="uk-margin" style="margin-top: 30px !important;">

                        <textarea name="message" class="uk-textarea" id="message" rows="5" placeholder="Your Message"></textarea>

                    </div>

                    <button type="submit" class="uk-button uk-button-default" style="margin-left:20px">

                        <i class="fa-solid fa-paper-plane"></i>
                        Submit Message

                    </button>

                </form>

            </div>
        </div>
    </section>
    <!-- End Contact Area -->

@endsection
@push('front-scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const filterButtons = document.querySelectorAll('.service-filter-btn');
            const serviceGrid = document.getElementById('serviceGrid');

            filterButtons.forEach(button => {

                button.addEventListener('click', function () {

                    const categoryId = this.dataset.id.replace('service-', 'service-category-');

                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const serviceCards = Array.from(serviceGrid.querySelectorAll('.service-card'));

                    serviceCards.forEach(card => {
                        card.classList.add('is-moving');
                        card.classList.remove('is-visible');
                    });

                    setTimeout(() => {

                        const matchedCards = serviceCards.filter(card => card.dataset.id === categoryId);
                        const otherCards = serviceCards.filter(card => card.dataset.id !== categoryId);

                        [...matchedCards, ...otherCards].forEach(card => {
                            serviceGrid.appendChild(card);
                        });

                        setTimeout(() => {
                            serviceCards.forEach(card => {
                                card.classList.remove('is-moving');
                                card.classList.add('is-visible');
                            });
                        }, 50);

                        serviceGrid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                    }, 350);
                });
            });
        });
    </script>
@endpush
