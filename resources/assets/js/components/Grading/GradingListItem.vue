<template>
    <div class="media">
        <div class="media-left">
            <a>
                <img class="media-object img-rounded sz-img-52x60"
                     :src="getQuestionTypeImageUrl()"
                     alt="featured-image">
            </a>
            <div v-if="answer.grade !== null" class="grade-container">
                <div class="grade-label">{{ $t('pages.grading.index.graded') }}</div>
                <div class="grade">{{ answer.grade }}p</div>
            </div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <div class="col-xs-12 col-md-8">
                    <div class="row">
                        <a :href="href" class="question-title" v-on:click="onClickOpenEditView">{{ answer.title }}</a>
                        <div class="activity-title">{{ answer.activity_title }}</div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="row">
                        <a :href="href" class="pull-right btn btn-primary" v-on:click="onClickOpenEditView">
                            <i class="mdi mdi-school" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </h4>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="media sz-author">
                        <div class="media-left">
                            <i class="mdi mdi-account-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <div>{{ answer.user_name }}</div>
                            <div class="sz-date">
                                <i class="mdi mdi-clock" aria-hidden="true"></i>
                                {{ answer.created_at }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="sz-metadata">
                        <i class="mdi mdi-translate" aria-hidden="true"></i>
                        English
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="sz-metadata">
                        <i class="mdi mdi-crosshairs" aria-hidden="true"></i>
                        {{ this.getQuestionTypeTranslation() }}
                    </div>
                </div>
            </div>
        </div>
        <hr v-if="isLast === false" />
    </div>
</template>
<script>
    export default {
        props: ['answer', 'isLast'],
        mounted() {
            this.$nextTick(() => {
                this.$nextTick(() => {
                    this.baseUrl = window.RADA.config.base_url;
                    this.href = '/grading/' + this.answer.id + '/edit'
                });
            });
        },
        data() {
            return {
                baseUrl: '',
                href: ''
            };
        },
        methods: {
            onClickOpenEditView(e) {
                e.preventDefault();
                let editUrl = '/grading/' + this.answer.id + '/edit';
                let data = this.$parent.getData();
                data.currentAnswerId = this.answer.id;
                data.viewType = 'edit';
                this.$emit('setData', data);
                history.pushState(data, this.answer.title, editUrl);
                return false;
            },
            getQuestionTypeImageUrl() {
                let list = {
                    1: 'information',
                    2: 'one-correct-answer',
                    3: 'multiple-correct-answers',
                    4: 'freeform-answer',
                    5: 'match-pairs',
                    6: 'embedded-content',
                    7: 'photo',
                    8: 'missing-word'
                };
                let url = '/img/logos/logo-square.png';
                if (typeof list[this.answer.type] !== 'undefined') {
                    url = '/img/icons/item/' + list[this.answer.type] + '.png';
                }
                return this.baseUrl + url;
            },
            getQuestionTypeTranslation() {
                return window.Laravel.questionTypes[this.answer.type];
            }
        }
    }
</script>
<style scoped>
    .media .media-left {
        position: relative;
    }
    .media .media-left .grade-container {
        padding-top: 15px;
    }
    .media .media-left .grade-container .grade-label {
        color: green;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
    }
    .media .media-left .grade-container .grade {
        text-align: center;
    }
    .question-title {
        padding: 5px 0;
        display: block;
    }
    .activity-title {
        font-size: 14px;
    }
    .mdi-school {
        line-height: 36px;
    }
</style>