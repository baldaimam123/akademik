@extends('layout')

@section('title', 'Edit tugas')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Edit tugas</h4>

    <form action="{{ route('tugas.update', $tugas->id) }}" method="POST">
        @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_tugas">Nama Tugas</label>
        <input type="text" name="nama_tugas" class="form-control" value="{{ $tugas->nama_tugas }}" required>
    </div>
    <div class="mb-3">
        <label for="kelas_id">Kelas</label>
        <select name="kelas_id" class="form-control" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" @if ($k->id == $tugas->kelas_id) selected @endif>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="semester_id">Semester</label>
        <select name="semester_id" class="form-control" required>
            <option value="">-- Pilih Semester --</option>
            @foreach ($semester as $s)
                <option value="{{ $s->id }}" @if ($s->id == $tugas->semester_id) selected @endif>
                    {{ $s->nama_semester }}
                </option>
            @endforeach
        </select>
    </div>

     <div class="mb-3">
        <label for="tahun_ajaran">Tahun Ajaran</label>
        <select name="tahun_ajaran" class="form-control" required>
            <option value="">-- Pilih tahun ajaran --</option>
            @foreach ($semester as $s)
                <option value="{{ $s->tahun_ajaran }}" @if ($s->tahun_ajaran == $tugas->tahun_ajaran) selected @endif>
                    {{ $s->tahun_ajaran }}
                </option>
            @endforeach
        </select>
    </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('tugas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
