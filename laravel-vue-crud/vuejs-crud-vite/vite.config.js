import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        // laravel({
        //     input: ['resources/css/app.css', 'resources/js/app.js'],
        //     refresh: true,
        // }),
        vue()
    ],
    resolve:{
        alias:{
            '@': '/resources/js',
        },
    },
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
          input: '/resources/js/app.js',
        },
      },
    server:{
        host: '0.0.0.0',
    },
});
