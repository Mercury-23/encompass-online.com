import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // base: process.env.NODE_ENV === 'production' ? '/assets/' : '/',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin.index.css',
                'resources/css/home.css',

                // 'resources/css/dashboard.css',
                // 'resources/css/scheduler.css',
                // 'resources/css/messages.css',
                // 'resources/css/rooms.css',

                'resources/js/app.js',
                'resources/js/utils.js',

                'resources/js/admin/admin.index.js',
                'resources/js/admin/instruments.js',
                'resources/js/admin/invoices.js',
                'resources/js/admin/lessons.js',

                'resources/js/admin/parents.index.js',
                'resources/js/admin/students.index.js',
                'resources/js/admin/teachers.index.js',
                'resources/js/admin/users.index.js',

                // 'resources/js/admin/rooms.index.js',
            ],
            refresh: true,
        }),
    ],
});
