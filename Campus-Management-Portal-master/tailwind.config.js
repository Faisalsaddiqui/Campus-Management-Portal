const colors = require("tailwindcss/colors");

module.exports = {

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/*.css"
    ],

    theme: {
        colors: {
            transparent: "transparent",
            current: "currentColor",
            black: colors.black,
            white: colors.white,
            red: colors.red,
            orange: colors.orange,
            yellow: colors.yellow,
            green: colors.green,
            gray: colors.slate,
            indigo: {
                100: "#e6e8ff",
                300: "#b2b7ff",
                400: "#7886d7",
                500: "#6574cd",
                600: "#5661b3",
                800: "#2f365f",
                900: "#191e38"
            }
        }
    },

    variants: {
        extend: {}
    },
    plugins: []
};
