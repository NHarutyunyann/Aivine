const mix = require('laravel-mix')
require('dotenv').config()

// ADMIN
mix.js('resources/js/admin/admin.js', 'public/dist/admin/js')
    .vue()
    .sass('resources/sass/admin/app.scss', 'public/dist/admin/css/main.css')

// FRONT
mix.options({
    processCssUrls: false
});

mix.js(`resources/js/front/front.js`, 'public/dist/front/js').vue()

mix.js(`resources/js/front/main.js`, 'public/dist/front/js');

mix.webpackConfig({
    stats: {
        children: true,
    },
});
