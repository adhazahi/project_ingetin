<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Tampilkan daftar jadwal kuliah yang sudah diurutkan (SQLite-Compatible Sorting).
     */
    public function index()
    {
        $dayOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        
        // Ambil jadwal HANYA milik user yang login
        $schedules = auth()->user()->schedules; 

        // Logika sorting Collection
        $schedules = $schedules->map(function ($schedule) use ($dayOrder) {
            $schedule->day_sort_key = array_search($schedule->hari, $dayOrder);
            return $schedule;
        });

        $schedules = $schedules->sortBy(['day_sort_key', 'waktu_mulai'])->values();

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/ScheduleController.php

    public function store(Request $request)
    {
        // 1. Validasi Data LENGKAP untuk SEMUA kolom yang dibutuhkan
        $validatedData = $request->validate([
            'nama_kuliah' => 'required|string|max:255',
            'dosen' => 'nullable|string|max:255', // Termasuk dosen
            'hari' => 'required|string',         // Termasuk hari
            'waktu_mulai' => 'required|date_format:H:i', // Wajib diisi
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai', // Wajib diisi
            'ruangan' => 'required|string|max:255', // Termasuk ruangan
        ]);
        
        // 2. Simpan data (Sekarang $validatedData lengkap)
        auth()->user()->schedules()->create($validatedData);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    } 
}