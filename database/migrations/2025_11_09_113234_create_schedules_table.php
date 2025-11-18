<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            
            // Kolom Wajib 1: Foreign Key User ID
            // constrained() dan onDelete('cascade') otomatis membuatnya NOT NULL
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Kolom Data Jadwal
            $table->string('nama_kuliah');
            $table->string('dosen')->nullable(); // Boleh kosong
            $table->string('hari');
            $table->time('waktu_mulai'); 
            $table->time('waktu_selesai');
            $table->string('ruangan');
            
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};