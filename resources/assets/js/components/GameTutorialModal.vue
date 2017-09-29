<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" v-on:keyup.esc="close()">
        <div class="modal-dialog modal-lg sz-game-tips-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">{{ activity.title }}</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">{{ $t('tips-text') }}</h4>
                    <div class="tips" ref="tips">
                        <transition name="tip-side" mode="out-in" v-bind:enter-active-class="enterActivieClass" v-bind:leave-active-class="leaveActiveClass">
                            <div class="tip" v-if="currentItem === 'look_closely'" key="look_closely">
                                <div class="tip-image">
                                    <img class="img-responsive center-block" alt="image" v-bind:src="getItemImageUrl('look_closely')">
                                </div>
                                <h4 class="text-center">{{ $t('items.look_closely.title') }}</h4>
                                <div class="text-center">{{ $t('items.look_closely.description') }}</div>
                            </div>
                            <div class="tip" v-if="currentItem === 'look_out'" key="look_out">
                                <div class="tip-image">
                                    <img class="img-responsive center-block" alt="image" v-bind:src="getItemImageUrl('look_out')">
                                </div>
                                <h4 class="text-center">{{ $t('items.look_out.title') }}</h4>
                                <div class="text-center">{{ $t('items.look_out.description') }}</div>
                            </div>
                            <div class="tip" v-if="currentItem === 'do_not_disturb'" key="do_not_disturb">
                                <div class="tip-image">
                                    <img class="img-responsive center-block" alt="image" v-bind:src="getItemImageUrl('do_not_disturb')">
                                </div>
                                <h4 class="text-center">{{ $t('items.do_not_disturb.title') }}</h4>
                                <div class="text-center">{{ $t('items.do_not_disturb.description') }}</div>
                            </div>
                            <div class="tip" v-if="currentItem === 'help_others'" key="help_others">
                                <div class="tip-image">
                                    <img class="img-responsive center-block" alt="image" v-bind:src="getItemImageUrl('help_others')">
                                </div>
                                <h4 class="text-center">{{ $t('items.help_others.title') }}</h4>
                                <div class="text-center">{{ $t('items.help_others.description') }}</div>
                            </div>
                        </transition>
                    </div>
                    <ul class="text-center slides">
                        <li v-for="item in items">
                            <span v-bind:class="{ badge: true, current: item === currentItem }">&nbsp;</span>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-lg pull-left" v-on:click="previousItem()" v-bind:disabled="!currentItem" v-if="!isFirstItem()">{{ $t('back')}}</button>
                    <button type="button" class="btn btn-success btn-lg pull-right" v-on:click="nextItem()" v-bind:disabled="!currentItem" v-if="!isLastItem()">{{ $t('next')}}</button>
                    <button type="button" class="btn btn-success btn-lg pull-right" v-on:click="close()" v-bind:disabled="!currentItem" v-if="isLastItem()">{{ $t('got-it')}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['activity'],
        mounted() {
            this.baseUrl = window.SmartZoos.config.base_url;
        },
        data() {
            return {
                baseUrl: '',
                currentItem: 'look_closely',
                items: ['look_closely', 'look_out', 'do_not_disturb', 'help_others'],
                enterActivieClass: 'animated slideInLeft',
                leaveActiveClass: 'animated slideOutRight'
            };
        },
        methods: {
            open() {
                this.$nextTick(function() {
                    $(this.$refs.modal).modal('show');
                });
            },
            close() {
                this.$nextTick(function() {
                    $(this.$refs.modal).modal('hide');
                    this.$root.$emit('dialog:tutorial:close');
                });
            },
            getItemImageUrl(key) {
                return this.baseUrl + '/img/guidelines/' + key + '.jpg';
            },
            isFirstItem() {
                return this.items.indexOf(this.currentItem) === 0;
            },
            isLastItem() {
                return this.items.indexOf(this.currentItem) === (this.items.length - 1);
            },
            nextItem() {
                if ( !this.isLastItem() && this.currentItem ) {
                    var vm = this;
                    this.enterActivieClass = 'animated slideInLeft';
                    this.leaveActiveClass = 'animated slideOutRight';

                    $(this.$refs.tips).css('min-height', $(this.$refs.tips).height());
                    this.$nextTick(() => {
                        vm.currentItem = vm.items[vm.items.indexOf(vm.currentItem) + 1];
                        setTimeout(() => {
                            $(this.$refs.tips).removeAttr('style');
                        }, 2000);
                    });
                }
            },
            previousItem() {
                if ( !this.isFirstItem() && this.currentItem ) {
                    var vm = this;
                    this.enterActivieClass = 'animated slideInRight';
                    this.leaveActiveClass = 'animated slideOutLeft';

                    $(this.$refs.tips).css('min-height', $(this.$refs.tips).height());
                    this.$nextTick(() => {
                        vm.currentItem = vm.items[vm.items.indexOf(vm.currentItem) - 1];
                        setTimeout(() => {
                            $(this.$refs.tips).removeAttr('style');
                        }, 2000);
                    });
                }
            }
        }
    }
</script>
