@extends('layout.app')
@section('title', $service->name)
@push('style')
    <style>
        .service-details-header {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .service-details-header .item img {
            width: 100%;
            height: 500px;
            border-radius: 10px;
            object-fit: cover;
        }

        .services-details-desc h3 {
            color: #2b2b2b;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .services-details-desc {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .pricing-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        }

        .pricing-card .pricing-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ff5d24;
        }

        .pricing-card .pricing-price {
            font-size: 40px;
            font-weight: 800;
            color: #222;
            margin-bottom: 25px;
        }

        .pricing-card .pricing-price span {
            font-size: 18px;
            font-weight: 600;
            color: #666;
        }

        .pricing-card .pricing-features {
            list-style: none;
            padding: 0;
            margin: 0 0 30px;
            text-align: left;
        }

        .pricing-card .pricing-features li {
            margin-bottom: 12px;
            color: #555;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .pricing-card .pricing-features li i {
            color: #ff5d24;
            margin-right: 10px;
            font-size: 14px;
        }

        .pricing-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #f7f7f7;
            color: #222;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .pricing-card:hover .pricing-btn {
            background-color: #ff5d24;
            color: #fff;
        }
    </style>
@endpush

@section('content')

    <!-- Start Page Title Area -->
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>Services Details</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Services Details</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start Services Details Area -->
    <section class="services-details-area uk-services-details uk-section">
        <div class="uk-container">
            <article class="uk-article services-details">

                @if($service->images && $service->images->count() > 0)
                    <div class="service-details-header">
                        <div class="services-image-slides owl-carousel owl-theme">
                            @foreach ($service->images as $image)
                                <div class="item">
                                    <img src="{{ asset($image->images) }}" alt="img" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="uk-grid uk-grid-large" uk-grid>
                    <div class="uk-width-expand@m">
                        <div class="services-details-desc">
                            <h3>{{ $service->name }}</h3>
                            <div class="uk-margin-bottom">
                                {!! $service->short_description !!}
                            </div>
                            <div class="uk-margin-top">
                                {!! $service->description !!}
                            </div>
                        </div>

                        @if($service->prices && $service->prices->count() > 0)
                            <!-- Pricing Module -->
                            <div class="services-pricing uk-margin-large-top">
                                <h3 style="font-weight:700; color:#2b2b2b; margin-bottom:25px;">Pricing Plans</h3>
                                <div class="uk-child-width-1-2@m uk-child-width-1-1@s uk-grid-match" uk-grid>
                                    @foreach($service->prices as $price)
                                        <div>
                                            <div class="pricing-card">
                                                <div class="pricing-title">{{ $price->title }}</div>
                                                <div class="pricing-price">${{ number_format($price->price, 2) }} <span>/
                                                        {{ $price->title }}</span></div>
                                                <ul class="pricing-features">
                                                    @foreach(explode(',', $price->item) as $item)
                                                        <li><i class="fa-solid fa-check"></i> {{ trim($item) }}</li>
                                                    @endforeach
                                                </ul>
                                                <a href="/contact" class="pricing-btn">Get Started</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="uk-width-1-3@m">
                        <div class="services-details-desc">
                            <h3>Our Work Benefits</h3>
                            <div class="uk-margin-bottom">
                                {!! $service->work_benefit !!}
                            </div>

                            <div class="our-work-benefits uk-margin-top">
                                <ul class="accordion">
                                    @foreach ($service->faqs as $faq)
                                        <li class="accordion-item">
                                            <a class="accordion-title {{ $loop->first ? 'active' : '' }}"
                                                href="javascript:void(0)">
                                                <i class="fa-solid fa-plus"></i>
                                                {{ $faq->question }}
                                            </a>
                                            <p class="accordion-content" style="{{ $loop->first ? 'display:block;' : '' }}">
                                                {{ $faq->answer }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </article>
        </div>
    </section>
    <!-- End Services Details Area -->
@endsection
@push('scripts')
@endpush