<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-10 col-md-8">
                    {{ $t('pages.grading.index.heading') }}
                </div>

                <div class="col-xs-2 col-md-4">
                    <div class="pull-right">
                        siia tuleb lyliti
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body" id="search-results">
            <div v-if="answers.length === 0" class="well">{{ $t('pages.grading.index.none-found') }}</div>
            <div v-if="answers.length > 0">
                <grading-list-item v-for="answer in answers" :answer="answer"></grading-list-item>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['answers'],
        components: {
            'grading-list-item': require('./GradingListItem.vue')
        },
        mounted() {
            this.$nextTick(() => {
                this.$nextTick(() => {
                    this.baseUrl = window.RADA.config.base_url;
                });
            });
        },
        data() {
            return {
                baseUrl: ''
            };
        },
        methods: {}
    }
</script>
<style scoped></style>