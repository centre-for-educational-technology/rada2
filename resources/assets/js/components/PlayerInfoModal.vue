<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" @keyup.esc="close()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body">
                    <h3 v-if="tasks.length >0">{{ $t('completed-tasks') }}:</h3>
                    <table class="table">
                        <tr v-for="task in tasks" class="table-row">
                            <td>{{ task.id }}</td>
                            <td>{{ task.title }}</td>
                            <td>
                                <a type="button"
                                   class="btn btn-primary btn-sm pull-right"
                                   v-bind:href="task.url"
                                   target="_blank"
                                >{{ $t('open')}}</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" v-on:click="close()">
                        {{ $t('close') }} <i class="mdi mdi-close"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tasks', 'title', 'game_id'],
        methods: {
            open() {
                this.$nextTick(() => {
                    $(this.$refs.modal).modal('show');
                });
                return $(this.$refs.modal);
            },
            close() {
                this.$nextTick(() => {
                    this.$parent.resetPlayerInfoModal();
                    $(this.$refs.modal).modal('hide');
                });
            },
        }
    }
</script>

<style>
    .table-row .btn {
        margin-bottom: 10px;
    }
</style>