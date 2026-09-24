<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas'; // ✅ tambahkan ini jika nama tabel adalah 'berita'
    protected $fillable = ['judul', 'isi', 'gambar', 'penulis', 'tanggal', 'kategori', 'dibaca'];
}
