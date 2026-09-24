<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Berita Terbaru</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6f8;
        }

        /* =========================
           NOTIFIKASI
        ========================= */

        .notifikasi {
            position: relative;
        }

        .btn-notifikasi {
            position: relative;
            width: 42px;
            height: 42px;
            border: none;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .btn-notifikasi:hover {
            background-color: #f0f2f5;
        }

        /* Angka notifikasi */

        .badge-notifikasi {
            position: absolute;
            top: -3px;
            right: -3px;
            min-width: 19px;
            height: 19px;
            padding: 2px 5px;
            border-radius: 50%;
            background-color: #dc3545;
            color: white;
            font-size: 11px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Dropdown */

        .dropdown-notifikasi {
            width: 330px;
            padding: 0;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
        }

        .header-notifikasi {
            padding: 15px;
            border-bottom: 1px solid #eee;
            background-color: white;
        }

        .header-notifikasi h6 {
            margin: 0;
            font-weight: 700;
        }

        .item-notifikasi {
            display: block;
            padding: 12px 15px;
            text-decoration: none;
            color: #333;
            border-bottom: 1px solid #eee;
            background-color: white;
        }

        .item-notifikasi:hover {
            background-color: #f5f6f8;
        }

        .judul-notifikasi {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .tanggal-notifikasi {
            font-size: 12px;
            color: #888;
        }

        .footer-notifikasi {
            padding: 12px;
            text-align: center;
            background-color: white;
        }

        .footer-notifikasi a {
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }


        /* =========================
           BERITA
        ========================= */

        .berita-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            background: white;
            transition: 0.3s;
        }

        .berita-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
        }

        .berita-card img {
            height: 210px;
            width: 100%;
            object-fit: cover;
        }

        .kategori {
            font-size: 13px;
            font-weight: 600;
            color: #0d6efd;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .judul-berita {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.4;
            color: #222;
        }

        .deskripsi {
            font-size: 14px;
            line-height: 1.6;
            color: #6c757d;
        }

        .info-berita {
            font-size: 13px;
            color: #888;
        }

        .btn-baca {
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }


        /* =========================
           FILTER
        ========================= */

        .filter-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filter-title {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .kategori-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 25px;
        }

        .kategori-item {
            min-width: 180px;
        }

    </style>

</head>


<body>


    <div class="container py-5">


        {{-- =========================
             HEADER
        ========================= --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">
                    Berita Terbaru
                </h2>

                <p class="text-muted mb-0">
                    Informasi dan berita terbaru
                </p>

            </div>


            {{-- NOTIFIKASI --}}

            <div class="dropdown notifikasi">

                <button
                    class="btn-notifikasi"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >

                    {{-- Icon lonceng --}}
                    🔔

                    {{-- Jumlah belum dibaca --}}
                    @if($belumdibaca > 0)

                        <span class="badge-notifikasi">
                            {{ $belumdibaca }}
                        </span>

                    @endif

                </button>


                {{-- Dropdown notifikasi --}}

                <div class="dropdown-menu dropdown-menu-end dropdown-notifikasi">


                    <div class="header-notifikasi">

                        <h6>
                            Berita Belum Dibaca
                        </h6>

                    </div>


                    {{-- Contoh daftar berita --}}

                    @foreach($berita as $k)

                        {{-- Untuk sementara hanya menampilkan berita
                             yang belum dibaca --}}

                        @if($k->dibaca == 0)

                            <a
                                href="{{ route('utama.show', $k->id) }}"
                                class="item-notifikasi"
                            >

                                <div class="judul-notifikasi">

                                    {{ $k->judul }}

                                </div>

                                <div class="tanggal-notifikasi">

                                    {{ \Carbon\Carbon::parse($k->created_at)->translatedFormat('d F Y') }}

                                </div>

                            </a>

                        @endif

                    @endforeach


                    <div class="footer-notifikasi">

                        <a href="{{ route('utama.index') }}">

                            Lihat Semua Berita

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             FILTER KATEGORI
        ========================= --}}

        <div class="filter-box">

            <div class="filter-title">
                Filter Berita
            </div>


            <form action="" method="GET">

                <div class="kategori-list">


                    <div class="form-check kategori-item">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="kategori[]"
                            value="Pendidikan"
                            id="kategoriPendidikan"
                        >

                        <label
                            class="form-check-label"
                            for="kategoriPendidikan">

                            Pendidikan

                        </label>

                    </div>


                    <div class="form-check kategori-item">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="kategori[]"
                            value="Kegiatan"
                            id="kategoriKegiatan"
                        >

                        <label
                            class="form-check-label"
                            for="kategoriKegiatan">

                            Kegiatan Sekolah

                        </label>

                    </div>


                    <div class="form-check kategori-item">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="kategori[]"
                            value="Pengumuman"
                            id="kategoriPengumuman"
                        >

                        <label
                            class="form-check-label"
                            for="kategoriPengumuman">

                            Pengumuman

                        </label>

                    </div>


                    <div class="form-check kategori-item">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="kategori[]"
                            value="Prestasi"
                            id="kategoriPrestasi"
                        >

                        <label
                            class="form-check-label"
                            for="kategoriPrestasi">

                            Prestasi

                        </label>

                    </div>


                    <div class="form-check kategori-item">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="kategori[]"
                            value="Informasi"
                            id="kategoriInformasi"
                        >

                        <label
                            class="form-check-label"
                            for="kategoriInformasi">

                            Informasi

                        </label>

                    </div>


                    <div class="form-check kategori-item">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="kategori[]"
                            value="Lainnya"
                            id="kategoriLainnya"
                        >

                        <label
                            class="form-check-label"
                            for="kategoriLainnya">

                            Lainnya

                        </label>

                    </div>

                </div>


                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary px-4">

                        Filter

                    </button>

                </div>

            </form>

        </div>


        {{-- =========================
             DAFTAR BERITA
        ========================= --}}

        <div class="row g-4">


            @foreach($berita as $k)


                <div class="col-md-6 col-lg-4">


                    <div class="card berita-card h-100 shadow-sm">


                        {{-- Gambar --}}

                        <img
                            src="{{ asset('images/' . $k->gambar) }}"
                            alt="{{ $k->judul }}"
                        >


                        <div class="card-body d-flex flex-column">


                            {{-- Kategori --}}

                            <div class="kategori">

                                {{ $k->kategori }}

                            </div>


                            {{-- Judul --}}

                            <h3 class="judul-berita mb-2">

                                {{ $k->judul }}

                            </h3>


                            {{-- Deskripsi --}}

                            <p class="deskripsi mb-3">

                                {{ Str::limit($k->isi, 130) }}

                            </p>


                            {{-- Penulis & tanggal --}}

                            <div class="info-berita mb-3">

                                Oleh
                                <strong>{{ $k->penulis }}</strong>

                                <span class="mx-1">•</span>

                                {{ \Carbon\Carbon::parse($k->created_at)->translatedFormat('d F Y') }}

                            </div>


                            {{-- Baca --}}

                            <div class="mt-auto">

                                <a
                                    href="{{ route('utama.show', $k->id) }}"
                                    class="btn-baca"
                                >

                                    Baca Selengkapnya →

                                </a>

                            </div>


                        </div>

                    </div>

                </div>


            @endforeach


        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
```
