<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(Request $request)
    {
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $semester = Semester::all();
        $tahunList = Tugas::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        $query = Tugas::with(['mapel', 'kelas', 'semester']);

        if ($request->filled(['mapel_id', 'kelas_id', 'semester_id', 'tahun_ajaran'])) {
            $query->where('mapel_id', $request->mapel_id)
                  ->where('kelas_id', $request->kelas_id)
                  ->where('semester_id', $request->semester_id)
                  ->where('tahun_ajaran', $request->tahun_ajaran);
        }

        $tugas = $query->get();

        return view('tugas.index', compact('mapel', 'kelas', 'semester', 'tugas', 'request', 'tahunList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'semester_id' => 'required',
            'tahun_ajaran' => 'required'
        ]);
        // $masuk = [
        //     'nama_tugas' => $request->input('nama_tugas'),
        //     'mapel_id' => $request->input('mapel_id'),
        //     'kelas_id' => $request->input('kelas_id'),
        //     'semester_id' => $request->input('semester_id'),
        //     'tahun_ajaran' => $request->input('tahun_ajaran'),
        // ];

        // Tugas::create($masuk);
        Tugas::create($request->all());
        return back()->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Tugas $tugas, $id)
    {
        $tugas = Tugas::with('kelas','semester')->findOrFail($id);

        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('tugas.edit', compact('tugas', 'mapel', 'kelas', 'semester'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nama_tugas' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'semester_id' => 'required',
        //     'tahun_ajaran' => 'required'
        // ]);

        $tugas = Tugas::findOrFail($id);
        // $tugas->nama_tugas = $request->input('nama_tugas');
        // $tugas->kelas_id = $request->input('kelas_id');
        // $tugas->semester_id = $request->input('semester_id');
        // $tugas->tahun_ajaran = $request->input('tahun_ajaran');
        // $tugas->save();

        $tugass = [
            'nama_tugas' => $request->input('nama_tugas'),
            'kelas_id' => $request->input('kelas_id'),
            'semester_id' => $request->input('semester_id'),
            'tahun_ajaran' => $request->input('tahun_ajaran'),
        ];

        $tugas->update($tugass);

        // dd($tugas); // Debugging: Check the contents of the $tugas object
        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diupdate.');
    }
    

    public function destroy(Tugas $tuga)
{
    $tuga->delete();
    return back()->with('success', 'Tugas berhasil dihapus.');
}

}
