<x-app-layout>
    {{-- Header Slot (Menampilkan judul di atas konten utama) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Kuliah Digital') }}
        </h2>
    </x-slot>

    {{-- Konten Utama (Slot Default) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="max-w-6xl mx-auto">
                {{-- Judul Halaman --}}
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Jadwal Kuliah Digital</h2>

                {{-- BAGIAN FORM INPUT (Tambah Jadwal Baru) --}}
                <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                    <h3 class="text-xl font-semibold mb-4">Tambah Jadwal Baru</h3>
                    
                    {{-- Tampilkan pesan success jika ada --}}
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tampilkan error validasi jika ada --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    {{-- Form submission yang terstruktur --}}
                    <form action="{{ route('jadwal.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6" id="scheduleForm">
                        @csrf 
                        
                        {{-- 1. Nama Mata Kuliah --}}
                        <div>
                            <label for="nama_kuliah" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                            <input type="text" name="nama_kuliah" required 
                                value="{{ old('nama_kuliah') }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg p-3 focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                        </div>
                        
                        {{-- 2. Nama Dosen --}}
                        <div>
                            <label for="dosen" class="block text-sm font-medium text-gray-700">Nama Dosen (Opsional)</label>
                            <input type="text" name="dosen" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg p-3 focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                        </div>
                        
                        {{-- 3. Hari --}}
                        <div>
                            <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                            <select name="hari" id="hari" required 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg p-3 focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                                {{-- Options diisi di sini --}}
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <option value="{{ $day }}" {{ old('hari') == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- 4. Waktu Mulai --}}
                        <div>
                            <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai <span class="text-xs text-gray-500">(HH:MM - 24 Jam)</span></label>
                            <input type="time" name="waktu_mulai" required 
                                value="{{ old('waktu_mulai') }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg p-3 focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                        </div>
                        
                        {{-- 5. Waktu Selesai --}}
                        <div>
                            <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai <span class="text-xs text-gray-500">(HH:MM - 24 Jam)</span></label>
                            <input type="time" name="waktu_selesai" required 
                                value="{{ old('waktu_selesai') }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg p-3 focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                        </div>
                        
                        {{-- 6. Ruangan --}}
                        <div>
                            <label for="ruangan" class="block text-sm font-medium text-gray-700">Ruangan</label>
                            <input type="text" name="ruangan" required 
                                value="{{ old('ruangan') }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-lg p-3 focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                        </div>

                        {{-- Tombol Simpan (Span 3 Kolom) --}}
                        <div class="md:col-span-3 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-150 ease-in-out font-semibold">Simpan Jadwal</button>
                        </div>
                    </form>
                </div>

                {{-- BAGIAN JADWAL TERSIMPAN --}}
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Jadwal Tersimpan</h3>
                    
                    @if($schedules->isEmpty())
                        <p class="text-gray-500 text-center py-4">Belum ada jadwal kuliah yang tersimpan.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari & Waktu</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                        <th class="px-6 py-3"></th> {{-- Aksi --}}
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($schedules as $schedule)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $schedule->nama_kuliah }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $schedule->dosen ?? '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="font-semibold">{{ $schedule->hari }}</span>
                                                ({{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->waktu_selesai)->format('H:i') }})
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $schedule->ruangan }}</td>
                                            
                                            {{-- Tombol Hapus --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="{{ route('jadwal.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal {{ $schedule->nama_kuliah }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            {{-- Akhir Konten Jadwal Kuliah --}}
            
        </div>
    </div>
    
    <script>
        // Script untuk input time tetap diletakkan di sini
        document.addEventListener('DOMContentLoaded', function() {
            const timeInputs = document.querySelectorAll('input[type="time"]');
            timeInputs.forEach(input => {
                input.setAttribute('step', '60'); 
                input.setAttribute('placeholder', 'HH:MM'); 
            });
        });
    </script>
</x-app-layout>