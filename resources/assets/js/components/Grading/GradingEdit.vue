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
            <div class="media-body bottom-padding">
                <h4 class="media-heading">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="question-title">{{ answer.title }}</div>
                            <div class="activity-title">{{ this.getQuestionTypeTranslation() }}</div>

                            <img class="image" v-if="image != null" :src="image" />

                            <div v-if="answer.description.length > 0">
                                <h4>Question/Information text</h4>
                                <p>
                                    {{ answer.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </h4>
            </div>

            <div>
                <freeform :answer="answer"></freeform>
                <photo :answer="answer"></photo>
            </div>

            <h4>Previous grades text</h4>
            <div>
                <div>10</div>
                <div>
                    <p>Anser</p>
                    <span>User Name</span>
                </div>
                <div>
                    <a href="" class="btn btn-xs btn-primary">Details btn</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['answer', 'viewType'],
        components: {
            'freeform': require('./QuestionTypes/Freeform'),
            'photo': require('./QuestionTypes/Photo')
        },
        mounted() {
            this.$nextTick(() => {
                this.$nextTick(() => {
                    this.baseUrl = window.RADA.config.base_url;
                });
            });
        },
        data() {
            return {
                image:  null,
                baseUrl: '',
                answerx: null
            }
        },
        methods: {
            reset() {
                this.image = null;
                this.$set(this, 'answer', null);
            },
            setAnswer(answer) {
                this.$set(this, 'answer', answer);
                if (this.answer && this.answer.image) {
                    this.image = '/uploads/images/activity_items/' + this.answer.activity_item_id + '/' + this.answer.image;
                }
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
</style>