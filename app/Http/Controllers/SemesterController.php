<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
public function index()
{
    $semesters = Semester::all();
    return view('semester.index', compact('semesters'));
}

public function store(Request $request)
{
    $request->validate([
        'nama_semester' => 'required|in:Ganjil,Genap',
        'tahun_ajaran' => 'required|string|max:20|regex:/^\d{4}\/\d{4}$/',
    ],[
        'tahun_ajaran.regex' => 'Format tahun ajaran harus berupa "YYYY/YYYY".',
    ]);

    Semester::create($request->all());
    return redirect()->route('semester.index')->with('success', 'Semester berhasil ditambahkan');
}

public function update(Request $request, Semester $semester)
{
    $request->validate([
        'nama_semester' => 'required|in:Ganjil,Genap',
        'tahun_ajaran' => 'required|string|max:20',
    ]);

    $semester->update($request->all());
    return redirect()->route('semester.index')->with('success', 'Semester berhasil diperbarui');
}

public function destroy(Semester $semester)
{
    $semester->delete();
    return redirect()->route('semester.index')->with('success', 'Semester berhasil dihapus');
}
}