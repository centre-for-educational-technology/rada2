
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./bootstrap-tagsinput');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

$(document).ready(function() {
    // Delete button comnfirmation and consequent POST
    $('a[data-method="delete"]').on('click', function(e) {
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
    $('.sz-set-locale').on('click', function(e) {
        e.preventDefault();
        $(document).find('form#locale-form').attr('action', $(this).attr('href')).submit();
    });

    // Handling cookie consent
    const cookieConsentKey = 'cookie:consent';
    const hasGivenConsent = window.localStorage && window.localStorage.getItem(cookieConsentKey) === 'true';

    if ( !hasGivenConsent ) {
        $('#sz-cookie-consent')
            .addClass('fadeInUp animated')
            .css('display', '')
            .find('button').on('click', function() {
                $(this).parents('#sz-cookie-consent').addClass('fadeOutDown');
                if ( window.localStorage ) {
                    try {
                        window.localStorage.setItem(cookieConsentKey, 'true');
                    } catch (err) {
                        // Handles the QuotaExceededError in some versions of Safari on iOS
                    }
                }
            });
    }

    $('a[data-toggle="discountVoucher"]').on('click', function(e) {
        e.preventDefault();
        $(this).parent().next('.row').slideToggle();
    });

    const playModal = $('#play-modal');
    if ( playModal.length > 0 && !window.Laravel.isLoggedIn ) {
        playModal.on('hidden.bs.modal', function() {
            $(this).find('button.btn-play').off('click');
        });

        $('form.sz-play-action-form button.btn-play').on('click', function(event) {
            event.preventDefault();
            const self = this;

            playModal.find('button.btn-play').on('click', function() {
                $(self).parents('form.sz-play-action-form').trigger('submit');
                playModal.modal('hide');
            });

            playModal.modal('show');
        });
    }

    const discountVoucherModal = $('#discount-voucher-modal');
    if ( discountVoucherModal.length > 0 ) {
        discountVoucherModal.on('show.bs.modal', function (event) {
            const element = $(event.relatedTarget);

            $(this).find('.modal-title').text(element.data('title'));
            $(this).find('.modal-body').html($('#discount-voucher-content-'+element.data('id')).html());
        });

        discountVoucherModal.on('hidden.bs.modal', function() {
            $(this).find('.modal-title').html('');
            $(this).find('.modal-body').html('');
        });
    }

    if ( $('form[data-unload-protection="true"]').length > 0 ) {
        const unloadCallback = function(event) {
            event.returnValue = window.Laravel.unloadProtectionMessage;
            return window.Laravel.unloadProtectionMessage;
        };

        window.addEventListener('beforeunload', unloadCallback);

        $('form[data-unload-protection="true"]')
            .find('.btn.btn-bypass-unload-protection')
            .on('click', function() {
                window.removeEventListener('beforeunload', unloadCallback);
            });
    }
});
