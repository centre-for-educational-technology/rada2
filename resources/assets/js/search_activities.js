$(function () {
    var formElement = $('form[name="search-form"]');

    formElement
        .find('input[name="difficulty-level"]')
        .parent().find('button')
        .on('click', function() {
            var buttonElement = $(this);
            buttonElement.parents('.input-group').find('button').removeClass('active');
            buttonElement.addClass('active');
            formElement.find('input[name="difficulty-level"]').val(buttonElement.data('value'));
        });
});
