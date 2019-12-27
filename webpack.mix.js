let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.disableNotifications();
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
mix.browserSync({
    proxy: 'http://embria:82',
    host: 'embria',
    //open: 'external',
    open: false,
    notify: false,
    /*proxy: {
        target: 'http://owor:82',
        middleware: [
            {
                route: "/laravel-filemanager",
                handle: function (req, res, next) {
                    res.setHeader('Access-Control-Allow-Origin', '*');
                    next();
                }
            }
        ]

    },*/
    snippetOptions: {
        rule: {
            match: /(<\/body>)/i,
            fn: function(snippet, match) {
                return snippet + match;
            }
        }
    }
});