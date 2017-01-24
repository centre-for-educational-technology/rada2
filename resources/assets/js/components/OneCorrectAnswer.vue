<template>
<div id="question-type-one-correct-answer" class="sz-question">
    <div class="row sz-option-row" v-for="(option, index) in options">
        <div class="col-xs-9">
            <div class="input-group">
                <span class="input-group-addon" v-if="$parent.hasPreview(option)">
                    <a target="_blank" v-bind:href="$parent.getOptionImageUrl(option.image)">
                        <img class="sz-option-image-small" alt="option-image" v-bind:src="$parent.getOptionImageUrl(option.image)">
                    </a>
                </span>
                <input type="hidden" name="ids[]" v-model="option.id">
                <input type="text" class="form-control" name="options[]" v-model="option.option">
                <span class="input-group-addon">
                    <input type="radio" name="correct" aria-label="Correct" tabindex="-1" v-bind:value="index" v-model="checkedOption">
                </span>
            </div>
        </div>
        <div class="col-xs-3 sz-btn-controls">
            <a href="#" class="btn sz-image-add" tabindex="-1" v-on:click.prevent="addImage(index)" v-bind:class="{ 'sz-option-has-image': option.image }" v-bind:title="option.image" data-toggle="tooltip" data-placement="top" ref="add-image">
                <i class="mdi mdi-camera" aria-hidden="true"></i>
            </a>
            <input type="file" accept="image/*" capture="camera" style="display:none;" v-bind:name="'option-image-' + index" v-on:change="imageSelected(index)" ref="option-image">
            <a href="#" class="btn sz-option-remove" tabindex="-1" v-on:click.prevent="removeOption(index)" v-bind:class="{ disabled: options.length < 2}">
                <i class="mdi mdi-close-circle-outline" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <a href="#" class="btn" tabindex="-1" v-on:click.prevent="addOption">
                <i class="mdi mdi-plus-circle-outline" aria-hidden="true" title="Add option"></i>
            </a>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            if ( this.$parent.hasQuestionData() ) {
                this.options = this.$parent.getQuestionData();
                this.checkedOption = _.findIndex(this.options, function(o) { return o.correct === 1; });
            } else {
                this.options = [
                    {
                        id: 0,
                        option: '',
                        image: ''
                    },
                    {
                        id: 0,
                        option: '',
                        image: ''
                    },
                    {
                        id: 0,
                        option: '',
                        image: ''
                    },
                    {
                        id: 0,
                        option: '',
                        image: ''
                    }
                ];
            }
        },
        data() {
            return  {
                options: [],
                checkedOption: -1
            };
        },
        methods: {
            addImage: function(index) {
                $(this.$refs['option-image'][index]).trigger('click');
            },
            removeOption: function(index) {
                if ( this.options.length < 2) {
                    return;
                }

                this.options.splice(index, 1);

                if ( this.checkedOption === index ) {
                    this.checkedOption = -1;
                } else if ( this.checkedOption > index ) {
                    this.checkedOption -= 1;
                }
            },
            addOption: function() {
                this.options.push({
                    id: 0,
                    option: '',
                    image: ''
                });
            },
            imageSelected: function(index) {
                if ( !event.target.files.length > 0 ) return;

                this.options[index].image = event.target.files[0].name;
                this.options[index].imagePreview = false;
                var element = $(this.$refs['add-image'][index]);

                this.$nextTick(() => {
                    if ( element.data && element.data('original-title') ) {
                        element
                            .attr('data-original-title', element.attr('title'))
                            .removeAttr('title')
                            .tooltip('show');
                    } else {
                        element.tooltip();
                    }
                });
            }
        }
    }
</script>
