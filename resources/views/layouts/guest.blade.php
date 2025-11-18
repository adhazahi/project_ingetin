<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50"> 
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
        
        <!-- <div>
            <a href="{{ route('welcome') }}" class="inline-flex items-center space-x-2">
                <i class="fas fa-graduation-cap text-4xl text-blue-600"></i>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Inget.<span class="text-blue-600">in</span>
                </h1>
            </a>
        </div> -->

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-lg">
        {{-- ^^^^^^^^^^^^ Ubah bg-dark menjadi bg-white/shadow-xl --}}
            {{ $slot }}
        </div>
    </div>
</body>
</html>
