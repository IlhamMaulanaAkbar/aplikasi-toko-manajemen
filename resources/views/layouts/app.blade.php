<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Livi - Beauty House')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo-livi.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}" />

    <style>
        .app-topstrip {
            display: none !important;
        }

        .app-header {
            position: fixed;
            top: 0;
            height: 65px;
            z-index: 50;
        }

        .body-wrapper {
            padding-top: 65px;
        }

        #main-wrapper .left-sidebar,
        .left-sidebar {
            top: 0 !important;
            margin-top: 0 !important;
        }

        /* Sidebar menu container */
        .scroll-sidebar {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .room-card {
            transition: all .25s ease;
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, .12);
        }
    </style>


</head>

<body>
    <!-- Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        {{-- SIDEBAR --}}
        @include('layouts.sidebar')

        <!-- Main wrapper -->
        <div class="body-wrapper">

            {{-- NAVBAR --}}
            @include('layouts.navbar')

            <div class="container-fluid py-4">
                @yield('content')
            </div>

        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/dashboard.js') }}"></script> --}}
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables-init.js') }}"></script>

    {{-- Script tambahan halaman --}}
    @stack('scripts')

    <!-- Icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
