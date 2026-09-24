@extends('layout')

@section('title', 'Edit Kelas')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Edit Kelas</h4>

    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nama_kelas">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" value="{{ $kelas->nama_kelas }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
