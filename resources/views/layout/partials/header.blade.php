<div id="offcanvas-flip" class="mobile-navbar uk-mobile-navbar" uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" uk-close></button>

        <nav class="uk-navbar-container">
            <ul class="uk-navbar-nav">
                <li class="{{\Illuminate\Support\Facades\Route::is('home') ? 'uk-active' : ''}} "><a href="{{route('home')}}">Home</a></li>
                <li class="{{\Illuminate\Support\Facades\Route::is('about-us') ? 'uk-active' : ''}} "><a href="{{route('about-us')}}">About</a></li>
                <li class="{{\Illuminate\Support\Facades\Route::is('service') ? 'uk-active' : ''}} "><a href="{{route('service')}}">Services</a></li>
                <li class="{{\Illuminate\Support\Facades\Route::is('project') ? 'uk-active' : ''}} "><a href="{{route('project')}}">Project</a></li>
                <li class="{{\Illuminate\Support\Facades\Route::is('testimonial') ? 'uk-active' : ''}} "><a href="{{route('testimonial')}}">Testimonials</a></li>
                <li class="{{\Illuminate\Support\Facades\Route::is('team') ? 'uk-active' : ''}} "><a href="{{route('team')}}">Team</a></li>
                <li class="{{\Illuminate\Support\Facades\Route::is('blog') ? 'uk-active' : ''}} "><a href="{{route('blog')}}">Blog</a></li>
                <li class="{{\Illuminate\Support\Facades\Route::is('contact') ? 'uk-active' : ''}} "><a href="{{route('contact')}}">Contact</a></li>
            </ul>
        </nav>
    </div>
</div>

<header class="header-area uk-dark" data-uk-sticky="top: 0; animation: uk-animation-slide-top;">
    <div class="uk-container">
        <div class="uk-navbar">
            <div class="logo uk-navbar-left">
                <a href="/">
                    <img src="{{ asset($siteSettingData['site_logo'] ?? '') }}" alt="logo" style="height: 60px; width: auto;">
                </a>
            </div>

            <div
                class="uk-navbar-toggle"
                id="navbar-toggle"
                uk-toggle="target: #offcanvas-flip"
            >
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="navbar uk-navbar-right">
                <nav class="uk-navbar-container">
                    <ul class="uk-navbar-nav">
                        <li class="{{\Illuminate\Support\Facades\Route::is('home') ? 'uk-active' : ''}} "><a href="{{route('home')}}">Home</a></li>
                        <li class="{{\Illuminate\Support\Facades\Route::is('about-us') ? 'uk-active' : ''}} "><a href="{{route('about-us')}}">About</a></li>
                        <li class="{{\Illuminate\Support\Facades\Route::is('service') ? 'uk-active' : ''}} "><a href="{{route('service')}}">Services</a></li>
                        <li class="{{\Illuminate\Support\Facades\Route::is('project') ? 'uk-active' : ''}} "><a href="{{route('project')}}">Project</a></li>
                        <li class="{{\Illuminate\Support\Facades\Route::is('testimonial') ? 'uk-active' : ''}} "><a href="{{route('testimonial')}}">Testimonials</a></li>
                        <li class="{{\Illuminate\Support\Facades\Route::is('team') ? 'uk-active' : ''}} "><a href="{{route('team')}}">Team</a></li>
                        <li class="{{\Illuminate\Support\Facades\Route::is('blog') ? 'uk-active' : ''}} "><a href="{{route('blog')}}">Blog</a></li>
                        <li class="{{\Illuminate\Support\Facades\Route::is('contact') ? 'uk-active' : ''}} "><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
