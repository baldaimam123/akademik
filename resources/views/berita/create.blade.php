@extends('layout')

@section('title', 'Tambah Berita')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Tambah Berita</h4>

    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" id="judul" required>
        </div>
        <div class="mb-3">
            <label for="isi">Isi</label>
            <textarea name="isi" class="form-control" id="isi" required></textarea>
        </div>
        <label for="gambar">Gambar Lapangan:</label>
            <input type="file" name="gambar" accept="gambar/*" required>
        <div class="mb-3">
            <label for="penulis">Penulis</label>
            <input type="text" name="penulis" class="form-control" id="penulis" required>
        </div>
        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal" required>
        </div>
        <div class="mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" class="form-control" id="kategori" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
