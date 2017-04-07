<script>
    window.Laravel.locale = '<?php echo App::getLocale(); ?>';
    window.Laravel.translations = <?php echo json_encode([
        'any' => trans('general.forms.options.any'),
        'add-activity-items' => trans('general.forms.buttons.add-activity-items'),
        'keywords' => trans('pages.activities.create-or-edit.keywords'),
        'zoo' => trans('general.forms.labels.zoo'),
        'question-type' => trans('general.forms.labels.question-type'),
        'language' => trans('general.language'),
        'difficulty-level' => trans('general.forms.labels.difficulty-level'),
        'playing-time' => trans('general.forms.labels.playing-time'),
        'search' => trans('general.forms.buttons.search'),
        'close' => trans('general.forms.buttons.close'),
        'difficulty-level' => trans('general.forms.labels.difficulty-level'),
        'keyword-or-title' => trans('general.forms.placeholders.keyword-or-title'),
        'title' => trans('general.forms.labels.title'),
        'items-found' => trans('pages.activities.create-or-edit.items-found'),
        'load-more' => trans('general.forms.buttons.load-more'),
    ]); ?>
</script>
