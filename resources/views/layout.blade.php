<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 600;
        }

        .nav-link {
            font-weight: 500;
        }

        .dropdown-item {
            padding: 8px 16px;
        }

        .dropdown-item:hover {
            background-color: #e9f7ef;
        }

        .navbar-text {
            font-weight: 500;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">

        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                MyPlatform
            </a>

            <!-- Tombol Mobile -->
            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- ========================= -->
                <!-- MENU KIRI -->
                <!-- ========================= -->

                <ul class="navbar-nav me-auto">

                    <!-- DASHBOARD -->
                    @if (session('user')->role === 'admin')

                        <li class="nav-item">

                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard-admin') }}">

                                Dashboard

                            </a>

                        </li>

                    @elseif (session('user')->role === 'guru')

                        <li class="nav-item">

                            <a class="nav-link {{ request()->is('guru/dashboard') ? 'active' : '' }}"
                                href="{{ route('guru.dashboard') }}">

                                Dashboard

                            </a>

                        </li>

                    @endif


                    <!-- DATA SISWA -->
                    <!-- ADMIN + GURU -->

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle
                            {{ request()->is('siswa*') ||
                               request()->is('tugas*') ||
                               request()->is('nilai*')
                               ? 'active'
                               : '' }}"
                            href="#"
                            id="dataDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                            Data Siswa

                        </a>


                        <ul class="dropdown-menu" aria-labelledby="dataDropdown">

                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('siswa.index') }}">
                                    Siswa
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('tugas.index') }}">
                                    Tugas
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('nilai.index') }}">
                                    Nilai
                                </a>
                            </li>

                        </ul>

                    </li>


                    <!-- MENU KHUSUS ADMIN -->

                    @if (session('user')->role === 'admin')

                        <!-- KELAS -->

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle
                                {{ request()->is('kelas*') ? 'active' : '' }}"
                                href="#"
                                id="kelasDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                Kelas

                            </a>

                            <ul class="dropdown-menu"
                                aria-labelledby="kelasDropdown">

                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('kelas.index') }}">

                                        Data Kelas

                                    </a>
                                </li>

                            </ul>

                        </li>


                        <!-- MAPEL -->

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle
                                {{ request()->is('mapel*') ? 'active' : '' }}"
                                href="#"
                                id="mapelDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                Mapel

                            </a>

                            <ul class="dropdown-menu"
                                aria-labelledby="mapelDropdown">

                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('mapel.index') }}">

                                        Data Mapel

                                    </a>
                                </li>

                            </ul>

                        </li>


                        <!-- SEMESTER -->

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle
                                {{ request()->is('semester*') ? 'active' : '' }}"
                                href="#"
                                id="semesterDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                Semester

                            </a>

                            <ul class="dropdown-menu"
                                aria-labelledby="semesterDropdown">

                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('semester.index') }}">

                                        Data Semester

                                    </a>
                                </li>

                            </ul>

                        </li>


                        <!-- BERITA -->

                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->is('berita*') ? 'active' : '' }}"
                                href="{{ route('berita.index') }}">

                                Berita

                            </a>

                        </li>

                    @endif

                </ul>


                <!-- MENU KANAN -->

                <ul class="navbar-nav">

                    <li class="nav-item me-2">

                        <span class="navbar-text text-white">
                            {{ session('user')->name ?? 'Pengguna' }}
                        </span>

                    </li>

                    <li class="nav-item">

                        <form method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <button class="btn btn-outline-light btn-sm"
                                type="submit">

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <!-- CONTENT -->

    <main class="py-4">

        <div class="container">

            @yield('content')

        </div>

    </main>


    <!-- FOOTER -->

    <footer class="text-center py-4 text-muted small">

        &copy; 2025 MyPlatform.

        <a href="#" class="text-success">
            Kebijakan Privasi
        </a>

        |

        <a href="#" class="text-success">
            Syarat & Ketentuan
        </a>

    </footer>


    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
