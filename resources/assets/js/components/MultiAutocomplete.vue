<template>
    <div class="multi-autocomplete-container">
        <input
                type="hidden"
                class="multi-autocomplete-hidden-input"
                v-bind:name="name"
                v-bind:value="hiddenValue"
        />
        <div v-bind:class="baseClass">
            <div class="bootstrap-tagsinput" @click="onContainerClick" ref="tagInput">
                <span class="tag label label-info" v-for="item in hiddenList">
                    {{ item }}
                    <span data-role="remove" @click="onItemRemoveClick"></span>
                </span>
                <input
                        v-bind:id="id"
                        v-bind:class="inputClass"
                        v-bind:value="value"
                        v-bind:typeof="type"
                        @keyup="onChange"
                        ref="input"
                />
            </div>
        </div>
        <div class="multi-autocomplete-list-container" ref="listContainer">
            <ul class="multi-autocomplete-list" v-if="list.length > 0">
                <li class="multi-autocomplete-item"
                    v-for="item in list"
                    @click="onItemClick"
                >{{ item }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'baseClass', 'inputClass', 'name', 'defaultValue', 'type', 'search'],
        mixins: [],
        mounted() {
            this.hiddenValue = this.defaultValue;
            this.hiddenList = this.hiddenValue.trim().split(',').filter(item => {
                return item !== "";
            });
            this.removeDuplicateValues();
            this.moveListContainer();
        },
        data() {
            return {
                value: '',
                hiddenValue: '',
                list: [],
                hiddenList: []
            }
        },
        watch: {},
        methods: {
            onChange(evt) {
                if( evt.keyCode === 188) {
                    if (this.list.length > 0) {
                        let firstItem = this.list.shift();
                        this.addValueToHiddenList(firstItem);
                    }
                    this.value = '';
                    return true;
                }
                this.value = evt.target.value;
                this.list = this.search(this.value);
                if (this.value !== '') {
                    this.list.unshift(this.value);
                }
                this.removeDuplicateValues();
                this.moveListContainer();
            },
            onItemClick(evt) {
                this.value = '';
                this.list = [];
                let val = evt.target.innerText;
                this.addValueToHiddenList(val);
            },
            addValueToHiddenList(val) {
                if (this.hasHiddenItem(val) === false) {
                    this.hiddenList.push(val);
                    this.hiddenValue = this.hiddenList.join(',')
                    this.$refs.input.focus();
                    this.moveListContainer();
                }
            },
            onItemRemoveClick(evt) {
                let text = evt.target.parentElement.innerText.trim();
                this.hiddenList = this.hiddenList.filter(item => {
                    return item !== text;
                });
            },
            onContainerClick() {
                this.$refs.input.focus();
            },
            hasHiddenItem(val) {
                return typeof this.hiddenList.find(item => {
                    return val === item;
                }) !== 'undefined';
            },
            removeDuplicateValues() {
                this.list = this.list.filter(item => {
                    return item !== "" && this.hasHiddenItem(item) === false;
                });
            },
            moveListContainer() {
                this.$nextTick(() => {
                    this.$refs.listContainer.style.top =
                        (this.$refs.tagInput.offsetHeight - 2) + 'px';
                });
            }
        }
    }
</script>
<style scoped>
    .multi-autocomplete-list-container {
        position: absolute;
        top: 36px;
        left: 15px;
        right: 15px;
        z-index: 20;
        background: #FFF;
    }
    .multi-autocomplete-list-container ul {
        margin: 0;
        padding: 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        border-top: 1px solid #ccc;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .multi-autocomplete-list-container ul li {
        margin: 0;
        padding: 10px;
    }
    .multi-autocomplete-container .form-control {
        height: auto;
        display: inline-block;
        border: 0;
        padding: 0;
    }
    .multi-autocomplete-container .bootstrap-tagsinput .label {
        display: inline-block;
    }
</style>