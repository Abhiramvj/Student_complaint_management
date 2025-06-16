import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
          "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
     safelist: [
        'text-yellow-600', 'bg-yellow-100',
        'text-blue-600', 'bg-blue-100',
        'text-violet-600', 'bg-violet-100',
        'text-green-600', 'bg-green-100',
        'text-gray-600', 'bg-gray-100',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
