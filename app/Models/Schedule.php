<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    
    // SEMUA KOLOM YANG AKAN DIISI MELALUI FORM HARUS ADA DI SINI.
    // Jika tidak, Laravel akan memblokirnya (Mass Assignment) dan database Anda menerima NULL.
    protected $fillable = [
        'user_id', 
        'nama_kuliah',
        'dosen',
        'hari',
        'waktu_mulai', 
        'waktu_selesai',
        'ruangan', 
    ];

    /**
     * Get the user that owns the Schedule.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}