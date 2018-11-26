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

if(mix.inProduction()){
	mix.version();
}

mix.js('resources/assets/js/welcome.js', 'public/js')
	 .js('resources/assets/js/admin.js', 'public/js')

   .sass('resources/assets/sass/admin.scss', 'public/css')
   .sass('resources/assets/sass/welcome.scss', 'public/css');

mix.copy('resources/assets/images', 'public/images');
mix.copy('resources/assets/images', 'public/images');
mix.copy('node_modules/animate.css/animate.min.css', 'public/css/animate.min.css');
