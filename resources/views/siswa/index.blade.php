@extends('layout')

@section('title', 'Data Siswa')

@section('content')
<div><h1>Jumlah Siswa : {{ $jumlahsiswa }}</h1></div>


@foreach($jumlahsiswas as $js)
    <div><h1>Jumlah Siswa di Kelas {{ $js->kelas->nama_kelas }} : {{ $js->total }}</h1></div>
    @endforeach

<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <h4 class="mb-2 mb-md-0">Data Siswa</h4>
        <!-- Tombol untuk membuka modal tambah siswa -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
            + Tambah Siswa
        </button>
    </div>
 <!-- Form Filter -->
 <form action="{{ route('siswa.index') }}" method="GET" class="mb-3">
        <div class="row">
            <!-- Dropdown Kelas -->
            <div class="col-md-3">
                <select name="kelas_id" class="form-control">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Dropdown Semester -->
            <div class="col-md-3">
                <select name="semester_id" class="form-control">
                    <option value="">-- Pilih Semester --</option>
                    <option value="1" {{ request('semester_id') == 1 ? 'selected' : '' }}>Ganjil</option>
                    <option value="2" {{ request('semester_id') == 2 ? 'selected' : '' }}>Genap</option>
                </select>
            </div>
            <!-- Dropdown Tahun Ajaran -->
            <div class="col-md-3">
                <input type="text" name="tahun_ajaran" class="form-control" value="{{ request('tahun_ajaran') }}" placeholder="Tahun Ajaran">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Tempat, Tgl Lahir</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Aksi</th>


                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $s)
                <tr>
                    <td>{{ $s->nisn }}</td>
                    <td>{{ $s->nama_lengkap }}</td>
                    <td>{{ $s->jenis_kelamin }}</td>
                    <td>{{ $s->tempat_lahir }}, {{ \Carbon\Carbon::parse($s->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $s->kelas->nama_kelas }}</td>
                    <td>
    @if($s->semester_id === null)
        Tidak Diketahui
    @else
        {{ $s->semester_id == 1 ? 'Ganjil' : 'Genap' }}
    @endif
</td>

<td>{{ $s->tahun_ajaran }}</td>

                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <!-- Tombol untuk membuka modal edit -->
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditSiswa{{ $s->id }}">
                                Edit
                            </button>
                            <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus siswa ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>

              <!-- Modal untuk edit siswa -->
<div class="modal fade" id="modalEditSiswa{{ $s->id }}" tabindex="-1" aria-labelledby="modalEditSiswaLabel{{ $s->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSiswaLabel{{ $s->id }}">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Edit Siswa -->
                <form action="{{ route('siswa.update', $s->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label for="nisn">NISN</label>
                        <input type="text" name="nisn" class="form-control" value="{{ $s->nisn }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="{{ $s->nama_lengkap }}">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="Laki-laki" {{ $s->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $s->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $s->tempat_lahir }}">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ \Carbon\Carbon::parse($s->tanggal_lahir)->format('Y-m-d') }}">
                    </div>

                    <!-- Dropdown untuk Kelas -->
                    <div class="mb-3">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ $k->id == $s->kelas_id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
    <label for="semester_id">Semester</label>
    <select name="semester_id" class="form-control" required>
        <option value="">-- Pilih Semester --</option>
        @foreach ($semesters as $sem)
            <option value="{{ $sem->id }}" {{ $sem->id == $s->semester_id ? 'selected' : '' }}>
                {{ $sem->nama_semester }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="tahun_ajaran">Tahun Ajaran</label>
    <input type="text" name="tahun_ajaran" class="form-control" value="{{ $s->tahun_ajaran }}">
</div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Modal untuk tambah siswa -->
<div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahSiswaLabel">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nisn">NISN</label>
                        <input type="text" name="nisn" class="form-control" id="nisn">
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir">
                    </div>
                    <div class="mb-3">
    <label for="semester_id">Semester</label>
    <select name="semester_id" class="form-control" id="semester_id" required>
        <option value="">-- Pilih Semester --</option>
        @foreach ($semesters as $sem)
            <option value="{{ $sem->id }}">{{ $sem->nama_semester }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="tahun_ajaran">Tahun Ajaran</label>
    <input type="text" name="tahun_ajaran" class="form-control" id="tahun_ajaran" placeholder="cth: 2024/2025">
</div>

                    <select name="kelas_id" class="form-control" id="kelas">
    <option value="">-- Pilih Kelas --</option>
    @foreach ($kelas as $k)
        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
    @endforeach
</select>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
