// tailwind.config.js

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // Pastikan Tailwind memindai semua file Blade:
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        // Pastikan Tailwind memindai SEMUA file JavaScript, 
        // termasuk study_timer.js yang menambahkan class secara dinamis
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {},
    },

    plugins: [
        // Jika Anda menggunakan forms plugin (direkomendasikan)
        // require('@tailwindcss/forms'),
    ],
};