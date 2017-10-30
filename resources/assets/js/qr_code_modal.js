$(function () {
    const qrCodeModal = $('#qr-code-modal');

    qrCodeModal.on('show.bs.modal', function (event) {
        const element = $(event.relatedTarget);
        const modalBody = $(this).find('.modal-body');

        $(this).find('.modal-title').text(element.data('title'));
        $.get(element.data('api-url'), function(data, textStatus, jqXHR) {
            modalBody.html(data.qrcode);
        });
    });

    qrCodeModal.on('hidden.bs.modal', function() {
        $(this).find('.modal-title').html('');
        $(this).find('.modal-body').html('');
    });
});
