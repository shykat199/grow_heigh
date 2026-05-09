<footer class="footer-area uk-dark uk-footer">
    <div class="uk-container">
        <div
            class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-4@m uk-child-width-1-2@s"
        >
            <div class="item">
                <div class="single-footer-widget">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset($siteSettingData['site_logo'] ?? '') }}"  alt="logo" style="height: 60px; width: auto;">
                        </a>
                    </div>

                    <p>
                        {!! $siteSettingData['footer_short_description'] ?? '' !!}
                    </p>
                </div>
            </div>
            @php
$services = App\Models\Service::all()
            @endphp

            <div class="item">
                <div class="single-footer-widget">
                    <h3>Services</h3>
                    <div class="bar"></div>

                    <ul style="list-style: none; padding: 0; margin: 0">
                        @foreach ($services as $service)
                            <li style="margin-bottom: 10px">
                                <a
                                    href="{{ route('service.show', $service->slug) }}"
                                    style="
                      color: rgba(255, 255, 255, 0.8);
                      text-decoration: none;
                      transition: all 0.3s ease;
                    "
                                    onmouseover="this.style.color = 'white'"
                                    onmouseout="this.style.color = 'rgba(255, 255, 255, 0.8)'"
                                >{{ $service->name }}</a
                                >
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="item">
                <div class="single-footer-widget">
                    <h3>Address</h3>
                    <div class="bar"></div>

                    <div class="location">
                        <p>
                            {!! $siteSettingData['location_address'] ?? '' !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="single-footer-widget">
                    <h3>Contact</h3>
                    <div class="bar"></div>

                    <ul class="contact-info">
                        <li>
                            <a href="#"><span>{{ $siteSettingData['contact_email'] ?? '' }}</span></a>
                        </li>
                        <li>
                            <a href="#"><span>{{ $siteSettingData['contact_fax'] ?? '' }}</span></a>
                        </li>
                        <li><a href="#">{{ $siteSettingData['contact_number'] ?? '' }}</a></li>
                    </ul>
                    <ul class="social">
                    
                        @if(!empty($siteSettingData['facebook_link']))
                            <li>
                                <a href="{{ $siteSettingData['facebook_link'] }}" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                        @endif
                    
                        @if(!empty($siteSettingData['twitter_link']))
                            <li>
                                <a href="{{ $siteSettingData['twitter_link'] }}" target="_blank">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </li>
                        @endif
                    
                        @if(!empty($siteSettingData['linkedin_link']))
                            <li>
                                <a href="{{ $siteSettingData['linkedin_link'] }}" target="_blank">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                            </li>
                        @endif
                    
                        @if(!empty($siteSettingData['instagram_link']))
                            <li>
                                <a href="{{ $siteSettingData['instagram_link'] }}" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                    
                    </ul>
                </div>
            </div>
        </div>

        <div class="copyright-area">
            <div
                class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-2@m uk-child-width-1-2@s"
            >
                <div class="item">
                    <p>© Grow High All Rights Reserved</p>
                </div>

                <div class="item">
                    <ul>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="go-top">
                <i class="fa-solid fa-chevron-up"></i>
            </div>
        </div>
    </div>

    <div class="br-line"></div>
    <div class="footer-shape1">
        <img src="{{ asset('assets/img/footer-shape1.png') }}" alt="shape" />
    </div>
    <div class="footer-shape2">
        <img src="{{ asset('assets/img/footer-shape2.png') }}" alt="shape" />
    </div>
</footer>
