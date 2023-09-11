import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel(["resources/css/app.css", "resources/js/app.js"], {
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    // server: {
    //     hmr: {
    //         host: "http://localhost",
    //     },
    // },
    // build: {
    //     rollupOptions: {
    //         output: {
    //             entryFileNames: `assets/[name].js`,
    //             chunkFileNames: `assets/[name].js`,
    //             assetFileNames: `assets/[name].[ext]`,
    //         },
    //     },
    // },
});
