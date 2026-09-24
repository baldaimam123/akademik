<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $berita->judul }}</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f6f8;
            color: #222;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .berita-detail {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* Gambar utama */

        .gambar-berita {
            width: 100%;
            height: 450px;
            object-fit: cover;
            display: block;
        }

        /* Isi */

        .isi-berita {
            padding: 40px;
        }

        /* Kategori */

        .kategori {
            display: inline-block;
            color: #0d6efd;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        /* Judul */

        .judul {
            font-size: 38px;
            line-height: 1.25;
            margin: 0 0 15px;
            color: #222;
        }

        /* Informasi berita */

        .info {
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .info span {
            margin-right: 15px;
        }

        /* Isi artikel */

        .artikel {
            font-size: 17px;
            line-height: 1.9;
            color: #444;
            white-space: pre-line;
        }

        /* Garis */

        .garis {
            border: 0;
            border-top: 1px solid #eee;
            margin: 35px 0 25px;
        }

        /* Tombol kembali */

        .btn-kembali {
            display: inline-block;
            padding: 11px 20px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-kembali:hover {
            background-color: #0b5ed7;
        }


        /* Tampilan HP */

        @media (max-width: 768px) {

            .container {
                margin: 25px auto;
            }

            .gambar-berita {
                height: 250px;
            }

            .isi-berita {
                padding: 25px;
            }

            .judul {
                font-size: 28px;
            }

            .artikel {
                font-size: 16px;
                line-height: 1.8;
            }

        }

    </style>

</head>


<body>

    <div class="container">

        <article class="berita-detail">

            {{-- Gambar --}}
            <img
                src="{{ asset('images/' . $berita->gambar) }}"
                alt="{{ $berita->judul }}"
                class="gambar-berita"
            >


            <div class="isi-berita">

                {{-- Kategori --}}
                <div class="kategori">
                    {{ $berita->kategori }}
                </div>


                {{-- Judul --}}
                <h1 class="judul">
                    {{ $berita->judul }}
                </h1>


                {{-- Penulis dan tanggal --}}
                <div class="info">

                    <span>
                        Penulis:
                        <strong>{{ $berita->penulis }}</strong>
                    </span>

                    <span>
                        Tanggal:
                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                    </span>

                </div>


                {{-- Isi berita --}}
                <div class="artikel">

                    {{ $berita->isi }}

                </div>


                <hr class="garis">


                {{-- Tombol kembali --}}
                <a
                    href="{{ route('utama.index') }}"
                    class="btn-kembali"
                >
                    ← Kembali ke Berita
                </a>

            </div>

        </article>

    </div>

</body>

</html>
```
