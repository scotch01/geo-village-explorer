import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'orange': '#FF9F10',
                'descan': {
                    50:  '#FFF8EB',
                    100: '#FFEFC6',
                    200: '#FFD96B',
                    300: '#FFC637',
                    400: '#FFB310',
                    500: '#FF9F10',
                    600: '#E88A00',
                    700: '#CC7400',
                },
                'navy': {
                    500: '#274568ff',
                    600: '#1E4068',
                    700: '#1B3A5C',
                    800: '#152E4A',
                    900: '#0F2240',
                },
            },
        },
    },

    plugins: [forms],
};
