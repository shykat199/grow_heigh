@extends('layout.app')
@section('title', 'Service')
@push('style')
@endpush

@section('content')
    <!-- Start Page Title Area -->
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>Services</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Services</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start Services Area -->
    <section class="services-area uk-services uk-section">
        <div class="uk-container">
            <div class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s">
                @foreach ($services as $item)
                    <div class="item">
                        <div class="single-services-box">
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
                            <h3><a href="{{ route('service.show', $item->slug) }}">{{ $item->title }}</a></h3>
                            <div class="bar"></div>
                            <p>
                                {!! $item->short_description !!}
                            </p>

                            <a href="{{ route('service.show', $item->slug) }}" class="link-btn">

                                <span>Read More</span>

                                <i class="fa-solid fa-chevron-right"></i>

                            </a>

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
    <!-- End Services Area -->

@endsection
@push('scripts')
@endpush