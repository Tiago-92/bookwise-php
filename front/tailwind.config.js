/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}"
  ],
  theme: {
    colors: {
      'green-1#': '#50B2C0',
      'green-2#': '#255D6A',
      'green-3#': '#0A313C',

      'purple-1#': '#8381D9',
      'purple-2#': '#2A2879',

      'gray-1#': '#F8F9FC',
      'gray-2#': '#E6E8F2',
      'gray-3#': '#D1D6E4',
      'gray-4#': '#8D95AF',
      'gray-5#': '#303F73',
      'gray-6#': '#252D4A',
      'gray-7#': '#181C2A',
      'gray-8#': '#0E1116',
    },
    extend: {
      boxShadow: {
        '3xl': '0 0 10px #8D95AF',
      },
    },
  },
  plugins: [],
}
