@extends('layout')

@section('content')
<div class="container">
    <h4>Data Mata Pelajaran</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('mapel.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <label>Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" class="form-control" required>
            </div>
            <div class="col-md-5">
                <label>Nama Guru</label>
                <input type="text" name="guru_mapel" class="form-control" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">Tambah</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mapel</th>
                <th>Guru Pengampu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mapels as $index => $m)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $m->nama_mapel }}</td>
                <td>{{ $m->guru_mapel }}</td>
                <td>
                    <!-- Form Update -->
                    <form action="{{ route('mapel.update', $m->id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="text" name="nama_mapel" value="{{ $m->nama_mapel }}" required>
                        <input type="text" name="guru_mapel" value="{{ $m->guru_mapel }}" required>
                        <button class="btn btn-warning btn-sm">Update</button>
                    </form>

                    <!-- Form Hapus -->
                    <form action="{{ route('mapel.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
