import laravel from 'laravel-vite-plugin';
import Vue from '@vitejs/plugin-vue';

export default {
    plugins: [
        Vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/admin/main.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@vuelidate/core': '@vuelidate/core',
        },
    },
    optimizeDeps: {
        include: ['bootstrap', '@poppers/core']
    }
}
