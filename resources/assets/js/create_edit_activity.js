$(document).ready(function() {
    // Instanciate slider
    $('#difficulty_level').ionRangeSlider({
        onChange: function(data) {
            $('input[name="difficulty_level_start"]').val(data.from);
            $('input[name="difficulty_level_end"]').val(data.to);
        }
    });

    // Instanciate popovers
    // TODO Enable popovers, these have issues after cloning
    //$('[data-toggle="popover"]').popover();

    // Instanciate lists with dragging and sorting functionality
    var sortableSource = Sortable.create(document.getElementById('activity-items'), {
        group: {
            name: 'activity-items',
            pull: 'clone',
            put: false
        },
        sort: false
    });
    var sortableTarget = Sortable.create(document.getElementById('attached-activity-items'), {
        group: {
            name: 'activity-items',
            pull: false,
            put: true
        },
        sort: true,
        onAdd: function(evt) {
            var input = $(evt.item).find('input')[0];
            input.name = input.name.replace(/tmp_/, "");
            $(evt.item).find('.row > div:first').append('<i class="mdi mdi-close-circle-outline" aria-hidden="true" onclick="$(this).parent().parent().parent().remove();"></i>');
        }
    });
});
