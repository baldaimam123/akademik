@extends('layout')

@section('title', 'Data Semester')

@section('content')
<div class="container">
    <h3>Data Semester</h3>
    <form action="{{ route('semester.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="row g-2">
            <div class="col-md-3">
                <select name="nama_semester" class="form-control" required>
                    <option value="">Pilih Semester</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="tahun_ajaran" class="form-control" placeholder="Contoh: 2024/2025" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </form>
    @error('tahun_ajaran')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Semester</th>
                <th>Tahun Ajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semesters as $s)
            <tr>
                <td>{{ $s->nama_semester }}</td>
                <td>{{ $s->tahun_ajaran }}</td>
                <td>
                    <form action="{{ route('semester.destroy', $s->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                    <!-- Tombol edit bisa dikembangkan -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
