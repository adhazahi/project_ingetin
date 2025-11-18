@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm 
                
                /* KODE BARU HANYA UNTUK TAMPILAN TERANG */
                bg-white text-gray-900'
]) !!}>