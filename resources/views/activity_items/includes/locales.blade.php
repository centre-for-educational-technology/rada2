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
    ]); ?>
</script>
