<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Inget.in</title>
    
    {{-- Memuat asset Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Link Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-50 antialiased">
    
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
        
        {{-- Logo dan Nama Brand --}}
        <div class="text-center mb-8">
            <h1 class="text-6xl font-extrabold text-gray-900 tracking-tighter">
                Inget.<span class="text-blue-600">in</span>
            </h1>
            <p class="text-xl text-gray-600 mt-3">Alat bantu belajar yang efektif dan elegan.</p>
        </div>

        {{-- Call to Action Card --}}
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg border border-gray-200">
            
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Mulai Sekarang</h2>
            
            <p class="text-center text-gray-600 mb-6">
                Silakan masuk atau daftar untuk menyimpan dan mengakses jadwal serta data IPK Anda.
            </p>

            <div class="flex flex-col space-y-4">
                {{-- Tombol Login --}}
                <a href="{{ route('login') }}" 
                   class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-lg font-semibold rounded-lg shadow-sm 
                          text-white bg-blue-600 hover:bg-blue-700 transition duration-150">
                    <i class="fas fa-sign-in-alt mr-3"></i> Masuk (Login)
                </a>

                {{-- Tombol Register --}}
                <a href="{{ route('register') }}" 
                   class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-lg font-semibold rounded-lg shadow-sm 
                          text-gray-700 bg-white hover:bg-gray-100 transition duration-150">
                    <i class="fas fa-user-plus mr-3"></i> Daftar Baru (Register)
                </a>
            </div>

            {{-- Link Fitur Tanpa Login --}}
            <div class="mt-8 text-center text-sm">
                 <p class="text-gray-500">Akses cepat tanpa perlu masuk:</p>
                 <a href="{{ route('ipk') }}" class="text-blue-600 hover:text-blue-800 underline transition mx-2">Kalkulator IPK</a>
                 <span class="text-gray-400">|</span>
                 <a href="{{ route('timer') }}" class="text-blue-600 hover:text-blue-800 underline transition mx-2">Study Timer</a>
            </div>
        </div>
        
        {{-- Footer --}}
        <footer class="mt-8 text-center text-gray-500 text-sm">
            &copy; 2025 Inget.in.
        </footer>
    </div>
</body>
</html>