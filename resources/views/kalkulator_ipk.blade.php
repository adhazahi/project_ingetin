<x-app-layout>
    {{-- Header Slot (Menampilkan judul di atas konten utama) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kalkulator IPK') }}
        </h2>
    </x-slot>

    {{-- Konten Utama (Slot Default) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="max-w-4xl mx-auto">
                {{-- Judul Halaman --}}
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Kalkulator IPK</h2>

                <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                    <h3 class="text-xl font-semibold mb-4">Input Mata Kuliah (MK)</h3>
                    
                    <table class="min-w-full divide-y divide-gray-200" id="ipkTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama MK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">SKS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Nilai Huruf</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-10">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Baris MK akan diisi otomatis oleh JavaScript --}}
                        </tbody>
                    </table>
                    
                    <div class="mt-4 flex justify-between items-center">
                        <button id="addCourseBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            + Tambah Mata Kuliah
                        </button>
                    </div>
                </div>

                {{-- Bagian Hasil Perhitungan --}}
                <div class="bg-gray-100 p-6 rounded-lg shadow-inner">
                    <h3 class="text-xl font-semibold text-gray-700 mb-3">Hasil Indeks Prestasi (IPS)</h3>
                    <p class="text-4xl font-extrabold text-blue-700" id="resultIPK">0.00</p>
                    <p class="text-sm text-gray-500 mt-2">IPK Kumulatif (akumulasi dari semua MK yang dimasukkan).</p>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>