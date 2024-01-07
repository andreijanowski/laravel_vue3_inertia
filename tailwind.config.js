const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontSize: {
                'xxs': '11px'
            },
            animation: {
                'spin-fast': 'spin 300ms linear infinite',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
