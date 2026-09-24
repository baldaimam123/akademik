<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = ['nama_tugas', 'mapel_id', 'kelas_id', 'semester_id', 'tahun_ajaran'];

    public function mapel() {
        return $this->belongsTo(Mapel::class);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function semester() {
        return $this->belongsTo(Semester::class);
    }
}

