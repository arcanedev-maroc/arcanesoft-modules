let mix = require('laravel-mix');

/*--------------------------------------------------------------------------
 | Mix Configuration
 |--------------------------------------------------------------------------
 */

const options = require('../options.mix');

mix.setPublicPath(options.assetsPath);
mix.setResourceRoot(options.resourceRoot);

/*--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

mix.ts(`${__dirname}/js/app.ts`, 'js/arcanesoft.js');
mix.sass(`${__dirname}/scss/app.scss`, 'css/arcanesoft.css');
