<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" v-on:keyup.esc="close()">
        <div class="modal-dialog modal-lg sz-game-tips-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">{{ $t('tips-text') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="tips" ref="tips">
                        <transition name="tip-side" mode="out-in" v-bind:enter-active-class="enterActiveClass" v-bind:leave-active-class="leaveActiveClass">
                            <div class="tip" v-if="currentItem === 'gameplay_instructions'" key="gameplay_instructions">
                                <div class="tip-image">
                                    <img class="img-responsive center-block" alt="image" v-bind:src="getItemImageUrl('gameplay_instructions', 'png')">
                                </div>
                                <h4 class="text-center">{{ $t('items.gameplay_instructions.title') }}</h4>
                                <div class="text-center">{{ $t('items.gameplay_instructions.description') }}</div>
                            </div>
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

            const vm = this;
            this.hammertime = new Hammer.Manager(this.$refs.tips, {
                recognizers: [
                    [Hammer.Swipe,{ direction: Hammer.DIRECTION_HORIZONTAL }]
                ]
            });
            this.hammertime.on('swipeleft', () => {
                vm.nextItem();

                if ( vm.isLastItem() ) {
                    vm.close();
                }
            });
            this.hammertime.on('swiperight', () => {
                vm.previousItem();
            });
        },
        data() {
            return {
                baseUrl: '',
                currentItem: 'gameplay_instructions',
                items: ['gameplay_instructions', 'look_closely', 'look_out', 'do_not_disturb', 'help_others'],
                enterActiveClass: 'animated slideInRight',
                leaveActiveClass: 'animated slideOutLeft'
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
                    this.$root.$emit('dialog:tutorial:close');
                });
            },
            getItemImageUrl(key, format) {
                if ( !format ) {
                    format = 'jpg';
                }
                return this.baseUrl + '/img/guidelines/' + key + '.' + format;
            },
            isFirstItem() {
                return this.items.indexOf(this.currentItem) === 0;
            },
            isLastItem() {
                return this.items.indexOf(this.currentItem) === (this.items.length - 1);
            },
            nextItem() {
                if ( !this.isLastItem() && this.currentItem ) {
                    const vm = this;
                    this.enterActiveClass = 'animated slideInRight';
                    this.leaveActiveClass = 'animated slideOutLeft';

                    $(this.$refs.tips).css('min-height', $(this.$refs.tips).height());
                    this.$nextTick(() => {
                        vm.currentItem = vm.items[vm.items.indexOf(vm.currentItem) + 1];
                        setTimeout(() => {
                            $(this.$refs.tips).css('min-height', '');
                        }, 2000);
                    });
                }
            },
            previousItem() {
                if ( !this.isFirstItem() && this.currentItem ) {
                    const vm = this;
                    this.enterActiveClass = 'animated slideInLeft';
                    this.leaveActiveClass = 'animated slideOutRight';

                    $(this.$refs.tips).css('min-height', $(this.$refs.tips).height());
                    this.$nextTick(() => {
                        vm.currentItem = vm.items[vm.items.indexOf(vm.currentItem) - 1];
                        setTimeout(() => {
                            $(this.$refs.tips).css('min-height', '');
                        }, 2000);
                    });
                }
            }
        }
    }
</script>
