<script>
    window.Laravel.zooOptions = <?php echo json_encode(App\Activity::getZooOptions()); ?>;
    window.Laravel.questionTypeOptions = <?php echo json_encode(App\ActivityItem::getQuestionTypeOptions()); ?>;
    window.Laravel.languageOptions = <?php echo json_encode(App\Activity::getLanguageOptions()); ?>;
</script>
