process.env.DISABLE_NOTIFIER = true;
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
       .webpack('edit_grading.js')
       .webpack('play.js')
       .webpack('profile.js')
       .webpack('welcome.js')
       .webpack('search_activities.js')
       .webpack('qr_code_modal.js')
       .webpack('login.js')
       .webpack('discount_vouchers.js')
       .webpack('manage_users.js')
       .webpack('grading.js')
       .version([
           'css/app.css',
           'js/create_edit_activity_item.js',
           'js/create_edit_activity.js',
           'js/play.js', 'js/app.js',
           'js/profile.js',
           'js/welcome.js',
           'js/search_activities.js',
           'js/qr_code_modal.js',
           'js/login.js',
           'js/discount_vouchers.js',
           'js/manage_users.js',
           'js/grading.js'
       ])
       .copy('node_modules/bootstrap-sass/assets/fonts', 'public/build/fonts')
       .copy('node_modules/mdi/fonts', 'public/build/fonts');
});
