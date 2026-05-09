@extends('layout.app')
@section('title', 'Team')
@push('style')
@endpush

@section('content')
    <!-- Start Page Title Area -->
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>Team</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Team</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start Team Area -->
    <section class="team-area uk-team uk-section">
        <div class="uk-container">
            <div
                class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s"
            >
            @foreach ($teams as $team)

                <div class="single-team">

                    <ul class="team-social">

                        @if($team->fb_link)
                            <li>
                                <a href="{{ $team->fb_link }}" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                        @endif

                        @if($team->twitter_link)
                            <li>
                                <a href="{{ $team->twitter_link }}" target="_blank">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </li>
                        @endif

                        @if($team->linkedin_link)
                            <li>
                                <a href="{{ $team->linkedin_link }}" target="_blank">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </li>
                        @endif

                        @if($team->insta_link)
                            <li>
                                <a href="{{ $team->insta_link }}" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                        @endif

                    </ul>

                    <img src="{{ asset($team->image) }}" alt="{{ $team->name }}" />

                    <div class="team-content">

                        <h3>{{ $team->name }}</h3>

                        <span>{{ $team->position }}</span>

                    </div>

                </div>

            @endforeach
            </div>
        </div>
    </section>
    <!-- End Team Area -->
@endsection
@push('scripts')
@endpush
