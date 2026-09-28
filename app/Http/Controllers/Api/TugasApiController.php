<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;

class TugasApiController extends Controller
{
    public function index(Request $request)
    {
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $semester = Semester::all();

        $tahunList = Tugas::select('tahun_ajaran')
            ->distinct()
            ->pluck('tahun_ajaran');

        $query = Tugas::with([
            'mapel',
            'kelas',
            'semester'
        ]);

        if ($request->filled('mapel_id')) {
            $query->where('mapel_id', $request->mapel_id);
        }

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        if ($request->filled('tahun_ajaran')) {
            $query->where('tahun_ajaran', $request->tahun_ajaran);
        }

        $tugas = $query->get();

        return response()->json([
            'tugas' => $tugas,
            'mapel' => $mapel,
            'kelas' => $kelas,
            'semester' => $semester,
            'tahunList' => $tahunList,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'semester_id' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        $tugas = Tugas::create([
            'nama_tugas' => $request->nama_tugas,
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
            'semester_id' => $request->semester_id,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return response()->json([
            'message' => 'Tugas berhasil ditambahkan.',
            'tugas' => $tugas,
        ], 201);
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);

        return response()->json([
            'tugas' => $tugas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tugas' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'semester_id' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        $tugas = Tugas::findOrFail($id);

        $tugas->update([
            'nama_tugas' => $request->nama_tugas,
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
            'semester_id' => $request->semester_id,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return response()->json([
            'message' => 'Tugas berhasil diupdate.',
            'tugas' => $tugas,
        ], 200);
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        $tugas->delete();

        return response()->json([
            'message' => 'Tugas berhasil dihapus.',
        ], 200);
    }
}