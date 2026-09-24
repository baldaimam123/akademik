<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migration: create_tugas_table.php
Schema::create('tugas', function (Blueprint $table) {
    $table->id();
    $table->string('nama_tugas');
    $table->foreignId('mapel_id')->constrained()->onDelete('cascade');
    $table->foreignId('kelas_id')->constrained()->onDelete('cascade');
    $table->foreignId('semester_id')->constrained()->onDelete('cascade');
    $table->string('tahun_ajaran');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
