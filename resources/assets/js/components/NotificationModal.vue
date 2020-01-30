<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" @keyup.esc="close()">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()" v-bind:diabled="inAjaxCall">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body" v-html="message"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-success center-block" v-on:click="close()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'message'],
        data() {
            return {
                inAjaxCall: false
            }
        },
        methods: {
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

<style scoped>

</style>
