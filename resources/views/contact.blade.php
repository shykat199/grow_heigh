@extends('layout.app')
@section('title', 'Contact Us')
@push('style')
@endpush

@section('content')
    <!-- Start Page Title Area -->
    <section class="page-title-area uk-page-title">
        <div class="uk-container">
            <h1>Contact</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Contact</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title Area -->

    <!-- Start Contact Area -->
    <section id="contact" class="contact-area uk-contact uk-section">
        <div class="uk-container">
            <div class="uk-section-title section-title">
                <span>Let's Talk</span>
                <h2>Get in Touch</h2>
            </div>

            <div class="uk-width-1-1">

                <form id="contactForm" style="width:100%;">

                    <div class="uk-grid-medium uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>

                        <div>
                            <input type="text" class="uk-input" name="name" id="name" placeholder="Name" style="width:100%;">
                        </div>

                        <div>
                            <input type="email" class="uk-input" name="email" id="email" placeholder="Email" style="width:100%;">
                        </div>

                        <div>
                            <input type="text" class="uk-input" name="phone" placeholder="Phone" style="width:100%;">
                        </div>

                        <div>
                            <input type="text" class="uk-input" name="subject" id="subject" placeholder="Subject"
                                style="width:100%;">
                        </div>

                    </div>

                    <div class="uk-margin" style="margin-top: 30px !important;">

                        <textarea name="message" class="uk-textarea" id="message" rows="5" placeholder="Your Message"
                            style="width:100%;"></textarea>

                    </div>

                    <button type="submit" class="uk-button uk-button-default" style="margin-left: 15px !important;">

                        <i class="fa-solid fa-paper-plane"></i>
                        Submit Message

                    </button>

                </form>

            </div>
        </div>
    </section>
    <!-- End Contact Area -->
@endsection
@push('scripts')
@endpush
