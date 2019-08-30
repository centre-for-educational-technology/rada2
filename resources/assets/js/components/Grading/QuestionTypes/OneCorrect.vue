<template>
    <div v-if="show()">
        <h4>{{ $t('pages.grading.index.heading-answer')}}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ $t('pages.grading.index.answer_table.option') }}</th>
                    <th>{{ $t('pages.grading.index.answer_table.correct') }}</th>
                    <th>{{ $t('pages.grading.index.answer_table.answer') }}</th>
                    <th>{{ $t('pages.grading.index.answer_table.points') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in questionData">
                    <td>{{ data.option }}</td>
                    <td><input
                            type="checkbox"
                            name="correct"
                            tabindex="-1"
                            disabled="disabled"
                            :checked="data.correct"
                    ></td>
                    <td><input
                            type="checkbox"
                            name="answer"
                            tabindex="-1"
                            disabled="disabled"
                            :checked="data.id === answerOption"
                    ></td>
                    <td>{{ data.points }}</td>
                </tr>
            </tbody>
        </table>
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
                questionData: null
            }
        },
        computed: {
            answerOption() {
                const answer = JSON.parse(this.answer.answer);
                if (answer && typeof answer.options !== 'undefined' && answer.options.length > 0) {
                    return answer.options[0];
                }
                return '-';
            },
            maxPoints() {
                const pointsObject = JSON.parse(this.answer.max_points);
                for (let key in pointsObject) {
                    if (pointsObject.hasOwnProperty(key)) {
                        return parseInt(pointsObject[key]);
                    }
                }
                return 0;
            },
            grade() {
                return this.answer.grade ? parseInt(this.answer.grade) : this.maxPoints;
            }
        },
        mounted() {
            if (this.show()) {
                this.getQuestionData(this.answer.activity_item_id, (data) => {
                    this.questionData = data;
                });
            }
        },
        methods: {
            getQuestionDataFromData() {
                return this.questionData;
            },
            show() {
                return this.$parent.isOneCorrectAnswer();
            },
            showAlert(message) {
                this.$parent.showAlert(message);
            },
            markGraded(answerId, grade) {
                this.$parent.markGraded(answerId, grade);
            },
            getQuestionData(activityItemId, callback) {
                this.$http.get('/api/grading/get-question-data/' + activityItemId).then(response => {
                    callback(response.body);
                }, response => {
                    callback(null);
                });
            }
        }
    }
</script>