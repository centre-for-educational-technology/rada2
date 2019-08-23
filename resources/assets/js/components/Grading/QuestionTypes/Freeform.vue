<template>
    <div v-if="show()">
        <h4>Answer text</h4>
        <p>
            {{ answerText }}
        </p>
        <single-grading
                :maxGrade="maxPoints"
                :buttonValue="buttonValue"
                :onSubmit="onSubmit"
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
                buttonValue: 'Submit text'
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
            }
        },
        methods: {
            show() {
                return this.$parent.isFreeformAnswer();
            },
            onSubmit(grade) {
                console.log(grade);
            }
        }
    }
</script>