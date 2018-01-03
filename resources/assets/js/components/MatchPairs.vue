<template>
<div id="question-type-match-pairs" class="sz-question">
    <div class="row sz-option-row" v-for="(option, index) in options">
        <div class="col-xs-5">
            <div class="input-group">
                <span class="input-group-addon" v-if="$parent.hasPreview(option)">
                    <a target="_blank" v-bind:href="$parent.getOptionImageUrl(option.image)">
                        <img class="sz-option-image-small" alt="option-image" v-bind:src="$parent.getOptionImageUrl(option.image)">
                    </a>
                </span>
                <input type="hidden" name="ids[]" v-model="option.id">
                <input type="text" class="form-control" name="options[]" v-model="option.option" v-bind:placeholder="$t('option-text')">
                <span class="input-group-addon">
                    <a href="#" class="btn sz-image-add" tabindex="-1" v-on:click.prevent="addImage(index, 'option-image')" v-bind:class="{ 'sz-option-has-image': option.image }" v-bind:title="option.image" data-toggle="tooltip" data-placement="top" ref="add-image">
                        <i class="mdi mdi-camera" aria-hidden="true"></i>
                    </a>
                    <input type="file" accept="image/*" capture="camera" style="display:none;" v-bind:name="'option-image-' + index" v-on:change="imageSelected($event, index, 'add-image')" ref="option-image">
                </span>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="input-group">
                <span class="input-group-addon" v-if="$parent.hasPreview(option, 'image_match', 'imageMatchPreview')">
                    <a target="_blank" v-bind:href="$parent.getOptionImageUrl(option.image_match)">
                        <img class="sz-option-image-small" alt="option-match-image" v-bind:src="$parent.getOptionImageUrl(option.image_match)">
                    </a>
                </span>
                <input type="text" class="form-control" name="matches[]" v-model="option.option_match" v-bind:placeholder="$t('option-text')">
                <span class="input-group-addon">
                    <a href="#" class="btn sz-image-add" tabindex="-1" v-on:click.prevent="addImage(index, 'option-match-image')" v-bind:class="{ 'sz-option-has-image': option.image_match }" v-bind:title="option.image_match" data-toggle="tooltip" data-placement="top" ref="add-match-image">
                        <i class="mdi mdi-camera" aria-hidden="true"></i>
                    </a>
                    <input type="file" accept="image/*" capture="camera" style="display:none;" v-bind:name="'option-match-image-' + index" v-on:change="imageSelected($event, index, 'add-match-image')" ref="option-match-image">
                </span>
            </div>
        </div>
        <div class="col-xs-2 sz-btn-controls">
            <a href="#" class="btn sz-option-remove" tabindex="-1" v-on:click.prevent="removeOption(index)" v-bind:class="{ disabled: options.length < 2}">
                <i class="mdi mdi-close-circle-outline" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <a href="#" class="btn" tabindex="-1" v-on:click.prevent="addOption">
                <i class="mdi mdi-plus-circle-outline" aria-hidden="true" v-bind:title="$t('add-option')"></i>
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
            } else {
                this.options = [
                    {
                        id: 0,
                        option: '',
                        image: '',
                        option_match: '',
                        image_match: '',
                    },
                    {
                        id: 0,
                        option: '',
                        image: '',
                        option_match: '',
                        image_match: '',
                    },
                    {
                        id: 0,
                        option: '',
                        image: '',
                        option_match: '',
                        image_match: '',
                    },
                    {
                        id: 0,
                        option: '',
                        image: '',
                        option_match: '',
                        image_match: ''
                    }
                ];
            }
        },
        data() {
            return  {
                options: []
            };
        },
        methods: {
            addImage: function(index, ref) {
                $(this.$refs[ref][index]).trigger('click');
            },
            removeOption: function(index) {
                if ( this.options.length < 2) {
                    return;
                }

                this.options.splice(index, 1);
            },
            addOption: function() {
                this.options.push({
                    id: 0,
                    option: '',
                    image: '',
                    option_match: '',
                    image_match: ''
                });
            },
            imageSelected: function(event, index, ref) {
                if ( !event.target.files.length > 0 ) return;

                if ( ref === 'add-match-image' ) {
                    this.options[index].imageMatchPreview = false;
                    this.options[index].image_match = event.target.files[0].name;
                } else {
                    this.options[index].imagePreview = false;
                    this.options[index].image = event.target.files[0].name;
                }
                var element = $(this.$refs[ref][index]);

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
