<template>
    <div class="multi-autocomplete-container">
        <input
                v-bind:id="id"
                v-bind:class="baseClass"
                v-bind:name="name"
                v-bind:value="defaultValue"
                v-bind:typeof="type"
                @keyup="onChange"
        />
        <div class="multi-autocomplete-list-container" v-if="list.length > 0">
            <ul class="multi-autocomplete-list">
                <li class="multi-autocomplete-item" v-for="item in list">{{ item }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'baseClass', 'name', 'defaultValue', 'type', 'search'],
        mixins: [],
        mounted() {},
        data() {
            return {
                list: []
            }
        },
        watch: {},
        methods: {
            onChange(evt) {
                let val = evt.target.value;
                this.list = this.search(val);
                this.defaultValue = val;
                return true;
            }
        }
    }
</script>
<style scoped>
    .multi-autocomplete-list-container {
        position: absolute;
        top: 36px;
        left: 0;
        z-index: 20;
        background: #FFF;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
        border-top: 0;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .multi-autocomplete-list-container ul {
        margin: 0;
        padding: 0;
    }
    .multi-autocomplete-list-container ul li {
        margin: 0;
        padding: 10px;
    }
</style>