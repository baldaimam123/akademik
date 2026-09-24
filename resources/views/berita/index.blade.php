@extends('layout')

@section('title', 'Data berita')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Data berita</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('berita.create') }}" class="btn btn-success mb-3">+ Tambah berita</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Isi</th>
                <th>Gambar</th>
                <th>Penulis</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Dibaca</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($berita as $k)
                <tr>
                    <td>{{ $k->judul }}</td>
                    <td>{{ Str::limit($k->isi, 130) }}</td>
                    <!-- <td><img src="{{ asset('images/' . $k->gambar) }}" alt="{{ $k->judul }}" width="100"></td> -->
                    <td><img src="{{ asset('images/' . $k->gambar) }}" alt="{{ $k->judul }}" width="100"></td>
                    <td>{{ $k->penulis }}</td>
                    <td>{{ $k->tanggal }}</td>
                    <td>{{ $k->kategori }}</td>
                    <td>{{ $k->dibaca }}</td>
                    <td>
                        <a href="{{ route('berita.edit', $k->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('berita.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
