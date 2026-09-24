@extends('layout')

@section('title', 'Edit berita')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Edit berita</h4>

    <form action="{{ route('berita.update', $berita->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="judul">Nama berita</label>
            <input type="text" name="judul" class="form-control" id="judul" value="{{ $berita->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="isi">Isi berita</label>
            <textarea name="isi" class="form-control" id="isi" required>{{ $berita->isi }}</textarea>
        </div>
        <div class="mb-3">
            <label for="gambar">Gambar berita</label>
            <input type="file" name="gambar" class="form-control" id="gambar">
            @if($berita->gambar)
                <img src="{{ asset('images/' . $berita->gambar) }}" alt="{{ $berita->judul }}" width="100" class="mt-2">
            @endif
        </div>
        <div class="mb-3">
            <label for="penulis">Penulis</label>
            <input type="text" name="penulis" class="form-control" id="penulis" value="{{ $berita->penulis }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $berita->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" class="form-control" id="kategori" value="{{ $berita->kategori }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
