import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */


module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'electric-blue-500': '#373e98',
                'hot-pink-500': '#f16775',
                'shocking-yellow-500': '#fee36e',
                'chartreuse-ish-500': '#ceb92c',
                'darkest-gray-500': '#2a2a2a',
            },
        },
    },
    plugins:
     [require("daisyui")],

    daisyui: {
        themes: ["light", "dark", "cupcake","business"],
    },
}
// export default {
//     content: [
//         './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
//         './storage/framework/views/*.php',
//         './resources/views/**/*.blade.php',
//         "./resources/**/*.blade.php",
//         "./resources/**/*.js",
//         "./resources/**/*.vue",
//     ],
//     theme: {
//         extend: {
//             colors: {
//                 'electric-blue-500': '#373e98',
//                 'hot-pink-500': '#f16775',
//                 'shocking-yellow-500': '#fee36e',
//                 'chartreuse-ish-500': '#ceb92c',
//                 'darkest-gray-500': '#2a2a2a',
//             },
//         },
//     },
//     // ...
// };
