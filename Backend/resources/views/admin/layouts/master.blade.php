<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Panel') - Quixlab</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">

    <!-- Quixlab CSS -->
    <link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">
        <!-- Nav Header -->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ route('admin.dashboard') }}">
                    <b class="logo-abbr"><img src="{{ asset('images/logo.png') }}" alt="Logo" /></b>
                    <span class="logo-compact"><img src="{{ asset('images/logo-compact.png') }}" alt="Logo Compact" /></span>
                    <span class="brand-title"><img src="{{ asset('images/logo-text.png') }}" alt="Logo Text" /></span>
                </a>
            </div>
        </div>

        <!-- Header -->
        <div class="header">
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <h4 class="mb-0">@yield('page-title', 'Admin Dashboard')</h4>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-sm">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li><a href="{{ route('admin.dashboard') }}"><i class="icon-speedometer menu-icon"></i> <span class="nav-text">Dashboard</span></a></li>
                    <li><a href="{{ route('blogs.index') }}"><i class="icon-docs menu-icon"></i> <span class="nav-text">Blogs</span></a></li>
                    <li><a href="{{ route('works.index') }}"><i class="icon-briefcase menu-icon"></i> <span class="nav-text">Works</span></a></li>
                    <li><a href="{{ route('articles.index') }}"><i class="icon-book-open menu-icon"></i> <span class="nav-text">Articles</span></a></li>
                </ul>
            </div>
        </div>

        <!-- Content Body -->
        <div class="content-body">
            <div class="container-fluid">

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="copyright">
                <p>&copy; {{ date('Y') }} Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a></p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/gleek.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>

    @stack('scripts')
</body>
</html>
