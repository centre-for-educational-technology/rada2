<template>
    <div v-if="show()">
        <h4>{{ $t('pages.grading.index.heading-answer')}}</h4>
        <p>
            {{ answerText }}
        </p>
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
            'single-grading': require('./Grading/Single.vue').default
        },
        data() {
            return {
                inAjaxCall: false
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
                return this.$parent.isFreeformAnswer();
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
