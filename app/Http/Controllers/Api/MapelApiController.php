<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelApiController extends Controller
{
    public function index()
    {
        $mapel = Mapel::all();

        return response()->json([
            'mapel' => $mapel
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'guru_mapel' => 'required|string|max:255',
        ]);

        $mapel = Mapel::create([
            'nama_mapel' => $request->nama_mapel,
            'guru_mapel' => $request->guru_mapel,
        ]);

        return response()->json([
            'message' => 'Mapel berhasil ditambahkan',
            'mapel' => $mapel,
        ], 201);
    }

    public function show($id)
    {
        $mapel = Mapel::findOrFail($id);

        return response()->json([
            'mapel' => $mapel
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'guru_mapel' => 'required|string|max:255',
        ]);

        $mapel = Mapel::findOrFail($id);

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'guru_mapel' => $request->guru_mapel,
        ]);

        return response()->json([
            'message' => 'Mapel berhasil diubah',
            'mapel' => $mapel,
        ], 200);
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);

        $mapel->delete();

        return response()->json([
            'message' => 'Mapel berhasil dihapus',
        ], 200);
    }
}