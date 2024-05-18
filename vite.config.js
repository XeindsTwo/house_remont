import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/style.css',
        'resources/js/app.js',
        'resources/js/components/accordion.js',
        'resources/js/components/modal-functions.js',
        'resources/js/components/password.js',
        'resources/js/components/phone-mask.js',
        'resources/js/components/price-mask.js',
        'resources/js/profile/update-avatar.js',
        'resources/js/profile/update-data.js',
        'resources/js/profile/update-password.js',
        'resources/js/work/create.js',
        'resources/js/work/update.js',
        'resources/js/bootstrap.js',
        'resources/js/company.js',
        'resources/js/cost.js',
        'resources/js/register.js',
        'resources/js/review.js',
      ],
      refresh: true,
    }),
  ],
});