<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasApiController extends Controller
{
     public function index()
    {
        $kelas = Kelas::all();
        return response()->json([
            'kelas' => $kelas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::create($request->all());
        return response()->json([
            'message' => 'Kelas berhasil ditambahkan',
            'kelas' => $kelas
        ],201);
    }

     public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        return response()->json([
            'message' => 'Kelas berhasil diperbarui',
            'kelas' => $kelas
        ],200);
    }


     public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return response()->json([
            'message' => 'Kelas berhasil dihapus'
        ],200);
    }
}
