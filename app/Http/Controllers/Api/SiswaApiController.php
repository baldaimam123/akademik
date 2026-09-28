<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Semester;


class SiswaApiController extends Controller
{
      public function index(Request $request)
{
    $query = Siswa::with('kelas', 'semester');

    if ($request->filled('kelas_id')) {
        $query->where('kelas_id', $request->kelas_id);
    }

    if ($request->filled('semester_id')) {
        $query->where('semester_id', $request->semester_id);
    }

    if ($request->filled('tahun_ajaran')) {
        $query->where('tahun_ajaran', $request->tahun_ajaran);
    }

    $siswa = $query->get();
    $kelas = Kelas::all();
    $semesters = Semester::all();
    $jumlahsiswa = Siswa::count();
    $jumlahsiswas = Siswa::with('kelas')->select('kelas_id')->selectraw('COUNT(*) as total')->groupBy('kelas_id')->get();

    // dd($jumlahsiswas);

    return response()->json([
        'siswa' => $siswa,
        'kelas' => $kelas,
        'semesters' => $semesters,
        'jumlahsiswa' => $jumlahsiswa,
        'jumlahsiswas' => $jumlahsiswas,
    ]); 
}

public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id', // Validasi kelas
            'semester_id' => 'required|exists:semesters,id', // ← tambahkan ini
        'tahun_ajaran' => 'required|string|max:10', // ← dan ini
        ]);

        // Menyimpan data siswa ke dalam database
        $siswa = Siswa::create([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id,
            'semester_id' => $request->semester_id, // ← tambahkan ini
        'tahun_ajaran' => $request->tahun_ajaran, // ← dan ini
        ]);

        return response()->json(['message' => 'Siswa berhasil ditambahkan.', 'data' => $siswa], 201);
    }

    public function edit($id)
    {
        // Ambil data siswa dengan relasi kelas
        $siswa = Siswa::with('kelas')->findOrFail($id);
        // Ambil data kelas untuk dropdown
        $kelas = Kelas::all(); 
        return response()->json(['siswa' => $siswa, 'kelas' => $kelas]);
    }
    

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nisn' => 'required|numeric',  // Pastikan NISN valid
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan', // Pastikan jenis kelamin valid
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'semester_id' => 'required|exists:semesters,id', // ← ini
        'tahun_ajaran' => 'required|string|max:10', // ← ini // Pastikan kelas_id valid dan ada di tabel kelas
        ]);
    
        // Update data siswa berdasarkan input yang diterima dari form
        $siswa->update([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id,
            'semester_id' => $request->semester_id,
        'tahun_ajaran' => $request->tahun_ajaran, // Perbarui kelas_id dengan kelas yang dipilih
        ]);
    
        // Redirect kembali ke halaman index dengan pesan sukses
        return response()->json(['message' => 'Siswa berhasil diperbarui.', 'data' => $siswa], 200);
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return response()->json(['message' => 'Siswa berhasil dihapus.'], 200);
    }

}
