<x-guest-layout>
    
    {{-- Branding Inget.in di atas form --}}
    <div class="text-center mb-8">
        <a href="{{ route('welcome') }}" class="inline-flex items-center space-x-2">
            <i class="fas fa-graduation-cap text-4xl text-blue-600"></i>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                Inget.<span class="text-blue-600">in</span>
            </h1>
        </a>
        <p class="mt-2 text-gray-600">Silakan masuk untuk mengakses fitur Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" 
                          class="block mt-1 w-full border-gray-300 bg-white placeholder-gray-500 text-gray-900 p-3 text-lg" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" 
                          class="block mt-1 w-full border-gray-300 bg-white placeholder-gray-500 text-gray-900 p-3 text-lg" 
                          type="password" 
                          name="password" 
                          required 
                          autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember Me & Forgot Password --}}
        <div class="mt-4 flex justify-between items-center"> 
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        {{-- Tombol Login --}}
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 mr-4" href="{{ route('register') }}">
                {{ __('Belum punya akun?') }}
            </a>
            
            <x-primary-button class="ml-3 px-6 py-3 bg-blue-600 hover:bg-blue-700">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>