module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      backgroundColor: theme => ({
        ...theme('colors'),
        'storm': '#051821',
       }),
    },
  },
  plugins: [],
}
