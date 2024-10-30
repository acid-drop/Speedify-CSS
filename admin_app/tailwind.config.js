/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx,html}",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      screens: {
        'xxl': '1436px', // custom breakpoint at 1436px
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ]
}