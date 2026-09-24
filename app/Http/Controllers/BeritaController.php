<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::all();
        return view('berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // Debugging line to check the request data
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Validate image file
            'penulis' => 'required',
            'tanggal' => 'required|date',
            'kategori' => 'required',
        ]);

        // dd('lolos validasi'); // Debugging line to check if validation passes

        $imagename = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'), $imagename);
        
        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $imagename,
            'penulis' => $request->penulis,
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'dibaca' => 0, // Set default value for 'dibaca'
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Validate image file
            'penulis' => 'required',
            'tanggal' => 'required|date',
            'kategori' => 'required',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if($berita->gambar && file_exists(public_path('images/' . $berita->gambar))) {
                unlink(public_path('images/' . $berita->gambar)); // Delete old image
            }
            $imagename = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imagename);
            $berita->gambar = $imagename; // Update with new image name
        }

        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->penulis = $request->penulis;
        $berita->tanggal = $request->tanggal;
        $berita->kategori = $request->kategori;
        // Note: You might want to handle the 'dibaca' field separately if needed

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
