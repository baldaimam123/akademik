<?php

namespace App\Http\Controllers;
// app/Http/Controllers/MapelController.php
namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::all();
        return view('mapel.index', compact('mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'guru_mapel' => 'required|string|max:255',
        ]);

        Mapel::create($request->all());
        return redirect()->back()->with('success', 'Data mapel berhasil ditambahkan.');
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'guru_mapel' => 'required|string|max:255',
        ]);

        $mapel->update($request->all());
        return redirect()->back()->with('success', 'Data mapel berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->back()->with('success', 'Data mapel berhasil dihapus.');
    }
}
