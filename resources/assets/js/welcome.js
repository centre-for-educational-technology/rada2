$(function () {
    $('#sz-quick-play').find('button.sz-quick-play-btn').on('click', function() {
        const parentElement = $(this).parent();
        parentElement.slideUp('slow', function() {
            parentElement.next().slideDown('slow');
        });
    });
});
