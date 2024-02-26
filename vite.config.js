import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import AutoImport from 'unplugin-auto-import/vite';
import IconsResolver from 'unplugin-icons/resolver';
import Icons from 'unplugin-icons/vite';
import Components from 'unplugin-vue-components/vite';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
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
        AutoImport({
            imports: [
              'vue',
              {
                '@inertiajs/vue3': [
                  'router',
                  'usePage',
                  'useForm',
                  'Link',
                  'Inertia'
                ]
              }
            ]
          }),
          Components({
            dirs: [
                './resources/js/Components',
              './resources/js/Layouts',
              './resources/js/Pages',
              './resources/js/Pages/Auth',
              './resources/js/Pages/Profile',
              './resources/js/Pages/Profile/Partials',
            ],
            extensions: [
              'vue'
            ],
            directoryAsNamespace: true,
            deep: true,
            resolvers: [
              IconsResolver(),
              (name) => {
                if (name === 'Head') {
                  return {
                    importName: 'Head',
                    path: '@inertiajs/vue3'
                  }
                }

                if (name === 'Link') {
                  return {
                    importName: 'Link',
                    path: '@inertiajs/vue3'
                  }
                }
              }
            ]
          }),
          Icons({
            autoInstall: true
          }),

    ],
});
