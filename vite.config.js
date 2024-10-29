// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import path from 'path';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/scss/app.scss',
//                 'resources/js/app.js',
//             ],
//             refresh: true,
//         }),
//     ],
//     css: {
//         preprocessorOptions: {
//             scss: {
//                 api: 'modern-compiler',
//             }
//         }
//     },
// });

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/scss/app.scss',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
  css: {
    preprocessorOptions: {
      scss: {
        additionalData: '@use "resources/scss/base/_variables.scss" as *;',
      }
    },
    postcss: {
      plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
      ],
    }
  },
  resolve: {
    alias: {
      '~': path.resolve(__dirname, 'node_modules'),
    },
  },
});
