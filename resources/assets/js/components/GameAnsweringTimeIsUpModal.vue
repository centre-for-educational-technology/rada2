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
                    {{ message }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" v-on:click="close()" v-bind:title="$t('close')">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['question'],
        mixins: [],
        mounted() {},
        data() {
            return {
                inAjaxCall: false,
                message: this.$t('items.answering_time.time_is_up')
            }
        },
        methods: {
            title() {
                return this.question ? this.question.title : '';
            },
            open(message) {
                this.$nextTick(() => {
                    $(this.$refs.modal).modal('show');
                });
                if (typeof message !== 'undefined') {
                    this.message = message;
                }
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