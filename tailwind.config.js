/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.ts",
    "./frontend/**/*.vue",
    "./frontend/**/*.js",
    "./frontend/**/*.ts",
  ],
  theme: {
    extend: {
      container: {
        center: true,
      }
    },
  },
  plugins: [],
}

