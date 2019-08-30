<template>
    <div>
        <h4>{{ $t('pages.grading.index.heading-grade')}}</h4>
        <div class="form-group">
            <input
                    v-model="inputGrade"
                    type="number"
                    class="form-control pull-left grade-input"
            />
            <input
                    v-on:click="onButtonSubmit"
                    :value="$t('pages.grading.index.submit-grade')"
                    type="button"
                    class="btn btn-primary"
            />
            <div>{{ $t('pages.grading.index.grading-info') }} {{ maxGrade }}</div>
        </div>
    </div>
</template>
<script>
    import gradingMixin from "./gradingMixin";
    export default {
        props: {
            maxGrade: {
                type: Number,
                required: true
            },
            answerId: {
                type: Number,
                required: true
            },
            grade: {
                type: Number,
                required: true
            }
        },
        mixins: [gradingMixin],
        data() {
            return {
                inputGrade: 0
            }
        },
        watch: {
            inputGrade () {
                const maxGrade = this.getMaxGrade();
                if (this.inputGrade > maxGrade) {
                    this.inputGrade = maxGrade;
                } else if (this.inputGrade < 0) {
                    this.inputGrade = 0;
                }
            },
            grade () {
                this.inputGrade = this.grade;
            }
        },
        mounted() {
            this.$nextTick(() => {
                if (this.grade !== null) {
                    this.inputGrade = this.grade;
                } else {
                    this.inputGrade = this.maxGrade;
                }
            });
        },
        methods: {
        }
    }
</script>
<style scoped>
    .grade-input {
        width: 100px;
        margin-right: 15px;
    }
</style>