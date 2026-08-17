import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      spacing: {
        '4.5': '1.125rem',
        '14.5': '3.625rem',
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
      colors: {
        'premier-velvet': {
          1: '#520A18',
          2: '#68001C',
          3: '#821E38',
          4: '#8C4254',
        },
        'cinematic-midnight': {
          1: '#132C5C',
          2: '#16336D',
          3: '#2B4E94',
          4: '#5876B0',
        },
        'golden-era': {
          1: '#97763A',
          2: '#B09861',
          3: '#CAB988',
          4: '#E3DBAF',
        },
        'romance-retro': {
          1: '#A85C66',
          2: '#CC707C',
          3: '#E58C97',
          4: '#EBA9B0',
        },
      },
    },
  },
  plugins: [],
}
