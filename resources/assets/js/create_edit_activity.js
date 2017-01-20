$(document).ready(function() {
    // Instanciate slider
    $('#difficulty_level').ionRangeSlider({
        onChange: function(data) {
            $('input[name="difficulty_level_start"]').val(data.from);
            $('input[name="difficulty_level_end"]').val(data.to);
        }
    });

    // Instanciate popovers
    $('[data-toggle="popover"]').popover();

    // Instanciate lists with dragging and sorting functionality
    var sortableSource = Sortable.create(document.getElementById('activity-items'), {
        group: {
            name: 'activity-items',
            pull: 'clone',
            put: false
        },
        sort: false,
        handle: '.sz-handle'
    });
    var sortableTarget = Sortable.create(document.getElementById('attached-activity-items'), {
        group: {
            name: 'activity-items',
            pull: false,
            put: true
        },
        sort: true,
        handle: '.sz-handle',
        onAdd: function(evt) {
            var input = $(evt.item).find('input')[0];
            input.name = input.name.replace(/tmp_/, "");
            $(evt.item).find('i.sz-handle').after('<i class="mdi mdi-close-circle-outline pull-right" aria-hidden="true" onclick="$(this).parent().popover(\'destroy\');$(this).parent().remove();"></i>');
        }
    });
});
