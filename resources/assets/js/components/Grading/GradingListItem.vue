<template>
    <div class="media">
        <div class="media-left">
            <a>
                <img class="media-object img-rounded sz-img-64x64"
                     :src="getQuestionTypeImageUrl()"
                     alt="featured-image">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                    Title: {{ answer.title }}
            </h4><br>
            ID: {{ answer.id }}<br>
            Type: {{ this.getQuestionTypeTranslation() }}<br>
            Answer: {{ answer.answer }}<br>
            Correct: {{ answer.correct }}<br>
            Description: {{ answer.description }}<br>
            Grade: {{ answer.grade }}<br>
            Image: {{ answer.image }}<br>
            Is answered: {{ answer.is_answered}}
        </div>
    </div>
</template>
<script>
    export default {
        props: ['answer'],
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
        methods: {
            getQuestionTypeImageUrl() {
                let list = {
                    1: 'information',
                    2: 'one-correct-answer',
                    3: 'multiple-correct-answers',
                    4: 'freeform-answer',
                    5: 'match-pairs',
                    6: 'embedded-content',
                    7: 'photo',
                };
                return this.baseUrl + '/img/icons/item/' + list[this.answer.type] + '.png';
            },
            getQuestionTypeTranslation() {
                return window.Laravel.questionTypes[this.answer.type];
            }
        }
    }
</script>
<style scoped></style>