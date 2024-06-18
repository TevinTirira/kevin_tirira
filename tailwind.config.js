/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./kevin_tirira/public/**/*.{html,js,php}"],
  theme: {
    extend: {},
  },
  plugins: [
  require('@tailwindcss/forms'),],
}