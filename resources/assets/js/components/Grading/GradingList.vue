<template>
    <div>
        <div v-if="viewType === 'list'" class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        {{ $t('pages.grading.index.heading') }}
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <div class="pull-right">
                            <form-element-switch
                                    :onSwitchChange="onSwitchChange"
                                    :label="$t('pages.grading.index.switch-label')"
                            ></form-element-switch>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body" id="search-results">
                <div v-if="answers.length === 0" class="well">{{ $t('pages.grading.index.none-found') }}</div>
                <div v-if="answers.length > 0">
                    <grading-list-item
                            v-for="answer in answersPerPage"
                            :answer="answer"
                            v-on:setData="setData"
                    ></grading-list-item>
                    <pagination
                            v-model="paginationPage"
                            :page-count="pages"
                            :generateUrl="generatePaginationUrl"
                            :classes="bootstrapPaginationClasses"
                            :labels="paginationAnchorTexts"
                    ></pagination>
                </div>
            </div>
        </div>
        <grading-edit :viewType="viewType" ref="gradingEditComponent"  :answerId="currentAnswerId"></grading-edit>
    </div>
</template>
<script>
    export default {
        props: ['answers'],
        components: {
            'grading-list-item': require('./GradingListItem.vue'),
            'pagination': require('../vue-plain-pagination'),
            'form-element-switch': require('../FormElementSwitch.vue'),
            'grading-edit': require('./GradingEdit.vue')
        },
        mounted() {
            let vm = this;

            this.$nextTick(() => {
                this.baseUrl = window.RADA.config.base_url;
                this.viewType = window.Laravel.viewType;
                if (this.viewType === 'list') {
                    let currentPage = window.Laravel.currentPage;
                    this.currentPage = currentPage;
                    if (currentPage === 0) {
                        currentPage = 1;
                    }
                    this.paginationPage = currentPage;
                }
            });

            window.addEventListener('popstate', function(e){
                let state = e.state;
                if (state === null) {
                    vm.reset();
                    vm.resetEdit();
                } else {
                    vm.resetEdit();
                    vm.setData(state);
                }
            });
        },
        updated() {
            if (this.viewType === 'edit') {
                let currentAnswers = this.answers.filter(answer => {
                    return answer.id === window.Laravel.currentAnswerId;
                });
                if (currentAnswers.length > 0) {
                    const answer = currentAnswers[0];
                    this.currentAnswerId = answer.id;
                }
            }
        },
        data() {
            return {
                itemsPerPage: 3,
                baseUrl: '',
                paginationPage: 0,
                currentPage: 0,
                showGraded: false,
                viewType: 'list',
                canUpdateEditKey: false,
                currentAnswerId: null,
                bootstrapPaginationClasses: {
                    ul: 'pagination',
                    li: 'page-item',
                    liActive: 'active',
                    liDisable: 'disabled',
                    button: 'page-link'
                }
            };
        },
        computed: {
            filteredAnswers() {
                return this.answers.filter(answer => {
                    return this.showGraded === false ? answer.grade === null : true;
                });
            },
            pages() {
                return Math.ceil(this.filteredAnswers.length / this.itemsPerPage);
            },
            answersPerPage() {
                const minIndex = this.itemsPerPage * (this.currentPage - 1);
                const maxIndex = minIndex + (this.itemsPerPage - 1);
                return this.filteredAnswers.filter((answer, index) => {
                    return index >= minIndex && index <= maxIndex;
                });
            }
        },
        watch: {
            paginationPage() {
                if (this.currentPage !== this.paginationPage) {
                    this.currentPage = this.paginationPage;
                    this.changePage();
                }
            }
        },
        methods: {
            resetEdit() {
                this.currentAnswerId = null;
            },
            reset() {
                this.setData({
                    currentPage: 1,
                    showGraded: false,
                    viewType: 'list',
                    currentAnswerId: null
                });
            },
            setData(data) {
                this.currentPage = data.currentPage;
                this.paginationPage = data.currentPage;
                this.showGraded = data.showGraded;
                this.viewType = data.viewType;
                this.currentAnswerId = data.currentAnswerId;
            },
            getData() {
                return {
                    currentPage: this.currentPage,
                    showGraded: this.showGraded,
                    viewType: this.viewType,
                    currentAnswerId: this.currentAnswerId
                };
            },
            onSwitchChange(isChecked) {
                this.showGraded = isChecked;
            },
            changePage() {
                window.history.pushState(this.getData(), 'index (' + this.currentPage + ')', '/grading/page/' + this.currentPage);
            },
            generatePaginationUrl(page) {
                return '/grading/page/' + page;
            }
        }
    }
</script>
<style scoped></style>