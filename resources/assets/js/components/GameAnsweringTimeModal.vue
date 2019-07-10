<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" @keyup.esc="close()">
        <div class="modal-dialog modal-lg sz-game-question" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()" v-bind:diabled="inAjaxCall">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ title() }}</h4>
                </div>
                <div class="modal-body">
                    {{ $t('items.answering_time.description') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" v-on:click="startTimer()" v-bind:title="$t('items.answering_time.start_timer')">
                        {{ $t('items.answering_time.start_timer') }} <i class="mdi mdi-play-circle-outline"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['question', 'gameId', 'baseUrl'],
        mixins: [],
        mounted() {},
        data() {
            return {
                inAjaxCall: false
            }
        },
        methods: {
            startTimer() {
                let vm = this;
                let data = {
                    game_id: this.gameId,
                    question_id: this.question.id
                };
                this.inAjaxCall = true;
                this.$http.post(vm.baseUrl + '/api/games/start-answering-timer', data).then(response => {
                    vm.inAjaxCall = false;
                    vm.$parent.markAnswered(vm.question.id, response.body);
                    vm.$parent.openQuestionModal(vm.question, vm.$parent.getAnswer(vm.question.id));
                    vm.close();
                }, response => {
                    vm.inAjaxCall = false;
                    setTimeout(() => {
                        vm.startTimer()
                    }, 200);
                });
            },
            title() {
                return this.question ? this.question.title : '';
            },
            open() {
                this.$nextTick(() => {
                    $(this.$refs.modal).modal('show');
                });
                return $(this.$refs.modal);
            },
            close() {
                this.$nextTick(() => {
                    $(this.$refs.modal).modal('hide');
                });
            },
        }
    }
</script>