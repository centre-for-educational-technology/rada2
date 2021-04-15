<script>
    window.Laravel.locale = '<?php echo App::getLocale(); ?>';
    window.Laravel.translations = <?php echo json_encode([
        'add-option' => trans('general.forms.buttons.add-option'),
        'option-text' => trans('general.forms.placeholders.option-text'),
        'set-current-position' => trans('pages.activity-items.create-or-edit.set-current-position'),
        'geolocation-error' => trans('pages.activity-items.create-or-edit.geolocation-error'),
        'image-format-hint' => trans('pages.play.game.image-format-hint'),
        'mark-option-as-correct' => trans('general.forms.tooltips.mark-option-as-correct'),
        'remove-existing-image' => trans('general.forms.tooltips.remove-image'),
        'remove-selected-image' => trans('general.forms.tooltips.remove-selected-image'),
        'image-upload' => [
            'input-text' => trans('general.components.image-upload.input-text'),
            'tabs' => [
                'upload' => trans('general.components.image-upload.tabs.upload'),
                'cultural-monuments-registry' => trans('general.components.image-upload.tabs.cultural-monuments-registry'),
            ],
            'help' => trans('general.forms.help.image'),
            'results' => trans('general.components.image-upload.ajapaik.results'),
            'search-text' => trans('general.forms.placeholders.search-text'),
            'buttons' => [
                'add' => trans('general.forms.buttons.add'),
                'details' => trans('general.forms.buttons.details'),
                'remove-selected-image' => trans('general.forms.buttons.remove-selected-image'),
            ],
            'remove-image' => trans('general.forms.tooltips.remove-image'),
        ],
        'buttons' => [
            'load-more' => trans('general.forms.buttons.load-more'),
        ],
    ]); ?>
</script>
