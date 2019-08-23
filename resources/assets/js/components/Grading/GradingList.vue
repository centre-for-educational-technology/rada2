<template>
    <div class="panel panel-default">
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
                <grading-list-item v-for="answer in answersPerPage" :answer="answer"></grading-list-item>
                <pagination
                        v-model="currentPage"
                        :page-count="pages"
                        :classes="bootstrapPaginationClasses"
                        :labels="paginationAnchorTexts"
                ></pagination>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['answers'],
        components: {
            'grading-list-item': require('./GradingListItem.vue'),
            'pagination': require('../vue-plain-pagination.vue'),
            'form-element-switch': require('../FormElementSwitch.vue')
        },
        mounted() {
            this.$nextTick(() => {
                this.$nextTick(() => {
                    this.baseUrl = window.RADA.config.base_url;
                    this.getDataFromHash(window.location.hash);
                });
            });
        },
        data() {
            return {
                itemsPerPage: 3,
                baseUrl: '',
                currentPage: 1,
                showGraded: false,
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
            currentPage() {
                this.changeHash();
            }
        },
        methods: {
            onSwitchChange(isChecked) {
                this.showGraded = isChecked;
            },
            getDataFromHash(hash) {
                let hashParts = hash.replace('#', '').split('&');
                let hashPartsLength = hashParts.length;
                for (let i=0; i<hashPartsLength; i++) {
                    let hashPart = hashParts[i];
                    let data = hashPart.split('=');
                    if (data.length === 2) {
                        if (data[0] === 'page') {
                            this.currentPage = parseInt(data[1]);
                        }
                    }
                }
            },
            changeHash() {
                window.location.hash = 'page=' + this.currentPage;
            }
        }
    }
</script>
<style scoped></style>