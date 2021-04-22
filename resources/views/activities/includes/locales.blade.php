<script>
    window.Laravel.locale = '<?php echo App::getLocale(); ?>';
    window.Laravel.translations = <?php echo json_encode([
        'any' => trans('general.forms.options.any'),
        'search-activity-items' => trans('general.forms.buttons.search-activity-items'),
        'create-new-activity-item' => trans('general.forms.buttons.create-new-activity-item'),
        'keywords' => trans('pages.activities.create-or-edit.keywords'),
        'question-type' => trans('general.forms.labels.question-type'),
        'language' => trans('general.language'),
        'difficulty-level' => trans('general.forms.labels.difficulty-level'),
        'search' => trans('general.forms.buttons.search'),
        'close' => trans('general.forms.buttons.close'),
        'keyword-or-title' => trans('general.forms.placeholders.keyword-or-title'),
        'title' => trans('general.forms.labels.title'),
        'items-found' => trans('pages.activities.create-or-edit.items-found'),
        'none-found' => trans('pages.activity-items.index.none-found'),
        'read-more-about' => trans('pages.play.game.read-more-about'),
        'textual-answer-placeholder' => trans('pages.play.game.textual-answer-placeholder'),
        'image-format-hint' => trans('pages.play.game.image-format-hint'),
        'enforce_items_order' => trans('general.forms.labels.enforce_items_order'),
        'no_results_found' => trans('general.forms.warnings.no_results_found'),
        'image-upload' => [
            'input-text' => trans('general.components.image-upload.input-text'),
            'tabs' => [
                'upload' => trans('general.components.image-upload.tabs.upload'),
                'cultural-monuments-registry' => trans('general.components.image-upload.tabs.cultural-monuments-registry'),
                'location-based' => trans('general.components.image-upload.tabs.location-based'),
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
            'distance-units' => [
                'short' => [
                    'metres' => trans('general.components.image-upload.distance-units.short.metres'),
                    'kilometres' => trans('general.components.image-upload.distance-units.short.kilometres'),
                ],
            ],
        ],
        'buttons' => [
            'load-more' => trans('general.forms.buttons.load-more'),
        ],
        'labels' => [
            'proximity' => trans('general.forms.labels.proximity'),
        ],
        'help' => [
            'proximity' => trans('general.components.image-upload.help.proximity'),
        ],
        'set-current-position' => trans('pages.activity-items.create-or-edit.set-current-position'),
        'geolocation-error' => trans('pages.activity-items.create-or-edit.geolocation-error'),
    ]); ?>
</script>
