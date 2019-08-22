<template>
    <div v-if="show()">
        <img class="image" v-if="image != null" :src="image" />


        <h4>Grade text</h4>
        <div>
            <input type="text" />
            <input type="button" class="btn btn-xs btn-primary" />
            <span>You can enter value between 0 and 20 text</span>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['answer'],
        data() {
            return {
                image: this.answer.answer_image ? '/uploads/images/activities/'
                    + this.answer.activity_id + '/'
                    + this.answer.game_id + '/'
                    + this.answer.answer_image : null,
            }
        },
        methods: {
            show() {
                return this.$parent.isPhoto();
            }
        }
    }
</script>
<style scoped>
    .image {
        max-width: 100%;
    }
</style>