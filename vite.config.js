import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/timepicker.js',
                'resources/js/objectSelector.js',
                'resources/js/numberRedactor.js',
            ],
            refresh: true,
        }),
    ],
});
