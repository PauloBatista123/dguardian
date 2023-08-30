/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
        fontFamily: {
            body: ["Roboto", "sans-serif"],
        },
        colors: {
            turquesa: "#00AE9D",
            verdeescuro: "#003641",
            verdeclaro: "#c9d200",
            verdemedio: "#7db61c",
            roxo: "#49479d",
            ...colors,
        },
    },
    plugins: [],
};
