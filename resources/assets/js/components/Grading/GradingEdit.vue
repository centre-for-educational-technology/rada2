<template>
    <div v-if="viewType === 'edit' && answer != null" class="panel panel-default">
        <div class="panel-heading">
            {{ $t('pages.grading.index.heading') }}
        </div>
        <div class="panel-body">
            <div class="media sz-author">
                <div class="media-left">
                    <i class="mdi mdi-account-circle" aria-hidden="true"></i>
                </div>
                <div class="media-body">
                    <div>{{ answer.user_name }}</div>
                    <div class="sz-date">
                        <i class="mdi mdi-clock" aria-hidden="true"></i>
                        {{ answer.created_at }}
                    </div>
                </div>
            </div>
            <div class="media-body">
                <div class="media-heading">
                    <div class="col-xs-12">
                        <div class="row">
                            <h4 class="question-title">{{ answer.title }}</h4>
                            <div class="activity-title">{{ this.getQuestionTypeTranslation() }}</div>

                            <img class="image" v-if="image != null" :src="image" />

                            <div v-if="answer.description.length > 0">
                                <h4>{{ $t('pages.grading.index.heading-question-information')}}</h4>
                                <div>
                                    {{ answer.description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <freeform :answer="answer"></freeform>
                <photo :answer="answer"></photo>
                <one-correct :answer="answer" ref="oneCorrectComponent"></one-correct>
                <missing-word :answer="answer"></missing-word>
                <multiple-correct :answer="answer" ref="multipleCorrectComponent"></multiple-correct>
                <match-pairs :answer="answer"></match-pairs>
            </div>

            <div v-if="alertSuccessMessage != null" class="alert alert-success pull-left">
                <span class="pull-left alert-text">{{ alertSuccessMessage }}</span>
                <a href="/grading" v-on:click="onClickGoBackToList" class="btn btn-primary pull-left">
                    {{ $t('pages.grading.index.go-back-to-list') }}
                </a>
            </div>

            <h4 v-if="otherAnswers.length > 0" class="previous-grades" style="clear: both;">{{ $t('pages.grading.index.heading-previous-grades')}}</h4>
            <div class="previous-grades-container">
                <div class="previous-grade-item" v-for="otherAnswer in otherAnswers">
                    <div class="previous-grade">{{ otherAnswer.grade }}</div>
                    <div class="previous-grade-info">
                        <p class="previous-grade-answer">{{ getOtherAnswerAnswer(otherAnswer) }}</p>
                        <span class="previous-grade-user">{{ otherAnswer.user_name }}</span>
                    </div>
                    <div class="previous-grade-actions">
                        <a :href="'/grading/'+otherAnswer.id+'/edit'"
                           v-on:click="openOtherAnswerDetail(otherAnswer.id, this.event)"
                           class="btn btn-default">Details btn</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['answerId', 'viewType'],
        components: {
            'freeform': require('./QuestionTypes/Freeform'),
            'photo': require('./QuestionTypes/Photo'),
            'one-correct': require('./QuestionTypes/OneCorrect'),
            'missing-word': require('./QuestionTypes/MissingWord'),
            'multiple-correct': require('./QuestionTypes/MultipleCorrect'),
            'match-pairs': require('./QuestionTypes/MatchPairs')
        },
        mounted() {
            this.$nextTick(() => {
                this.$nextTick(() => {
                    this.baseUrl = window.RADA.config.base_url;
                    this.answer = this.getAnswer();
                    this.image = this.getImage();
                    setTimeout(() => {
                        this.loadOtherAnswers();
                    }, 500);
                });
            });
        },
        data() {
            return {
                image:  null,
                baseUrl: '',
                answer: null,
                alertSuccessMessage: null,
                otherAnswers: []
            }
        },
        computed: {
        },
        watch: {
            answerId () {
                this.answer = this.getAnswer();
                this.image = this.getImage();

                if (this.answer === null) {
                    this.reset();
                } else {
                    setTimeout(() => {
                        this.loadOtherAnswers();
                    }, 500);
                }
            }
        },
        methods: {
            reset() {
                this.image = null;
                this.alertSuccessMessage = null;
                this.otherAnswers = [];
            },
            showAlert(message) {
                this.alertSuccessMessage = message.message;
            },
            markGraded(answerId, grade) {
                this.$parent.markGraded(answerId, grade);
            },
            onClickGoBackToList(e) {
                if (window.history.length > 1) {
                    this.reset();
                    e.preventDefault();
                    window.history.back();
                    return false;
                }
            },
            loadOtherAnswers() {
                if (this.answer) {
                    this.$http.get('/api/grading/get-other-graded-answers/' + this.answer.id).then(response => {
                        this.otherAnswers = response.body;
                    }, error => {
                        this.otherAnswers = [];
                    });
                }
            },
            getOtherAnswerAnswer(answer) {
                const json = JSON.parse(answer.answer);
                const type = answer.type;
                let response = '-';
                switch (type) {
                    case 1:
                        break;
                    case 2:
                    case 3:
                        let responseArray = [];
                        let component = null;
                        if (type === 2) {
                            component = this.$refs.oneCorrectComponent;
                        } else {
                            component = this.$refs.multipleCorrectComponent;
                        }
                        if (component) {
                            const questionData = component.getQuestionDataFromData();
                            const options = json !== null && typeof json.options !== 'undefined' ? json.options : [];
                            for (let i = 0; i < options.length; i++) {
                                let optionId = options[i];
                                let data = questionData.filter(item => {
                                    return parseInt(item.id) === parseInt(optionId);
                                });
                                if (data.length > 0) {
                                    responseArray[i] = data[0].option;
                                }
                            }
                        }
                        response = responseArray.toString();
                        break;
                    case 4:
                    case 6:
                    case 8:
                        response = json !== null && typeof json.text !== 'undefined' ? json.text : '';
                        break;
                    case 5:
                        break;
                    case 7:
                        break;
                }
                return response;
            },
            openOtherAnswerDetail(answerId, e) {
                e.preventDefault();
                this.reset();
                let data = this.$parent.getData();
                data.currentAnswerId = answerId;
                this.$parent.setData(data);
                this.$parent.changePage();
                return false;
            },
            getQuestionTypeTranslation() {
                return window.Laravel.questionTypes[this.answer.type];
            },
            isInformation() {
                return this.answer.type === window.Laravel.questionTypeConstants.INFORMATION;
            },
            isOneCorrectAnswer() {
                return this.answer.type === window.Laravel.questionTypeConstants.ONE_CORRECT_ANSWER;
            },
            isMultipleCorrectAnswers() {
                return this.answer.type === window.Laravel.questionTypeConstants.MULTIPLE_CORRECT_ANSWERS;
            },
            isFreeformAnswer() {
                return this.answer.type === window.Laravel.questionTypeConstants.FREEFORM_ANSWER;
            },
            isMatchPairs() {
                return this.answer.type === window.Laravel.questionTypeConstants.MATCH_PAIRS;
            },
            isEmbeddedContent() {
                return this.answer.type === window.Laravel.questionTypeConstants.EMBEDDED_CONTENT;
            },
            isPhoto() {
                return this.answer.type === window.Laravel.questionTypeConstants.PHOTO;
            },
            isMissingWord() {
                return this.answer.type === window.Laravel.questionTypeConstants.MISSING_WORD;
            },
            getAnswer() {
                const answers = window.Laravel.answers.filter(answer => {
                    return answer.id === this.answerId;
                });
                if (answers.length > 0) {
                    return answers[0];
                }

                return null;
            },
            getImage() {
                return this.answer && this.answer.image ? '/uploads/images/activity_items/'
                    + this.answer.activity_item_id + '/'
                    + this.answer.image : null;
            }
        }
    }
</script>
<style scoped>
    .question-title {
        padding: 5px 0;
        display: block;
    }
    .activity-title {
        font-size: 14px;
    }
    .bottom-padding {
        padding-bottom: 15px;
    }
    .image {
        max-width: 100%;
    }
    .alert-text {
        padding: 6px 15px 6px 6px;
    }
    .previous-grades-container {}
    .previous-grade-item {
        border: 1px solid #000;
        margin-bottom: 15px;
        overflow: hidden;
        padding: 15px;
    }
    .previous-grade {
        float: left;
        font-size: 25px;
        padding: 15px;
    }
    .previous-grade-info {
        float: left;
        padding: 0 15px;
        max-width: 75%;
    }
    .previous-grade-answer {
        font-size: 18px;
    }
    .previous-grade-user {
        font-size: 12px;
    }
    .previous-grade-actions {
        float: right;
        padding: 17px 0px;
    }
    @media (max-width: 600px) {
        .previous-grade,
        .previous-grade-info,
        .previous-grade-actions,
        .previous-grade-actions .btn {
            float: none;
            width: 100%;
            max-width: 100%;
        }
        .previous-grade,
        .previous-grade-actions .btn {
            text-align: center;
        }
    }
</style>