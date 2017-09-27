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
                    <div class="tip">
                        <img class="img-responsive center-block" alt="image" v-bind:src="getItemImageUrl(currentItem)">
                        <h4 class="text-center">{{ $t('items.' + currentItem + '.title') }}</h4>
                        <div class="text-center">{{ $t('items.' + currentItem + '.description') }}</div>
                    </div>
                    <ul class="text-center slides">
                        <li v-for="item in items">
                            <span v-bind:class="{ badge: true, current: item === currentItem }">&nbsp;</span>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-lg pull-left" v-on:click="previousItem()" v-if="!isFirstItem()">{{ $t('back')}}</button>
                    <button type="button" class="btn btn-success btn-lg pull-right" v-on:click="nextItem()" v-if="!isLastItem()">{{ $t('next')}}</button>
                    <button type="button" class="btn btn-success btn-lg pull-right" v-on:click="close()" v-if="isLastItem()">{{ $t('got-it')}}</button>
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
            this.open();
        },
        data() {
            return {
                baseUrl: '',
                currentItem: 'look_closely',
                items: ['look_closely', 'look_out', 'do_not_disturb', 'help_others']
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
                if ( !this.isLastItem() ) {
                    this.currentItem = this.items[this.items.indexOf(this.currentItem) + 1];
                }
            },
            previousItem() {
                if ( !this.isFirstItem() ) {
                    this.currentItem = this.items[this.items.indexOf(this.currentItem) - 1];
                }
            }
        }
    }
</script>
