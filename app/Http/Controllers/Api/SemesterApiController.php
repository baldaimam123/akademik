<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterApiController extends Controller
{
    // GET /api/semester
    public function index()
    {
        $semester = Semester::all();

        return response()->json([
            'semester' => $semester
        ]);
    }

    // POST /api/semester
    public function store(Request $request)
{
    $request->validate([
        'nama_semester' => 'required|string|max:255',
        'tahun_ajaran' => 'required|string|max:20',
    ]);

    $semester = Semester::create([
        'nama_semester' => $request->nama_semester,
        'tahun_ajaran' => $request->tahun_ajaran,
    ]);

    return response()->json([
        'message' => 'Semester berhasil ditambahkan',
        'semester' => $semester,
    ], 201);
}

    // PUT /api/semester/{id}
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_semester' => 'required|string|max:255',
        'tahun_ajaran' => 'required|string|max:20',
    ]);

    $semester = Semester::findOrFail($id);

    $semester->update([
        'nama_semester' => $request->nama_semester,
        'tahun_ajaran' => $request->tahun_ajaran,
    ]);

    return response()->json([
        'message' => 'Semester berhasil diubah',
        'semester' => $semester,
    ], 200);
}
    // DELETE /api/semester/{id}
    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);

        $semester->delete();

        return response()->json([
            'message' => 'Semester berhasil dihapus',
        ], 200);
    }
}