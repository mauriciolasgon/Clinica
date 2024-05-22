import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: '0.0.0.0',  // Permite que o Vite seja acessado externamente
        port: 3000,       // Define a porta que o Vite usará
        strictPort: true, // Garante que a porta especificada seja usada
        hmr: {
          host: 'localhost', // O host que o HMR usará
          port: 3000,        // A porta que o HMR usará
        },
        watch: {
          usePolling: true,
        },
      },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
