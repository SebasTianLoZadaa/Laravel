import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/resources/css/app.css', 'resources/resources/js/app.js'],
            refresh: true,
        }),
    ],
});
