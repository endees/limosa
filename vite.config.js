import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/bootstrap.min.css',
                'resources/css/style.css',
                'resources/css/responsive.css',
                'resources/css/colorvariants/colorscheme-1.css',

                'resources/js/app.js',
                'resources/js/twitter/bootstrap.min.js',
                'resources/js/custom.js',
                'resources/js/jquery-3.6.1.min.js'
            ],
            refresh: true,
        }),
    ],
});
