<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg sz-game-results" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ activity.title }}</h4>
                </div>
                <div class="modal-body">
                    <div v-for="(question, index) in activity.questions">
                        <h3>{{ index + 1 }}. {{ question.title }}</h3>
                        <p>{{question.description}}</p>
                        <div v-if="isOneCorrectAnswer(question) || isMultipleCorrectAnswers(question)">
                            <ul class="media-list sz-options-list" v-for="option in question.options" v-bind:class="{ correct: isCorrect(question) }">
                                <li class="media sz-option">
                                        <div class="media-left" v-if="option.image">
                                            <img v-bind:src="option.image" class="media-object" alt="option-image">
                                        </div>

                                    <div class="media-body">
                                        <h4 class="media-heading">{{ option.option }}</h4>
                                    </div>

                                    <div class="media-right media-middle">
                                        <i class="mdi mdi-radiobox-marked" aria-hidden="true" v-if="isOneCorrectAnswer(question) && choseOption(question, option)"></i>
                                        <i class="mdi mdi-radiobox-blank" aria-hidden="true" v-if="isOneCorrectAnswer(question) && !choseOption(question, option)"></i>

                                        <i class="mdi mdi-checkbox-marked-outline" aria-hidden="true" v-if="isMultipleCorrectAnswers(question) && choseOption(question, option)"></i>
                                        <i class="mdi mdi-checkbox-blank-outline" aria-hidden="true" v-if="isMultipleCorrectAnswers(question) && !choseOption(question, option)"></i>
                                  </div>
                                </li>
                            </ul>
                        </div>

                        <div v-if="isFreeformAnswer(question) || isEmbeddedContent(question)">
                            <div class="well well-sm" v-if="hasText(question)">
                                {{ getText(question) }}
                            </div>
                        </div>

                        <div class="sz-photo" v-if="isPhoto(question)">
                            <div class="well well-sm" v-if="hasImage(question)">
                                <img alt="uploaded-image" class="sz-uploadable-image" v-bind:src="getImage(question)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['activity', 'answers'],
        mounted() {
        },
        methods: {
            open() {
                this.$nextTick(() => {
                    $(this.$refs.modal).modal('show');
                });
            },
            isInformation(question) {
                return question ? question.type == 1 : false;
            },
            isOneCorrectAnswer(question) {
                return question ? question.type == 2 : false;
            },
            isMultipleCorrectAnswers(question) {
                return question ? question.type == 3 : false;
            },
            isFreeformAnswer(question) {
                return question ? question.type == 4 : false;
            },
            isMatchPairs(question) {
                return question ? question.type == 5 : false;
            },
            isEmbeddedContent(question) {
                return question ? question.type == 6 : false;
            },
            isPhoto(question) {
                return question ? question.type == 7 : false;
            },
            hasAnswer(question) {
                return !!(this.answers && this.answers[question.id]);
            },
            isCorrect(question) {
                if ( !this.hasAnswer(question) ) {
                    return false;
                }

                return this.answers[question.id].correct;
            },
            hasOptions(question) {
                if ( !this.hasAnswer(question) ) {
                    return false;
                }

                return !!this.answers[question.id].answer.options;
            },
            choseOption(question, option) {
                if ( !this.hasOptions(question) ) {
                    return false;
                }

                return this.answers[question.id].answer.options.indexOf(option.id) !== -1;
            },
            hasText(question) {
                if ( !this.hasAnswer(question) ) {
                    return false;
                }

                return !!this.answers[question.id].answer.text;
            },
            getText(question) {
                return this.answers[question.id].answer.text;
            },
            hasImage(question) {
                if ( !this.hasAnswer(question) ) {
                    return false;
                }

                return !!this.answers[question.id].image;
            },
            getImage(question) {
                return this.answers[question.id].image;
            }
        }
    }
</script>
