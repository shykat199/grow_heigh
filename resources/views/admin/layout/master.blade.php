<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>eCommerce Dashboard | Paces - Multipurpose Tailwind CSS & Bootstrap Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Paces is a modern, responsive admin dashboard available on ThemeForest. Ideal for building CRM, CMS, project management tools, and custom web applications with a clean UI, flexible layouts, and rich features." />
    <meta name="keywords"
        content="Paces, admin dashboard, ThemeForest, Bootstrap 5 admin, responsive admin, CRM dashboard, CMS admin, web app UI, admin theme, premium admin template" />
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="author" content="Coderthemes" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}" />


    <!-- Vector Maps css -->
    <link href="{{ asset('admin/assets/plugins/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
    <script src="{{ asset('admin/assets/js/demo.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('admin/assets/css/vendors.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link id="app-style" href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('style')
</head>

<body>
    <!-- Begin page -->

    @include('sweetalert::alert')

    <div class="wrapper">
        @include('admin.layout.partials.header')
        <!-- Topbar End -->
        @include('admin.layout.partials.sidebar')
        <!-- Sidenav Menu End -->


        <!-- ============================================================== -->
        <!-- Start Main Content -->
        <!-- ============================================================== -->

        <div class="content-page">

            @yield('content')
            <!-- container -->

            <!-- Footer Start -->
            @include('admin.layout.partials.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End of Main Content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    <!-- Vendor js -->
    <script src="{{ asset('admin/assets/js/vendors.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/maps/world-merc.js') }}"></script>
    <script src="{{ asset('admin/assets/js/maps/world.js') }}"></script>

    <script src="{{ asset('admin/assets/js/pages/custom-table.js') }}"></script>

    <script src="{{ asset('admin/assets/js/pages/dashboard-ecommerce.js') }}"></script>
    @stack('scripts')
</body>

</html>
