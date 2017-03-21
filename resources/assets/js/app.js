
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

//Vue.component('example', require('./components/Example.vue'));

/*const app = new Vue({
    el: '#app'
});*/

$(document).ready(() => {
    // Delete button comnfirmation and consequent POST
    $('a[data-method="delete"]').on('click', e => {
        e.preventDefault();
        var _this = $(this);

        if ( confirm( _this.data('confirm') ) ) {
            var form = $('<form>', {
                method: 'POST',
                action: _this.data('action')
            });

            form.append($('<input>', {
                type: 'hidden',
                name: '_method',
                value: 'DELETE'
            }));
            form.append($('<input>', {
                type: 'hidden',
                name: '_token',
                value: window.Laravel.csrfToken
            }));

            form.appendTo('body');
            form.submit();
        } else {
            _this.trigger('blur');
        }
    });

    // Setting locale
    $('.sz-set-locale').on('click', e => {
        e.preventDefault();
        $(document).find('form#locale-form').attr('action', $(e.target).attr('href')).submit();
    });
});
