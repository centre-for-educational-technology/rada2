<template>
    <div v-if="show()">
        <h4>{{ $t('pages.grading.index.heading-answer')}}</h4>
        <img class="image" v-if="image != null" :src="image" />
        <single-grading
                :maxGrade="maxPoints"
                :answerId="answer.id"
                :grade="grade"
        ></single-grading>
    </div>
</template>
<script>
    export default {
        props: ['answer'],
        components: {
            'single-grading': require('./Grading/Single')
        },
        data() {
            return {
                inAjaxCall: false,
                image: this.answer.answer_image ? '/uploads/images/activities/'
                    + this.answer.activity_id + '/'
                    + this.answer.game_id + '/'
                    + this.answer.answer_image : null,
            }
        },
        computed: {
            answerText() {
                const answer = JSON.parse(this.answer.answer);
                if (answer && typeof answer.text !== 'undefined') {
                    return answer.text;
                }
                return '-';
            },
            maxPoints() {
                return parseInt(this.answer.max_points);
            },
            grade() {
                return this.answer.grade ? parseInt(this.answer.grade) : this.maxPoints;
            }
        },
        methods: {
            show() {
                return this.$parent.isPhoto();
            },
            showAlert(message) {
                this.$parent.showAlert(message);
            },
            markGraded(answerId, grade) {
                this.$parent.markGraded(answerId, grade);
            }
        }
    }
</script>
<style scoped>
    .image {
        max-width: 100%;
    }
</style>