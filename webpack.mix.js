const mix = require('laravel-mix');

mix.options({
  processCssUrls: false
});


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management Dashboard
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

   
    //Auth
    mix.js('resources/assets/js/dashboard/auth.js', 'public/js/dashboard-auth.js')
    .sass('resources/assets/scss/dashboard/auth.scss', 'public/css/dashboard-auth.css');

    //Dashboard 
    mix.js('resources/assets/js/dashboard/dashboard.js', 'public/js/dashboard.js')
    .sass('resources/assets/scss/dashboard/dashboard.scss', 'public/css/dashboard.css');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management Customer Área
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

   
    //Auth
    mix.js('resources/assets/js/customerarea/auth.js', 'public/js/customerarea-auth.js')
    .sass('resources/assets/scss/customerarea/auth.scss', 'public/css/customerarea-auth.css');

    //Customer Area 
    mix.js('resources/assets/js/customerarea/customerarea.js', 'public/js/customerarea.js')
    .sass('resources/assets/scss/customerarea/customerarea.scss', 'public/css/customerarea.css');


/*
 |--------------------------------------------------------------------------
 | Mix  Copy Files
 |--------------------------------------------------------------------------
*/
    mix.copyDirectory('resources/assets/img', 'public/img');
    mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/fonts');
