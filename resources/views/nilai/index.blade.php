@extends('layout')

@section('content')
<div class="container">
    <h4>Input Nilai Siswa</h4>

    {{-- Form Filter --}}
    <form method="GET" action="{{ route('nilai.index') }}" class="mb-4">
        <div class="col-md-4">
    <label for="mapel_id">Pilih Mata Pelajaran:</label>
    <select name="mapel_id" class="form-control" required>
        <option value="">-- Pilih Mapel --</option>
        @foreach($mapelList as $mapel)
            <option value="{{ $mapel->id }}" {{ request('mapel_id') == $mapel->id ? 'selected' : '' }}>
                {{ $mapel->nama_mapel }}
            </option>
        @endforeach
    </select>
</div>

        <div class="row">
            <div class="col-md-4">
                <label for="kelas">Pilih Kelas:</label>
                <select name="kelas_id" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="semester">Pilih Semester:</label>
                <select name="semester_id" class="form-control" required>
                    <option value="">-- Pilih Semester --</option>
                    @foreach ($semesterList as $semester)
                        <option value="{{ $semester->id }}" {{ request('semester_id') == $semester->id ? 'selected' : '' }}>
                            {{ $semester->nama_semester }}
                        </option>
                    @endforeach
                </select>
            </div>

           <div class="col-md-4">
    <label for="tahun_ajaran">Pilih Tahun Ajaran:</label>
    <select name="tahun_ajaran" class="form-control" required>
        <option value="">-- Pilih Tahun Ajaran --</option>
        @foreach($tahunList as $tahun)
            <option value="{{ $tahun }}" {{ request('tahun_ajaran') == $tahun ? 'selected' : '' }}>
                {{ $tahun }}
            </option>
        @endforeach
    </select>
</div>
            <div class="col-md-1 d-flex align-items-end mt-2">
                <button type="submit" class="btn btn-primary w-100">Tampil</button>
            </div>
        </div>
    </form>

    {{-- Form Input Nilai --}}
    @if ($siswas->count() && $tugas->count())
    <form method="POST" action="{{ route('nilai.store') }}">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
        @foreach($tugas as $t)
            <th>{{ $t->nama_tugas }}</th>
        @endforeach
        <th>Rata-rata</th> {{-- Tambahkan kolom ini --}}
                </tr>
            </thead>
            <tbody>
   @foreach($siswas as $siswa)
    @php
        $total = 0;
        $jumlahTugas = $tugas->count(); // Total tugas yang tersedia
    @endphp
    <tr>
        <td>{{ $siswa->nama_lengkap }}</td>
        @foreach($tugas as $t)
            @php
                $key = $siswa->id . '_' . $t->id;
                $nilai = $nilaiList[$key]->nilai ?? '';
                $total += is_numeric($nilai) ? $nilai : 0;
            @endphp
            <td>
                <input type="number" name="nilai[{{ $siswa->id }}][{{ $t->id }}]"
                       class="form-control" min="0" max="100"
                       value="{{ old('nilai.' . $siswa->id . '.' . $t->id, $nilai) }}">
            </td>
        @endforeach
        <td>
            <strong>
                {{ $jumlahTugas > 0 ? round($total / $jumlahTugas, 2) : '-' }}
            </strong>
        </td>
    </tr>
@endforeach

</tbody>

        </table>
        <button class="btn btn-success">Simpan Nilai</button>
    </form>
    @elseif (request()->filled(['kelas_id', 'semester_id', 'tahun_ajaran']))
        <div class="alert alert-warning">Tidak ada data siswa atau tugas untuk kelas, semester, dan tahun ajaran yang dipilih.</div>
    @endif
</div>
@endsection
