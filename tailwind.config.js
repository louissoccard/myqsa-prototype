const colors = require('tailwindcss/colors');

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

            'purple-darkened': '#3a0a6e',
            'teal-darkened': '#00a794',
            'red-darkened': '#711709',
            'pink-darkened': '#805a73',
            'green-darkened': '#125528',
            'navy-darkened': '#001d41',
            'blue-darkened': '#003770',
            'yellow-darkened': '#807314',
            'grey-5-darkened': '#797979',
            'grey-20-darkened': '#cccccc',
            'grey-40-darkened': '#666666',
            'grey-60-darkened': '#333333',
            'grey-80-darkened': '#1a1a1a',

        },

        extend: {
            minWidth: {
                '80': '20rem',
            },

            maxWidth: {
                'xxs': '10rem',
                '2/5': '40%',
                '1/2': '50%',
                '9/10': '90%',
            },

            fontFamily: {
                sans: ['"Nunito Sans"', 'sans-serif'],
            },

            transitionProperty: {
                'border-color': 'border-color',
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },
};
