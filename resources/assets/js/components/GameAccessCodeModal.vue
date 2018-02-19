<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" @keyup.esc="close()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ title() }}</h4>
                </div>
                <div class="modal-body">
                    <p v-if="hasAccessCodeClues()">
                        <i class="mdi mdi-information-outline"></i>
                        {{ accessCodeClues() }}
                    </p>
                    <input type="text" class="form-control" v-bind:class="{ animated: animated, shake: !correctCode && animated }" v-bind:placeholder="$t('access-code-placeholder')" v-model="accessCode" v-on:keyup.enter="check()" ref="input">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" v-on:click="close()" v-bind:title="$t('close')">
                        <i class="mdi mdi-close"></i>
                    </button>
                    <button type="button" class="btn btn-primary" v-on:click="check()" v-bind:disabled="!canCheck()" v-bind:title="$t('submit')">
                        <i class="mdi mdi-compare"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['question'],
        mounted() {
            this.$nextTick(() => {
                const vm = this;

                $(this.$refs.modal).on('hidden.bs.modal', e => {
                    if ( vm.correctCode === true ) {
                        vm.$nextTick(() => {
                            vm.$parent.$refs.questionModal.open();
                        });
                    } else {
                        vm.$parent.question = null;
                    }

                    vm.accessCode = null;
                    vm.correctCode = false;
                    vm.animated = false;
                });

                $(this.$refs.modal).on('shown.bs.modal', e => {
                    vm.$nextTick(() => {
                        $(this.$refs.input).focus();
                    });
                });
            });
        },
        data() {
            return {
                accessCode: null,
                correctCode: false,
                animated: false,
            };
        },
        methods: {
            open() {
                this.$nextTick(() => {
                    $(this.$refs.modal).modal('show');
                });
            },
            close() {
                this.$nextTick(() => {
                    $(this.$refs.modal).modal('hide');
                });
            },
            title() {
                return ( this.question && this.question.title ) ? this.question.title : '';
            },
            hasAccessCodeClues() {
                const accessCodeClues = this.accessCodeClues();

                return !!( accessCodeClues && accessCodeClues.trim() );
            },
            accessCodeClues() {
                return ( this.question && this.question.access_code_clues ) ? this.question.access_code_clues : '';
            },
            canCheck() {
                return !!this.accessCode;
            },
            check() {
                if ( !this.canCheck() ) return;

                const vm = this;

                vm.animated = false;

                vm.$nextTick(() => {
                    if ( vm.accessCode.toLowerCase().trim() === vm.question.access_code.toLowerCase().trim() ) {
                        vm.correctCode = true;
                        vm.close();
                    } else {
                        vm.correctCode = false;
                    }

                    vm.animated = true;
                });
            }
        }
    }
</script>
