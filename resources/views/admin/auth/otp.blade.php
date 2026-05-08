<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login with Pin | Paces - Multipurpose Tailwind CSS & Bootstrap Admin Dashboard Template</title>
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
                    <div class="auth-brand text-center mb-3 position-relative">
                        <a href="{{ url()->current() }}" class="logo-dark">
                            <img src="{{asset('admin/assets/images/logo-black.png')}}" alt="dark logo" />
                        </a>
                        <a href="{{ url()->current() }}" class="logo-light">
                            <img src="{{asset('admin/assets/images/logo.png')}}" alt="logo" />
                        </a>
                        <p class="text-muted w-lg-75 mt-3 mx-auto">This screen is locked. Enter your PIN to continue.</p>
                    </div>

                    <form method="post" action="{{ route('otp.verify') }}" id="otpForm">
                        @csrf

                        <label class="form-label">
                            Enter your 6-digit code
                            <span class="text-danger">*</span>
                        </label>

                        <div class="d-flex gap-2 mb-2 two-factor">
                            <input type="text" maxlength="1" class="form-control text-center otp-input" required>
                            <input type="text" maxlength="1" class="form-control text-center otp-input" required>
                            <input type="text" maxlength="1" class="form-control text-center otp-input" required>
                            <input type="text" maxlength="1" class="form-control text-center otp-input" required>
                            <input type="text" maxlength="1" class="form-control text-center otp-input" required>
                            <input type="text" maxlength="1" class="form-control text-center otp-input" required>
                        </div>

                        <input type="hidden" name="otp" id="otp">

                        <div id="otpError" class="text-danger mb-3" style="display:none;">
                            Please enter complete 6-digit OTP.
                        </div>

                        @error('otp')
                        <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-semibold py-2">
                                Confirm
                            </button>
                        </div>
                    </form>

                    <p class="text-muted text-center mt-4 mb-0">
                        Not you? Return to
                        <a href="{{route('login')}}" class="text-decoration-underline link-offset-3 fw-semibold">Sign in</a>
                    </p>
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
<!-- end auth-fluid-->

<!-- Vendor js -->
<script src="{{asset('admin/assets/js/vendors.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('admin/assets/js/app.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('.otp-input');
        const form = document.getElementById('otpForm');
        const hiddenOtp = document.getElementById('otp');
        const otpError = document.getElementById('otpError');

        inputs.forEach((input, index) => {
            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');

                if (this.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Backspace' && !this.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        form.addEventListener('submit', function (e) {
            let otp = '';

            inputs.forEach(input => {
                otp += input.value;
            });

            hiddenOtp.value = otp;

            if (otp.length !== 6) {
                e.preventDefault();
                otpError.style.display = 'block';
                return false;
            }

            otpError.style.display = 'none';
        });
    });
</script>
</body>

</html>
