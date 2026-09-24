@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-4 shadow rounded">
    <h2 class="text-center mb-4">Selamat datang, {{ session('user')->name }}</h2>

    <p class="text-center text-muted mb-5">
        Halo dan selamat datang di Dashboard Anda! Di sini Anda dapat melihat berbagai informasi terkait akun Anda dan melakukan beberapa tindakan penting.
        Kami berharap Anda menikmati pengalaman Anda di platform ini dan merasa lebih mudah dalam mengakses informasi yang Anda butuhkan.
    </p>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Pengaturan Akun</h5>
                    @foreach ($dashboardData as $data)
                        <p class="card-text text-muted">
                            Kelas: {{ $data->kelas->nama_kelas }} - Jumlah Siswa: {{ $data->total }}
                        </p>
                        @endforeach
                    <p class="card-text text-muted">
                        Total Siswa: {{ $jumlahdash }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Statistik Penggunaan</h5>
                    <p class="card-text text-muted">
                        Periksa statistik dan analisis terkait penggunaan akun Anda, termasuk aktivitas terbaru dan data terkait performa Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <div class="d-grid">
            <button type="submit" class="btn btn-danger">Logout</button>
        </div>
    </form>

    <footer class="text-center mt-5 text-muted small">
        &copy; 2025 Platform Anda. <a href="#" class="text-success text-decoration-none">Kebijakan Privasi</a> |
        <a href="#" class="text-success text-decoration-none">Syarat & Ketentuan</a>
    </footer>
</div>
@endsection
