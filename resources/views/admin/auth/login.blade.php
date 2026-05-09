<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Sign In | Paces - Multipurpose Tailwind CSS & Bootstrap Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Paces is a modern, responsive admin dashboard available on ThemeForest. Ideal for building CRM, CMS, project management tools, and custom web applications with a clean UI, flexible layouts, and rich features." />
    <meta name="keywords" content="Paces, admin dashboard, ThemeForest, Bootstrap 5 admin, responsive admin, CRM dashboard, CMS admin, web app UI, admin theme, premium admin template" />
    <meta name="author" content="Coderthemes" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}" />
    <!-- Theme Config Js -->
    <script src="{{asset('admin/assets/js/config.js')}}"></script>
    <script src="{{asset('admin/assets/js/demo.js')}}"></script>

    <!-- Vendor css -->
    <link href="{{asset('admin/assets/css/vendors.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link id="app-style" href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>
@include('sweetalert::alert')
<div class="position-absolute top-0 end-0">
    <img src="{{asset('admin/assets/images/auth-card-bg.svg')}}" class="auth-card-bg-img" alt="auth-card-bg" />
</div>
<div class="position-absolute bottom-0 start-0" style="transform: rotate(180deg)">
    <img src="{{asset('admin/assets/images/auth-card-bg.svg')}}" class="auth-card-bg-img" alt="auth-card-bg" />
</div>
<div class="auth-box overflow-hidden align-items-center d-flex">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-md-6 col-sm-8">
                <div class="card p-4">
                    <div class="auth-brand text-center mb-2">
                        <a href="{{url('/login')}}" class="logo-dark">
                            <img src="{{asset('admin/assets/images/logo-black.png')}}" alt="dark logo" />
                        </a>
                        <a href="{{url('/login')}}" class="logo-light">
                            <img src="{{asset('admin/assets/images/logo.png')}}" alt="logo" />
                        </a>
                        <h4 class="fw-bold text-dark mt-3">Great to see you here 👋</h4>
                        <p class="text-muted w-lg-75 mx-auto">Let’s get you signed in. Enter your email and password to continue.</p>
                    </div>
                    <form class="forms-sample" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">
                                Email address
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  id="userEmail" placeholder="you&#64;example.com" required />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="userPassword" class="form-label">
                                Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control @error('email') is-invalid @enderror" id="userPassword" placeholder="••••••••" required />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input form-check-input-light fs-14" type="checkbox" checked id="rememberMe" />
                                <label class="form-check-label" for="rememberMe">Keep me signed in</label>
                            </div>
{{--                            <a href="auth-reset-pass.html" class="text-decoration-underline link-offset-3 text-muted">Forgot Password?</a>--}}
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-semibold py-2">Sign In</button>
                        </div>
                    </form>
                </div>

                <p class="text-center text-muted mt-4 mb-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    Paces — by
                    <span class="fw-semibold">Coderthemes</span>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('admin/assets/js/vendors.min.js')}}"></script>

<script src="{{asset('admin/assets/js/app.js')}}"></script>

</body>
</html>
