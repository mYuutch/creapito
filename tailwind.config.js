import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'aptly' : ['Aptly', 'sans-serif'],
                'neulis' : ['Neulis','sans-serif']
            },
            fontWeight: {
                'regular' : 400,
                'medium' : 500,
                'bold' : 600,
                'extrabold' : 700,
                'black' : 800
            }
        },
    },

    plugins: [forms, typography],
};
