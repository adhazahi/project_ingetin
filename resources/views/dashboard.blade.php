<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Inget.in') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Hero Section --}}
                <div class="text-center py-8 mb-8 bg-gray-50 rounded-xl border border-gray-200">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-lg text-gray-600 mt-2 max-w-xl mx-auto font-medium">
                        Akses fitur utama Anda di bawah ini. Data Anda aman dan tersimpan.
                    </p>
                </div>
            
                {{-- Fitur Utama Grid (Minimalis & Colorful) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                    
                    {{-- 1. Kartu Study Timer (Warna Merah) --}}
                    <a href="{{ route('timer') }}" 
                       class="group block rounded-2xl overflow-hidden shadow-xl 
                              transform hover:shadow-2xl hover:scale-[1.03] transition duration-300 ease-in-out border-4 border-transparent hover:border-red-500">
                        <div class="p-8 text-center bg-white h-full flex flex-col justify-center">
                            <div class="text-red-600 mb-4 transition duration-300 group-hover:text-red-700">
                                <i class="fas fa-clock text-6xl"></i>
                            </div>
                            <h3 class="text-3xl font-extrabold text-gray-800 mb-2">Timer Pomodoro</h3>
                            <p class="text-sm text-gray-500 mt-2">Fokus 25 Menit. Kelola produktivitas Anda.</p>
                        </div>
                    </a>

                    {{-- 2. Kartu Jadwal Kuliah (Warna Hijau) --}}
                    <a href="{{ route('jadwal.index') }}" 
                       class="group block rounded-2xl overflow-hidden shadow-xl 
                              transform hover:shadow-2xl hover:scale-[1.03] transition duration-300 ease-in-out border-4 border-transparent hover:border-green-500">
                        <div class="p-8 text-center bg-white h-full flex flex-col justify-center">
                            <div class="text-green-600 mb-4 transition duration-300 group-hover:text-green-700">
                                <i class="fas fa-calendar-alt text-6xl"></i>
                            </div>
                            <h3 class="text-3xl font-extrabold text-gray-800 mb-2">Jadwal Kuliah</h3>
                            <p class="text-sm text-gray-500 mt-2">Atur dan lihat jadwal mingguan Anda.</p>
                        </div>
                    </a>

                    {{-- 3. Kartu Kalkulator IPK (Warna Biru) --}}
                    <a href="{{ route('ipk') }}" 
                       class="group block rounded-2xl overflow-hidden shadow-xl 
                              transform hover:shadow-2xl hover:scale-[1.03] transition duration-300 ease-in-out border-4 border-transparent hover:border-blue-500">
                        <div class="p-8 text-center bg-white h-full flex flex-col justify-center">
                            <div class="text-blue-600 mb-4 transition duration-300 group-hover:text-blue-700">
                                <i class="fas fa-calculator text-6xl"></i>
                            </div>
                            <h3 class="text-3xl font-extrabold text-gray-800 mb-2">Hitung IPK</h3>
                            <p class="text-sm text-gray-500 mt-2">Kalkulasi IPS/IPK instan tanpa login.</p>
                        </div>
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>