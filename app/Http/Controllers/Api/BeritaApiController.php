<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaApiController extends Controller
{
    // GET /api/berita
    public function index()
    {
        $berita = Berita::orderBy('tanggal', 'desc')->get();

        return response()->json([
            'berita' => $berita,
        ], 200);
    }

    // POST /api/berita
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'penulis' => 'required',
            'tanggal' => 'required|date',
            'kategori' => 'required',
        ]);

        $imagename = time() . '.' . $request->gambar->extension();

        $request->gambar->move(
            public_path('images'),
            $imagename
        );

        $berita = Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $imagename,
            'penulis' => $request->penulis,
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'dibaca' => 0,
        ]);

        return response()->json([
            'message' => 'Berita berhasil ditambahkan.',
            'berita' => $berita,
        ], 201);
    }

    // GET /api/berita/{id}
    public function show($id)
{
    $berita = Berita::findOrFail($id);

    $berita->dibaca = true;
    $berita->save();

    return response()->json([
        'berita' => $berita
    ], 200);
}

    // POST /api/berita/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'penulis' => 'required',
            'tanggal' => 'required|date',
            'kategori' => 'required',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('gambar')) {

            if (
                $berita->gambar &&
                file_exists(public_path('images/' . $berita->gambar))
            ) {
                unlink(public_path('images/' . $berita->gambar));
            }

            $imagename = time() . '.' . $request->gambar->extension();

            $request->gambar->move(
                public_path('images'),
                $imagename
            );

            $berita->gambar = $imagename;
        }

        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->penulis = $request->penulis;
        $berita->tanggal = $request->tanggal;
        $berita->kategori = $request->kategori;

        $berita->save();

        return response()->json([
            'message' => 'Berita berhasil diperbarui.',
            'berita' => $berita,
        ], 200);
    }

    // DELETE /api/berita/{id}
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if (
            $berita->gambar &&
            file_exists(public_path('images/' . $berita->gambar))
        ) {
            unlink(public_path('images/' . $berita->gambar));
        }

        $berita->delete();

        return response()->json([
            'message' => 'Berita berhasil dihapus.',
        ], 200);
    }
}