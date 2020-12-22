const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: "class",

    theme: {
        colors: {
            'transparent': 'transparent',
            'gray': colors.trueGray,
            'purple': '#7413dc',
            'teal': '#00a794',
            'black': '#000000',
            'white': '#ffffff',
            'section-green': '#004851',
            'red': '#e22e12',
            'pink': '#ffb4e5',
            'green': '#23a950',
            'navy': '#003982',
            'blue': '#006ddf',
            'yellow': '#ffe627',
            'grey-5': '#f2f2f2',
            'grey-20': '#cccccc',
            'grey-40': '#999999',
            'grey-60': '#666666',
            'grey-80': '#333333',
        },

        extend: {
            fontFamily: {
                sans: ['"Nunito Sans"', 'sans-serif'],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },
};
