<script>
    window.Laravel.locale = '<?php echo App::getLocale(); ?>';
    window.Laravel.translations = <?php echo json_encode([
        'add-option' => trans('general.forms.buttons.add-option'),
        'option-text' => trans('general.forms.placeholders.option-text'),
        'set-current-position' => trans('pages.activity-items.create-or-edit.set-current-position'),
        'geolocation-error' => trans('pages.activity-items.create-or-edit.geolocation-error'),
        'image-format-hint' => trans('pages.play.game.image-format-hint'),
    ]); ?>
</script>
