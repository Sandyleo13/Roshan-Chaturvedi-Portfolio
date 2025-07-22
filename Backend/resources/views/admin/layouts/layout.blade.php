<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('quixlab/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('quixlab/plugins/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Main wrapper -->
    <div id="main-wrapper">
        
        @include('layouts.partials.navbar') {{-- Top nav --}}
        @include('layouts.partials.sidebar') {{-- Sidebar --}}

        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('quixlab/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('quixlab/js/custom.min.js') }}"></script>
    <script src="{{ asset('quixlab/js/settings.js') }}"></script>
    <script src="{{ asset('quixlab/js/gleek.js') }}"></script>
</body>
</html>
