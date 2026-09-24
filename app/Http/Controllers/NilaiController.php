<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Mapel;

class NilaiController extends Controller
{
    //// app/Http/Controllers/NilaiController.php

public function index(Request $request)
{
    $kelasList = Kelas::all();
    $semesterList = Semester::all();
    $mapelList = Mapel::all();

    $siswas = collect();
    $tugas = collect();
    $nilaiList = collect();
    // Ambil tahun ajaran unik dari tabel siswa
    $tahunList = Siswa::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

    $kelas_id = $request->kelas_id;
    $semester_id = $request->semester_id;
    $tahun_ajaran = $request->tahun_ajaran;
    $mapel_id = $request->mapel_id;

    if ($kelas_id && $semester_id && $tahun_ajaran) {
        $siswas = Siswa::where('kelas_id', $kelas_id)
            ->where('semester_id', $semester_id)
            ->where('tahun_ajaran', $tahun_ajaran)
            ->get();

        $tugas = Tugas::where('kelas_id', $kelas_id)
            ->where('semester_id', $semester_id)
            ->where('tahun_ajaran', $tahun_ajaran)
            ->where('mapel_id', $mapel_id)
            ->get();
        // Jika tugas juga tergantung tahun ajaran, tambahkan: ->where('tahun_ajaran', $tahun_ajaran)

        $nilaiList = Nilai::whereIn('siswa_id', $siswas->pluck('id'))
            ->whereIn('tugas_id', $tugas->pluck('id'))
            ->get()
            ->keyBy(fn ($item) => $item->siswa_id . '_' . $item->tugas_id);
    }

   return view('nilai.index', compact(
        'kelasList', 'semesterList', 'mapelList', 'tahunList',
        'siswas', 'tugas', 'nilaiList', 'kelas_id', 'semester_id', 'mapel_id'
    ));
}




public function store(Request $request)
{
    foreach ($request->nilai as $siswa_id => $nilaiTugas) { #$request->nilai=[<siswa_id> => [<tugas_id> => $nilai]] //request mengambil data dari form nilai berisi key yaitu siswa id dan valuenya nila tgas berissi tugas berapa isal 1,2,3 dan nilai yang dimasukan
        foreach ($nilaiTugas as $tugas_id => $nilai) { #$nilaiTugas=[<tugas_id> => $nilai] terus ambil nlai tugasnya aja berisi tgas 1,2,3 dan nilainya
            $nilai = $nilai ?? 0; //isikan nilainya
    Nilai::updateOrCreate( //updateOrCreate untuk update data jika sudah ada dan create jika belum ada
        ['siswa_id' => $siswa_id, 'tugas_id' => $tugas_id],
        ['nilai' => $nilai]
    );

        }
    }

    return redirect()->back()->with('success', 'Nilai berhasil disimpan');
}

}
