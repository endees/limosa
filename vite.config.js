import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/responsive.css',
                'resources/css/colorvariants/colorscheme-1.css',
                'resources/js/app.js',
                'resources/js/custom.js',
            ],
            refresh: true,
        }),
        vue()
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    },
});
