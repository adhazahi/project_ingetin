<x-app-layout>
    {{-- Header Slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Study Timer (Pomodoro)') }}
        </h2>
    </x-slot>

    {{-- Konten Utama (Slot Default) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- KONTEN UTAMA TIMER DIMULAI DI SINI --}}
            <div class="container mx-auto px-4 py-8">
                <h2 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Study Timer <span class="text-blue-600">Pro</span></h2>

                {{-- KONTEN UTAMA: TIMER DAN DAFTAR TUGAS DALAM GRID --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    {{-- 1. BAGIAN STUDY TIMER (Memakan 2 Kolom) --}}
                    <div class="lg:col-span-2 flex flex-col items-center">
                        <div id="timer-app" class="p-10 rounded-3xl shadow-2xl border bg-white transform transition-all duration-500 ease-in-out w-full max-w-lg lg:max-w-none">
                            
                            {{-- MODE SELECTION TABS --}}
                            <div id="mode-selector" class="flex justify-center mb-8 bg-gray-100 rounded-full p-1 shadow-inner">
                                <button data-mode="focus" class="mode-tab px-6 py-2 rounded-full text-lg font-semibold transition duration-200">Pomodoro</button>
                                <button data-mode="shortBreak" class="mode-tab px-6 py-2 rounded-full text-lg font-semibold transition duration-200">Short Break</button>
                                <button data-mode="longBreak" class="mode-tab px-6 py-2 rounded-full text-lg font-semibold transition duration-200">Long Break</button>
                            </div>
                            
                            {{-- Status / Description --}}
                            <div class="text-center mb-8">
                                <h3 id="mode-status" class="text-3xl font-bold tracking-wide transform transition-all duration-300 ease-in-out text-gray-800">FOKUS</h3>
                                <p id="mode-description" class="text-md mt-2 text-gray-600">Waktunya untuk fokus dan produktif!</p>
                            </div>

                            <div class="flex items-center justify-center">
                                <span id="timer-display" class="text-8xl font-extrabold text-gray-900 tracking-tighter block leading-none w-full text-center transform transition-all duration-300 ease-in-out scale-100">
                                    25:00
                                </span>
                            </div>
                            
                            {{-- Tombol Kontrol --}}
                            <div class="flex justify-center space-x-6 mt-10">
                                <button id="start-pause-btn" 
                                        class="flex items-center justify-center px-8 py-4 text-white font-bold text-xl rounded-full 
                                               shadow-lg transition transform hover:scale-105 duration-200">
                                    <i class="fas fa-play mr-3"></i>
                                    Mulai
                                </button>
                                
                                <button id="reset-btn" 
                                        class="flex items-center justify-center px-8 py-4 bg-gray-300 text-gray-800 font-bold text-xl rounded-full 
                                               shadow-lg hover:bg-gray-400 active:bg-gray-500 transition transform hover:scale-105 duration-200">
                                    <i class="fas fa-redo-alt mr-3"></i>
                                    Reset
                                </button>
                            </div>
                            
                        </div>
                        <p class="text-sm text-gray-500 mt-4 text-center">
                            Metode Pomodoro: 25 menit fokus, 5 menit jeda singkat, 15-30 menit jeda panjang setelah 4 siklus.
                        </p>
                    </div>

                    {{-- 2. BAGIAN MANAJEMEN TUGAS (Memakan 1 Kolom) --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 h-full flex flex-col">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Daftar Tugas (To-Do)</h3>
                            
                            <form id="task-form" class="flex mb-4 space-x-3">
                                <input type="text" id="new-task-input" placeholder="Apa yang perlu dilakukan hari ini?" required
                                       class="flex-grow rounded-lg border-gray-300 text-lg p-3 shadow-sm hover:border-blue-400 hover:shadow-md focus:border-blue-500 focus:ring-blue-500 transition duration-200">
                                <button type="submit" class="px-5 py-3 bg-indigo-500 text-white font-semibold rounded-lg hover:bg-indigo-600 transition">Tambah</button>
                            </form>

                            <ul id="task-list" class="space-y-3 overflow-y-auto flex-grow">
                                <li class="text-gray-500 text-center py-4">Silakan tambahkan tugas pertama Anda!</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                {{-- Akhir Grid Utama --}}

                {{-- Footer --}}
                <footer class="mt-12 text-center text-gray-500 text-sm">
                    &copy; 2023 Inget.in. Simple & Elegant Study Tool.
                </footer>
            </div>
            {{-- AKHIR KONTEN UTAMA TIMER --}}
            
        </div>
    </div>
</x-app-layout>