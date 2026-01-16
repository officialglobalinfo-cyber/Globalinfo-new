/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: 'var(--primary)',
                secondary: 'var(--secondary)',
                accent: 'var(--accent)',
                slate: {
                    800: 'var(--secondary)',
                    900: 'var(--secondary)',
                },
                violet: {
                    600: 'var(--primary)',
                    50: '#f0f9ff',
                }
            },
            fontFamily: {
                sans: ['Poppins', 'sans-serif'],
            },
            boxShadow: {
                'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                'glow': '0 0 20px rgba(0, 137, 209, 0.3)',
            }
        },
    },
    plugins: [],
};
