<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ activity.title }}</h4>
                </div>
                <div class="modal-body">
                    <div v-for="(question, index) in activity.questions">
                        <h3>{{ index + 1 }}. {{ question.title }}</h3>
                        <p>{{question.description}}</p>
                        <div v-if="isOneCorrectAnswer(question) || isMultipleCorrectAnswers(question)">
                            <ul class="list-group">
                                <li class="list-group-item" v-for="option in question.options">
                                    {{ option.option }}
                                </li>
                            </ul>
                        </div>
                        <div v-if="isMatchPairs(question) || isEmbeddedContent(question)">
                            TODO: Display textual answer
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
        props: ['activity'],
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
            }
        }
    }
</script>
