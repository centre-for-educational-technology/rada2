<template>
    <div>
        <h4>Grade text</h4>
        <div>
            <input
                    v-model="grade"
                    type="text"
            />
            <input
                    v-on:click="onButtonSubmit"
                    :value="buttonValue"
                    type="button"
                    class="btn btn-xs btn-primary"
            />
            <span>You can enter value between 0 and {{ maxGrade }} text</span>
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
            onSubmit: {
                type: Function,
                required: true
            },
            buttonValue: {
                type: String,
                required: true
            }
        },
        mixins: [gradingMixin],
        data() {
            return {
                grade: 0
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.grade = this.maxGrade
            });
        },
        methods: {
        }
    }
</script>
<style scoped>

</style>