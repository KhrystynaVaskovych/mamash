module.exports = {
    important: true,
    theme: {
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
        },
        stroke: theme => ({
         // current: 'currentColor',
         white: theme('colors.white'),
         gray : theme('colors.text-gray-dark'),
         // 'blue': theme('colors.blue.500'),
       }),

        fontFamily: {
            sans: [
                'Lora',
            ],
            serif: ['Montserrat'],
        },
        fontSize: {
            xs: '0.75rem',
            sm: '0.875rem',
            base: '1rem',
            lg: '1.125rem',
            xl: '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '4rem',
            '7xl': '5rem',
        },

        borderWidth: {
            default: '1px',
            '0': '0',
            '2': '2px',
            '4': '4px',
        },
        height: {
            px: '1px',
            '0': '0',
            '1': '0.25rem',
            '2': '0.5rem',
            '3': '0.75rem',
            '4': '1rem',
            '5': '1.25rem',
            '6': '1.5rem',
            '8': '2rem',
            '10': '2.5rem',
            '12': '3rem',
            '16': '4rem',
            '20': '5rem',
            '24': '6rem',
            '32': '8rem',
            '40': '10rem',
            '48': '12rem',
            '56': '14rem',
            '64': '16rem',
            '96': '20rem',
            '112': '28rem',
            '120': '30rem',
            '132': '34rem',
        },

        extend: {
            colors: {
                'gray': '#242424',
                'gray-dark': '#212121',
                'gray-dark-light': '#2f2f2f',
                'gray-dark-grey': '#353535',
                'gray-silver': '#747474',
                'gray-cloud': '#969696',
                'gray-light': '#a3a3a3',
                'gray-snow': '#e8e8e8',
                'gray-dim': '#686868',
                yellow: '#dfa46d',
                'yellow-unclean': '#352e27',
                'rosy-brown': '#bc786b',
                white: '#fff',
                'orange-light': "#f5f5f5",
                orange: "#ea9f57",
                scarlet: '#f91154',
            },
            spacing: {
                '96': '24rem',
                '128': '32rem',
            }
        },
    },
    variants: {
        width: ['responsive', 'focus'],
    },
}