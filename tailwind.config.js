import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#1E3A5F',
                    50:  '#EEF2F7',
                    100: '#D5E1EE',
                    200: '#ABC3DC',
                    300: '#80A4CA',
                    400: '#5686B9',
                    500: '#2B68A7',
                    600: '#1E3A5F',
                    700: '#163052',
                    800: '#0E2545',
                    900: '#071938',
                },
                accent: '#0369A1',
            },
            fontFamily: {
                sans: ['Sarabun', ...defaultTheme.fontFamily.sans],
                heading: ['Kanit', ...defaultTheme.fontFamily.sans],
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        color: theme('colors.slate.700'),
                        fontFamily: theme('fontFamily.sans'),
                        a: { color: theme('colors.accent'), '&:hover': { color: theme('colors.primary.DEFAULT') } },
                        'h1,h2,h3,h4,h5,h6': { 
                            color: theme('colors.primary.DEFAULT'),
                            fontFamily: theme('fontFamily.heading'),
                        },
                        'th,td': {
                            fontFamily: theme('fontFamily.sans'),
                        },
                    },
                },
            }),
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
