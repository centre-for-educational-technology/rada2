const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js')
       .webpack('create_edit_activity_item.js')
       .webpack('create_edit_activity.js')
       .webpack('play.js')
       .version(['css/app.css', 'js/create_edit_activity_item.js', 'js/create_edit_activity.js', 'js/play.js', 'js/app.js'])
       .copy('node_modules/bootstrap-sass/assets/fonts', 'public/build/fonts');
});
