<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" @keyup.esc="close()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()" v-bind:diabled="inAjaxCall">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ $t('game-messages') }}</h4>
                </div>
                <div class="modal-body">

                    <table class="messages-container">
                        <tr class="message" v-for="message in messages">
                            <td style="white-space: pre-line;">{{ message.message }}</td>
                            <td>
                                <a v-on:click="deleteMessage(event, message.id)" class="pull-right">
                                    {{ $t('delete-message') }}
                                </a>
                            </td>
                        </tr>
                    </table>

                    <div class="add-message-container">
                        <textarea v-model="newMessage" ref="newMessageInput"></textarea>
                        <button type="button" v-on:click="addNewMessage">
                            {{ $t('add-new-message') }}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['game_id'],
        mixins: [],
        mounted() {
            this.$nextTick(() => {
                this.getMessages();
            });
        },
        data() {
            return {
                messages: [],
                newMessage: ''
            }
        },
        methods: {
            deleteMessage(e, id) {
                this.$http.get('/api/games/' + this.game_id + '/delete-message/' + id).then(response => {
                    this.getMessages();
                })
            },
            addNewMessage(e) {
                if(this.newMessage.length > 0) {
                    this.$http.post('/api/games/' + this.game_id + '/add-new-message', {
                        message: this.newMessage
                    }).then(response => {
                        this.$refs.newMessageInput.innerHTML = '';
                        this.getMessages();
                    })
                }
            },
            getMessages() {
                this.$http.get('/api/games/' + this.game_id + '/get-all-messages').then(response => {
                    this.messages = response.body || [];
                })
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

<style scoped>
    .flash-exercise {
        margin-bottom: 15px;
        height: 36px;
        line-height: 36px;
    }
    .flash-exercise .name {
        padding-left: 15px;
    }
</style>