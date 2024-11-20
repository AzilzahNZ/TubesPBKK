<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - SIMPULS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo_unib.png') }}" alt="">
                <span class="d-none d-lg-block">SIMPULS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                @csrf
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/profile1.jpeg') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item" href="/profile">
                                <i class="ti-settings text-primary"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/admin">
                        <i class=""></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="/admin.manajemen-akun-pengguna">
                        <i class="bi bi-person-fill menu-icon"></i>
                        <span class="menu-title">Manajemen Akun Pengguna</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 'ormawa')
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/ormawa">
                        <i class="fa-solid fa-calculator menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'ormawa')
                <li class="nav-item">
                    <a class="nav-link" href="/ormawa.pengajuan-surat">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Pengajuan Surat</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'ormawa')
                <li class="nav-item">
                    <a class="nav-link" href="/ormawa.riwayat-pengajuan-surat">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Riwayat Pengajuan Surat</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 'staff-kemahasiswaan')
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/staff-kemahasiswaan">
                        <i class="fa-solid fa-calculator menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'staff-kemahasiswaan')
                <li class="nav-item">
                    <a class="nav-link" href="/staff-kemahasiswaan.surat-masuk">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Surat Masuk</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'staff-kemahasiswaan')
                <li class="nav-item">
                    <a class="nav-link" href="/staff-kemahasiswaan.surat-keluar">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Surat Keluar</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 'staff-tu')
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/staff-tu">
                        <i class="fa-solid fa-calculator menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role == 'staff-kemahasiswaan' || Auth::user()->role == 'staff-tu')
                <li class="nav-item">
                    <a class="nav-link" href="/staff-kemahasiswaan.riwayat-surat">
                        <i class="fa-solid fa-user-group menu-icon"></i>
                        <span class="menu-title">Riwayat Surat</span>
                    </a>
                </li>
            @endif
        </ul>
    </aside>

    <main id="main" class="main">

        <!-- ======= Breadcrumbs ======= -->
        <?php
        // Cari menu aktif berdasarkan URL saat ini
        $currentRouteName = Route::currentRouteName();
        $currentMenu = null;
        
        foreach ($menu as $key => $value) {
            if ($value->role . '.' . $value->link === $currentRouteName) {
                $currentMenu = $value;
                break;
            }
        }
        ?>

        <div class="pagetitle">
            {{-- <h1>{{ $currentMenu ? $currentMenu->title : 'Dashboard' }}</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">SIMPULS</a>
                    </li>

                    <!-- Tampilkan breadcrumb parent jika ada -->
                    <?php if (!empty($currentMenu) && isset($currentMenu->parent)): ?>
                    <li class="breadcrumb-item">
                        <a href="{{ route($currentMenu->role . '.' . $currentMenu->parent->link) }}">
                            {{ $currentMenu->parent->title }}
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Menu aktif -->
                    <?php if (!empty($currentMenu)): ?>
                    <li class="breadcrumb-item active">{{ $currentMenu->title }}</li>
                    <?php else: ?>
                    <li class="breadcrumb-item active">Dashboard</li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            @yield('content')
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>2024</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            SIMPULS <a href="https://bootstrapmade.com/">PPL</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
