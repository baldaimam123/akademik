<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'semesters';

    // Tentukan kolom yang boleh diisi
    protected $fillable = [
        'nama_semester', // contoh: 'Ganjil' atau 'Genap'
        'tahun_ajaran',  // contoh: '2025/2026'
    ];
}
