<template>
    <div v-if="show()">
        <br />
        <p>{{ answer.missing_word }}</p>
        <h4>{{ $t('pages.grading.index.heading-answer')}}</h4>
        <p v-html="answerText"></p>
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
            'single-grading': require('./Grading/Single.vue')
        },
        data() {
            return {
                inAjaxCall: false,
                questionMissingWords: this.getMissingWords(this.answer.missing_word),
                answerMissingWords: this.getMissingWords(this.getAnswerText())
            }
        },
        computed: {
            answerText() {
                return this.replaceAnswerText();
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
                return this.$parent.isMissingWord();
            },
            showAlert(message) {
                this.$parent.showAlert(message);
            },
            markGraded(answerId, grade) {
                this.$parent.markGraded(answerId, grade);
            },
            replaceAnswerText() {
                let answerText = this.getAnswerText();
                let questionMissingWordsLength = this.questionMissingWords.length;

                for (let i=0; i<questionMissingWordsLength; i++) {
                    let originalWord = this.questionMissingWords[i];
                    let answerWord = this.answerMissingWords[i];
                    let search = '{' + answerWord.word + '}';
                    let replacer = '';
                    if (answerWord.word !== originalWord.word) {
                        replacer = '{<span style="color: red; font-weight: bold;">' + answerWord.word + '</span> | ';
                        replacer += '<span style="color: green; font-weight: bold;">' + originalWord.word + '</span>}';
                    } else {
                        replacer = '{<span style="color: green; font-weight: bold;">' + originalWord.word + '</span>}';
                    }

                    answerText = answerText.replace(search, replacer);
                }

                return answerText;
            },
            getAnswerText() {
                const answer = JSON.parse(this.answer.answer);
                if (answer && typeof answer.text !== 'undefined') {
                    return answer.text;
                }
                return '-';
            },
            getMissingWords(str) {
                const regex = RegExp('\\{[A-Za-z0-9\\.\\s-]+\\}','g');
                let missingWords = [];
                let array;
                let index = 0;

                while ( (array = regex.exec(str)) !== null) {
                    let missingWord = array[0].substring(1).slice(0, -1);
                    missingWords[index] = {
                        word: missingWord,
                        start: array.index,
                        end: regex.lastIndex
                    };
                    index ++;
                }

                return missingWords;
            }
        }
    }
</script>