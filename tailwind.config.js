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
                // sans: ["Montserrat", "sans-serif"],
            },

            backgroundColor: {
                tertiary: '#7A8DA5',
                primary: '#252B42',
                secondary: '#23A6F0',
                redIconColor: "#E74040"
            }
        },
    },

    plugins: [forms],
};
