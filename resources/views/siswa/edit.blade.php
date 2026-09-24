@extends('layout')

@section('title', 'Edit Siswa')

@section('content')
    <h4>Edit Data Siswa</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Modal -->
    <div class="modal fade" id="editSiswaModal" tabindex="-1" aria-labelledby="editSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSiswaModalLabel">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Edit Siswa -->
                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nisn">NISN</label>
        <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}" required>
    </div>
    <div class="mb-3">
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" value="{{ $siswa->nama_lengkap }}" required>
    </div>
    <div class="mb-3">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="Laki-laki" @if ($siswa->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
            <option value="Perempuan" @if ($siswa->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="tempat_lahir">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir }}" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $siswa->tanggal_lahir }}" required>
    </div>

    <div class="mb-3">
        <label for="kelas">Kelas</label>
        <select name="kelas_id" class="form-control" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" @if ($k->id == $siswa->kelas_id) selected @endif>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

            </div>
        </div>
    </div>
@endsection
