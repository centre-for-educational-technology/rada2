$(function () {
    var moment = require('moment/moment.js');
    moment.locale(window.Laravel.locale);

    var apiUrl = window.Laravel.apiUrl;

    $('button.discount-voucher-spend').on('click', function(e) {
        e.preventDefault();
        var thisElement = $(this),
            parentElement = thisElement.parents('.discount-voucher');

        parentElement.removeClass('animated shake');

        if ( confirm(thisElement.data('confirm')) ) {
            thisElement.prop('disabled', true);
            $.ajax({
                url: apiUrl + '/vouchers/' + thisElement.data('voucher-id'),
                type: 'DELETE',
                cache: false,
                success: function(data) {
                    //console.log(data);
                    parentElement.addClass('invalid-or-spent');
                    thisElement.prop('disabled', true);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    thisElement.prop('disabled', false);
                    parentElement.addClass('animated shake');
                    //console.log(jqXHR, textStatus, errorThrown);
                }
            });
        }
    });

    $('.discount-voucher').each((index, voucher) => {
        const voucherElement = $(voucher);

        voucherElement.find('.valid-until > span').text( moment(voucherElement.data('valid-until')).format('LLL') );
    });
});
