<template>
    <div>
        <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="closeDialog()" v-on:keyup.esc="closeDialog()">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-label="Close" v-on:click="closeDialog()"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add activity items</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label>Keywords</label>
                                <input type="text" class="form-control" placeholder="Type a keyword or title" v-model="searchForm.keywords">
                            </div>
                            <div class="form-group">
                                <label>Zoo</label>
                                <select class="form-control" v-model="searchForm.zoo">
                                    <option v-for="(title, key) in zooOptions" v-bind:value="key">{{ title }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Question Type</label>
                                <select class="form-control" v-model="searchForm.questionType">
                                    <option v-for="(title, key) in questionTypeOptions" v-bind:value="key">{{ title }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Language</label>
                                <select class="form-control" v-model="searchForm.language">
                                    <option v-for="(title, key) in languageOptions" v-bind:value="key">{{ title }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Difficulty Level</label>
                                <input type="hidden"
                                       class="form-control"
                                       data-type="double"
                                       data-min="1"
                                       data-max="99"
                                       data-from="1"
                                       data-to="99"
                                       data-step="1"
                                       data-grid="true"
                                       data-grid-num="11"
                                       ref="rangeSlider"
                                       data-disable="true">
                            </div>
                            <div class="form-group">
                                <label>Playing Time</label>
                                <select class="form-control" disabled="disabled" v-model="searchForm.playingTime">
                                    <option v-for="(title, key) in playingTimeOptions" v-bind:value="key">{{ title }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" v-bind:disabled="inAjaxCall" v-on:click="searchForItems()">Search</button>
                            </div>
                            <div v-if="searchResults.data && searchResults.data.length > 0">
                                <strong>{{ searchResults.total }} items found:</strong>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Zoo</th>
                                            <th>Type</th>
                                            <th>Language</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in searchResults.data">
                                            <td v-bind:title="item.description">{{ item.title }}</td>
                                            <td>{{ getZooFromId(item.zoo) }}</td>
                                            <td>{{ getQuestionTypeFromId(item.type) }}</td>
                                            <td>{{ getLanguageFromId(item.language) }}</td>
                                            <td>
                                                <transition name="button-toggle" mode="out-in" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
                                                    <button type="button" class="btn btn-success btn-sm" v-on:click="addItem(item)" v-if="!hasItem(item)" key="add"><i class="mdi mdi-plus"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" v-on:click="removeItem(item)" v-else key="remove"><i class="mdi mdi-minus"></i></button>
                                                </transition>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <transition name="button-load-more" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
                                    <button type="button" class="btn btn-default" v-on:click="loadMoreItems()" v-if="searchResults.loadMore" v-bind:disabled="inAjaxCall">Load more</button>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="closeDialog()" v-bind:disabled="inAjaxCall">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success" v-on:click="openDialog()">
            <i class="mdi mdi-plus"></i>
            Add Activity Items
        </button>
        <ul class="list-group sz-sortable-list">
            <draggable :list="items" :options="options">
                <li class="list-group-item" v-for="item in items" v-bind:title="item.description">
                    <input type="hidden" class="form-control" name="activity_items[]" v-bind:value="item.id">
                    <i class="mdi mdi-drag-vertical"></i>
                    <button type="button" class="btn btn-danger btn-sm pull-right" v-on:click="removeItem(item)"><i class="mdi mdi-minus"></i></button>
                    {{ item.title }}
                </li>
            </draggable>
        </ul>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        components: {
            draggable
        },
        props: ['apiUrl'],
        mounted() {
            const vm = this;

            // TODO Consider moving options definition to the App instance and passing those on to component
            if ( window.Laravel.activityItems ) {
                this.items = window.Laravel.activityItems;
            }
            if ( window.Laravel.zooOptions ) {
                this.zooOptions = _.merge(window.Laravel.zooOptions, this.zooOptions);
            }
            if ( window.Laravel.questionTypeOptions ) {
                this.questionTypeOptions = _.merge(window.Laravel.questionTypeOptions, this.questionTypeOptions);
            }
            if ( window.Laravel.languageOptions ) {
                this.languageOptions = _.merge(window.Laravel.languageOptions, this.languageOptions);
            }

            this.$nextTick(() => {
                $(this.$refs.modal).on('hide.bs.modal', e => {
                    if ( vm.inAjaxCall ) {
                        e.preventDefault();
                    }
                });

                $(this.$refs.rangeSlider).ionRangeSlider({
                    onChange(data) {
                        vm.searchForm.difficultyLevel.from = data.from;
                        vm.searchForm.difficultyLevel.to = data.to;
                    }
                });
            });
        },
        data() {
            return {
                items: [],
                options: {
                    sort: true
                },
                inAjaxCall: false,
                searchResults: {
                    data: [],
                    total: 0,
                    loadMore: false
                },
                zooOptions: {
                    0: 'Any'
                },
                questionTypeOptions: {
                    0: 'Any'
                },
                languageOptions: {
                    0: 'Any'
                },
                playingTimeOptions: {
                    0: 'Any'
                },
                searchForm: {
                    keywords: '',
                    zoo: '0',
                    questionType: '0',
                    language: '0',
                    difficultyLevel: {
                        from: 1,
                        to: 99
                    },
                    playingTime: '0'
                }
            };
        },
        methods: {
            openDialog() {
                this.$nextTick(() => {
                    $(this.$refs.modal).modal('show');
                });
            },
            closeDialog() {
                if ( this.inAjaxCall ) return;

                this.$nextTick(() => {
                    $(this.$refs.modal).modal('hide');
                    // TODO Make sure results are purged and data values are reset
                });
            },
            searchForItems() {
                const vm = this;
                let params = {
                    keywords: vm.searchForm.keywords,
                    zoo: vm.searchForm.zoo,
                    questionType: vm.searchForm.questionType,
                    language: vm.searchForm.language
                };
                vm.inAjaxCall= true;
                this.$http.get(vm.apiUrl + '/activity_items/search', { params: params }).then(response => {
                    vm.inAjaxCall = false;
                    vm.searchResults = {
                        data: _.cloneDeep(response.body.data),
                        total: response.body.total,
                        currentPage: response.body.current_page,
                        params: params,
                        loadMore: response.body.current_page < response.body.last_page
                    };
                }, response => {
                    vm.inAjaxCall = false;
                    console.error('Error', response);
                });
            },
            loadMoreItems() {
                const vm = this;
                vm.inAjaxCall = true;
                vm.searchResults.params.page = vm.searchResults.currentPage + 1;
                this.$http.get(vm.apiUrl + '/activity_items/search', { params: vm.searchResults.params }).then(response => {
                    vm.inAjaxCall = false;
                    // XXX This needs to be done with help of merge method
                    _.each(_.cloneDeep(response.body.data), function(single) {
                        vm.searchResults.data.push(single);
                    });
                    vm.searchResults.currentPage = response.body.current_page;
                    vm.searchResults.loadMore = response.body.current_page < response.body.last_page;
                }, response => {
                    vm.inAjaxCall = false;
                    console.error('Error', response);
                });
            },
            getItemIndex(item) {
                return _.findIndex(this.items, (single) => { return single.id === item.id; });
            },
            hasItem(item) {
                return this.getItemIndex(item) !== -1;
            },
            addItem(item) {
                if ( !this.hasItem(item) ) {
                    this.items.push(item);
                }
            },
            removeItem(item) {
                const itemIndex = this.getItemIndex(item);
                if ( itemIndex !== -1 ) {
                    this.items.splice(itemIndex, 1);
                }
            },
            getOptionValueFromId(options, id) {
                const option = options[id];
                return option ? option : id;
            },
            getZooFromId(id) {
                return this.getOptionValueFromId(this.zooOptions, id);
            },
            getQuestionTypeFromId(id) {
                return this.getOptionValueFromId(this.questionTypeOptions, id);
            },
            getLanguageFromId(id) {
                return this.getOptionValueFromId(this.languageOptions, id);
            }
        }
    }
</script>
