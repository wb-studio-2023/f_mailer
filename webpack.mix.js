const mix = require('laravel-mix');
const glob = require('glob');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
/**
 * Javascript
 */
 glob.sync('**/*.js', {cwd: 'resources/js'}).map(function (file) {
    mix.babel('resources/js/' + file, 'public/js/' + file)
        .version();
});

/**
 * package
 */
// mix.copyDirectory('resources/vendor', 'public/vendor')
//     .version();

/**
 * scss
 */
glob.sync('**/*.scss', {cwd: 'resources/scss'}).map(function (file) {
    mix.sourceMaps(true, 'source-map')
        // .sass('resources/scss/' + file, 'public/css/' + file.split('.')[0] + '.css')
        .sass('resources/scss/' + file.split('/')[0] + '/' + file.split('/')[1], 'public/css/' + file.split('/')[0] + '/' + file.split('/')[1].split('.')[0] + '.css')
        .version();
});

/**
 * image
 */
mix.copyDirectory('resources/img/member', 'public/img/member')
.version();

mix.copyDirectory('resources/img/common/pc', 'public/img/common/pc')
.version();
mix.copyDirectory('resources/img/common/sp', 'public/img/common/sp')
.version();

//  mix.copyDirectory('resources/img/front/pc', 'public/img/front/pc')
//  .version();

/**
 * excel
 */
//  mix.copyDirectory('resources/excel', 'public/excel')
//  .version();

mix.webpackConfig({
    stats: {
         children: true
    }
});