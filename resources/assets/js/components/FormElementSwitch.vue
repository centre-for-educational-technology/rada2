<template>
    <div class="switch-container">
        <span v-if="typeof label !== 'undefined'" class="switch-text" v-on:click="onLabelClick">{{ label }}</span>
        <label class="switch">
            <input type="checkbox" v-on:change="onChange" ref="input">
            <span class="slider round"></span>
        </label>
    </div>
</template>
<script>
    export default {
        props: ['onSwitchChange', 'label', 'defaultValue'],
        mounted() {
            setTimeout(() => {
                if (typeof this.defaultValue !== 'undefined' && this.defaultValue === true) {
                    this.$refs.input.checked = this.defaultValue === true;
                }
            }, 500);
        },
        watch: {
            defaultValue() {
                this.$refs.input.checked = this.defaultValue === true;
            }
        },
        methods: {
            onChange(e) {
                if (typeof this.onSwitchChange !== 'undefined') {
                    this.onSwitchChange(e.target.checked);
                }
            },
            onLabelClick() {
                this.$refs.input.click();
            }
        }
    }
</script>
<style scoped>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #f57c35;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #f57c35;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(21px);
        -ms-transform: translateX(21px);
        transform: translateX(21px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .switch-text {
        cursor: pointer;
        padding: 15px 5px;
    }
</style>