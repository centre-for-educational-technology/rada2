<script>
    window.Laravel.locale = '<?php echo App::getLocale(); ?>';
    window.Laravel.translations = <?php echo json_encode([
        'any' => trans('general.forms.options.any'),
        'search-activity-items' => trans('general.forms.buttons.search-activity-items'),
        'create-new-activity-item' => trans('general.forms.buttons.create-new-activity-item'),
        'keywords' => trans('pages.activities.create-or-edit.keywords'),
        'zoo' => trans('general.forms.labels.zoo'),
        'question-type' => trans('general.forms.labels.question-type'),
        'language' => trans('general.language'),
        'difficulty-level' => trans('general.forms.labels.difficulty-level'),
        'search' => trans('general.forms.buttons.search'),
        'close' => trans('general.forms.buttons.close'),
        'difficulty-level' => trans('general.forms.labels.difficulty-level'),
        'keyword-or-title' => trans('general.forms.placeholders.keyword-or-title'),
        'title' => trans('general.forms.labels.title'),
        'items-found' => trans('pages.activities.create-or-edit.items-found'),
        'load-more' => trans('general.forms.buttons.load-more'),
        'none-found' => trans('pages.activity-items.index.none-found'),
        'read-more-about' => trans('pages.play.game.read-more-about'),
        'textual-answer-placeholder' => trans('pages.play.game.textual-answer-placeholder'),
        'image-format-hint' => trans('pages.play.game.image-format-hint'),
        'enforce_items_order' => trans('general.forms.labels.enforce_items_order')
    ]); ?>
</script>
