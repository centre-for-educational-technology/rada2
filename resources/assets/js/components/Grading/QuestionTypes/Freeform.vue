<template>
    <div v-if="show()">
        <h4>Answer text</h4>
        <p>
            {{ answer.answer }}
        </p>
    </div>
</template>
<script>
    export default {
        props: ['answer'],
        methods: {
            show() {
                return this.$parent.isFreeformAnswer();
            }
        }
    }
</script>