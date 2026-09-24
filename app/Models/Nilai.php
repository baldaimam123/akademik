<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai'; // ✅ tambahkan ini jika nama tabel adalah 'nilai'

    protected $fillable = ['siswa_id', 'tugas_id', 'nilai'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function tugas() {
        return $this->belongsTo(Tugas::class);
    }
}

