/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    'node_modules/flowbite/**/*.js',
    'node_modules/daisyui/**/*.js',
  ],
  theme: {
    extend: {
      backgroundImage: {  
        'bg-awal': "url('../resources/assets/image/background/bg-awal.png')",  
      },
      colors: {
        'custom-bg': '#FBF8F6',
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
        'inter': ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('daisyui'),
    require('flowbite/plugin')({
      charts: true,
    }),
    function({ addBase, theme }) {
      addBase({
        'body': {
          backgroundColor: theme('colors.custom-bg'),
        },
      })
    },
  ],
}

