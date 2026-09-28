<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Mapel;
use Illuminate\Http\Request;

class NilaiApiController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = Kelas::all();
        $semesterList = Semester::all();
        $mapelList = Mapel::all();

        $siswas = collect();
        $tugas = collect();
        $nilaiList = collect();

        // Tahun ajaran dari tabel siswa
        $tahunList = Siswa::select('tahun_ajaran')
            ->distinct()
            ->pluck('tahun_ajaran');

        $kelas_id = $request->kelas_id;
        $semester_id = $request->semester_id;
        $tahun_ajaran = $request->tahun_ajaran;
        $mapel_id = $request->mapel_id;

        /*
        |--------------------------------------------------------------------------
        | Jika filter sudah lengkap
        |--------------------------------------------------------------------------
        */

        if ($kelas_id && $semester_id && $tahun_ajaran && $mapel_id) {

            // Ambil siswa berdasarkan filter
            $siswas = Siswa::where('kelas_id', $kelas_id)
                ->where('semester_id', $semester_id)
                ->where('tahun_ajaran', $tahun_ajaran)
                ->get();

            // Ambil tugas berdasarkan filter
            $tugas = Tugas::where('kelas_id', $kelas_id)
                ->where('semester_id', $semester_id)
                ->where('tahun_ajaran', $tahun_ajaran)
                ->where('mapel_id', $mapel_id)
                ->get();

            // Ambil nilai siswa untuk tugas tersebut
            $nilaiList = Nilai::whereIn(
                    'siswa_id',
                    $siswas->pluck('id')
                )
                ->whereIn(
                    'tugas_id',
                    $tugas->pluck('id')
                )
                ->get()
                ->keyBy(function ($item) {
                    return $item->siswa_id . '_' . $item->tugas_id;
                });
        }

        return response()->json([
            'kelasList' => $kelasList,
            'semesterList' => $semesterList,
            'mapelList' => $mapelList,
            'tahunList' => $tahunList,

            'siswas' => $siswas,
            'tugas' => $tugas,
            'nilaiList' => $nilaiList,

            'filter' => [
                'kelas_id' => $kelas_id,
                'semester_id' => $semester_id,
                'tahun_ajaran' => $tahun_ajaran,
                'mapel_id' => $mapel_id,
            ],
        ]);
    }


    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Format request:
        |
        | nilai[
        |     siswa_id[
        |         tugas_id => nilai
        |     ]
        | ]
        |
        |--------------------------------------------------------------------------
        */

        foreach ($request->nilai as $siswa_id => $nilaiTugas) {

            foreach ($nilaiTugas as $tugas_id => $nilai) {

                $nilai = $nilai ?? 0;

                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswa_id,
                        'tugas_id' => $tugas_id,
                    ],
                    [
                        'nilai' => $nilai,
                    ]
                );
            }
        }

        return response()->json([
            'message' => 'Nilai berhasil disimpan',
        ], 200);
    }
}