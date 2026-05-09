<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo logo-light">
            <span class="logo-lg"><img src="{{ asset('admin/assets/images/logo.png') }}" alt="logo" /></span>
            <span class="logo-sm"><img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="small logo" /></span>
        </span>

        <span class="logo logo-dark">
            <span class="logo-lg"><img src="{{ asset('admin/assets/images/logo-black.png') }}" alt="dark logo" /></span>
            <span class="logo-sm"><img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="small logo" /></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-on-hover">
        <span class="btn-on-hover-icon"></span>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-offcanvas">
        <i class="ti ti-menu-4 align-middle"></i>
    </button>

    <div class="scrollbar" data-simplebar="">
        <div id="user-profile-settings" class="sidenav-user"
            style="background: url({{ asset('admin/assets/images/user-bg-pattern.svg') }})">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="#!" class="link-reset">
                        <img src="{{ asset('admin/assets/images/users/user-1.jpg') }}" alt="user-image"
                            class="rounded-circle mb-2 avatar-md" />
                        <span class="sidenav-user-name fw-bold">David Dev</span>
                        <span class="fs-12 fw-semibold" data-lang="user-role">Art Director</span>
                    </a>
                </div>
                <div>
                    <a class="dropdown-toggle drop-arrow-none link-reset sidenav-user-set-icon"
                        data-bs-toggle="dropdown" data-bs-offset="0,12" href="#!" aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ti ti-settings fs-24 align-middle ms-1"></i>
                    </a>

                    <div class="dropdown-menu">
                        <!-- Header -->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome back!</h6>
                        </div>

                        <!-- My Profile -->
                        <a href="#!" class="dropdown-item">
                            <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Profile</span>
                        </a>

                        <!-- Logout -->
                        <a href="javascript:void(0);" class="dropdown-item text-danger fw-semibold">
                            <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--- Sidenav Menu -->
        <div id="sidenav-menu">
            <ul class="side-nav">
                <li class="side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                        <span class="menu-text" data-lang="dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-category"></i></span>
                        <span class="menu-text">Categories</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.services.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-briefcase"></i></span>
                        <span class="menu-text">Services</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.service-faqs.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-help"></i></span>
                        <span class="menu-text">Service FAQs</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.service-images.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-photo"></i></span>
                        <span class="menu-text">Service Images</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.service-prices.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-cash"></i></span>
                        <span class="menu-text">Service Prices</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.projects.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-folder"></i></span>
                        <span class="menu-text">Projects</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.blogs.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-article"></i></span>
                        <span class="menu-text">Blogs</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.testimonials.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-message-star"></i></span>
                        <span class="menu-text">Testimonials</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.teams.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-users"></i></span>
                        <span class="menu-text">Team Members</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
