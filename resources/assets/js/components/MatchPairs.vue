<template>
<div id="question-type-match-pairs" class="sz-question">
    <div class="row sz-option-row" v-for="(option, index) in options">
        <div class="col-xs-4">
            <div class="input-group">
                <span class="input-group-addon" v-if="$parent.hasPreview(option)">
                    <a target="_blank" v-bind:href="$parent.getOptionImageUrl(option.image)">
                        <img class="sz-option-image-small" alt="option-image" v-bind:src="$parent.getOptionImageUrl(option.image)">
                    </a>
                </span>
                <input type="hidden" name="ids[]" v-model="option.id">
                <input type="text" class="form-control" name="options[]" v-model="option.option" v-bind:placeholder="$t('option-text')">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="input-group">
                <span class="input-group-addon" v-if="$parent.hasPreview(option, 'image_match', 'imageMatchPreview')">
                    <a target="_blank" v-bind:href="$parent.getOptionImageUrl(option.image_match)">
                        <img class="sz-option-image-small" alt="option-match-image" v-bind:src="$parent.getOptionImageUrl(option.image_match)">
                    </a>
                </span>
                <input
                        type="text"
                        class="form-control"
                        name="matches[]"
                        v-model="option.option_match"
                        v-bind:placeholder="$t('option-text')">
            </div>
        </div>
        <div class="col-xs-4 sz-btn-controls">
            <input
                    type="number"
                    class="form-control points-input"
                    :name="'points['+index+']'"
                    required="required"
                    v-bind:value="getPoints(index)"
            >
            <a href="#" class="btn sz-option-remove" tabindex="-1" v-on:click.prevent="removeOption(index)" v-bind:class="{ disabled: options.length < 2}">
                <i class="mdi mdi-close-circle-outline" aria-hidden="true"></i>
            </a>
        </div>
        <div class="col-xs-4">
            <input type="file" accept="image/jpeg, image/png" capture="camera" style="display:none;" v-bind:name="'option-image-' + index" v-on:change="imageSelected($event, index, 'add-image')" ref="option-image">
            <input type="checkbox" style="display:none;" v-bind:name="'removed-option-images[]'" ref="removed-option-images" v-bind:value="option.id" v-model="removedImages">

            <div class="btn-group btn-group-sm" role="group">
                <a href="#" class="btn sz-image-add" tabindex="-1" v-on:click.prevent="addImage(index, 'option-image')" v-bind:class="{ 'sz-option-has-image': option.image }" v-bind:title="option.image" data-toggle="tooltip" data-placement="top" ref="add-image">
                    <i class="mdi mdi-camera" aria-hidden="true"></i>
                </a>
                <a href="#" class="btn btn-danger" tabindex="-1" v-on:click.prevent="removeImage(index, false)" v-bind:class="{ disabled: !canRemoveImage(index, false) }" v-if="option.id && option.image_url" data-toggle="tooltip" data-placement="top" v-bind:title="$t('remove-existing-image')">
                    <i class="mdi mdi-checkbox-blank-outline" aria-hidden="true" v-if="!hasImageRemoved(index, false)"></i>
                    <i class="mdi mdi-checkbox-marked-outline" aria-hidden="true" v-if="hasImageRemoved(index, false)"></i>
                </a>
                <a href="#" class="btn btn-warning" tabindex="-1" v-on:click.prevent="removeSelectedImage(index, false)" v-bind:class="{ disabled: !canRemoveSelectedImage(index, false) }" data-toggle="tooltip" data-placement="top" v-bind:title="$t('remove-selected-image')">
                    <i class="mdi mdi-delete" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="col-xs-4">
            <input type="file" accept="image/jpeg, image/png" capture="camera" style="display:none;" v-bind:name="'option-match-image-' + index" v-on:change="imageSelected($event, index, 'add-match-image')" ref="option-match-image">
            <input type="checkbox" style="display:none;" v-bind:name="'removed-option-match-images[]'" ref="removed-option-match-images" v-bind:value="option.id" v-model="removedMatchImages">

            <div class="btn-group btn-group-sm" role="group">
                <a href="#" class="btn sz-image-add" tabindex="-1" v-on:click.prevent="addImage(index, 'option-match-image')" v-bind:class="{ 'sz-option-has-image': option.image_match }" v-bind:title="option.image_match" data-toggle="tooltip" data-placement="top" ref="add-match-image">
                    <i class="mdi mdi-camera" aria-hidden="true"></i>
                </a>
                <a href="#" class="btn btn-danger" tabindex="-1" v-on:click.prevent="removeImage(index, true)" v-bind:class="{ disabled: !canRemoveImage(index, true) }" v-if="option.id && option.image_match_url" data-toggle="tooltip" data-placement="top" v-bind:title="$t('remove-existing-image')">
                    <i class="mdi mdi-checkbox-blank-outline" aria-hidden="true" v-if="!hasImageRemoved(index, true)"></i>
                    <i class="mdi mdi-checkbox-marked-outline" aria-hidden="true" v-if="hasImageRemoved(index, true)"></i>
                </a>
                <a href="#" class="btn btn-warning" tabindex="-1" v-on:click.prevent="removeSelectedImage(index, true)" v-bind:class="{ disabled: !canRemoveSelectedImage(index, true) }" data-toggle="tooltip" data-placement="top" v-bind:title="$t('remove-selected-image')">
                    <i class="mdi mdi-delete" aria-hidden="true"></i>
                </a>
            </div>
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

            if ( this.$parent.hasRemovedImagesData() ) {
                this.removedImages = this.$parent.getRemovedImagesData();
            }

            if ( this.$parent.hasRemovedImageMatchesData() ) {
                this.removedMatchImages = this.$parent.getRemovedImageMatchesData();
            }

            this.$nextTick(() => {
                $(this.$el).find('[data-toggle="tooltip"]').tooltip();
            });
        },
        data() {
            return  {
                options: [],
                removedImages: [],
                removedMatchImages: []
            };
        },
        methods: {
            getPoints: function(index) {
                return this.options[index].points;
            },
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

                this.$nextTick(() => {
                    $(this.$el).find('[data-toggle="tooltip"]').tooltip();
                });
            },
            imageSelected: function(event, index, ref) {
                if ( !event.target.files.length > 0 ) return;

                if ( ref === 'add-match-image' ) {
                    this.options[index].imageMatchPreview = false;
                    this.options[index].imageMatchSelected = true;
                    this.options[index].image_match = event.target.files[0].name;
                } else {
                    this.options[index].imagePreview = false;
                    this.options[index].imageSelected = true;
                    this.options[index].image = event.target.files[0].name;
                }
                var element = $(this.$refs[ref][index]);

                this.$nextTick(() => {
                    const key = (ref === 'add-match-image') ? 'image_match' : 'image';

                    if ( element.data && element.data('original-title') ) {
                        element
                            .attr('data-original-title', element.attr('title'))
                            .removeAttr('title')
                            .tooltip('show');
                    } else {
                        element.attr('data-original-title', this.options[index][key]);
                        element.attr('title', this.options[index][key]);
                    }
                });
            },
            canRemoveSelectedImage(index, isMatch) {
                const key = isMatch ? 'imageMatchSelected' : 'imageSelected';
                return !!this.options[index][key];
            },
            canRemoveImage(index, isMatch) {
                const key = isMatch ? 'image_match_url' : 'image_url';
                return !!this.options[index][key] && !this.canRemoveSelectedImage(index, isMatch);
            },
            hasImageRemoved(index, isMatch) {
                const key = isMatch ? 'removedMatchImages' : 'removedImages';
                return this[key].indexOf(this.options[index].id) !== -1;
            },
            removeSelectedImage(index, isMatch) {
                if ( this.canRemoveSelectedImage(index, isMatch) ) {
                    const option = this.options[index];
                    const imageKey = isMatch ? 'image_match' : 'image';
                    const imageUrlKey = isMatch ? 'image_match_url' : 'image_url';
                    const imagePreviewKey = isMatch ? 'imageMatchPreview' : 'imagePreview';
                    const imageSelectedkey = isMatch ? 'imageMatchSelected' : 'imageSelected';
                    const imageInputRef = isMatch ? 'option-match-image' : 'option-image';
                    const imageSelectRef = isMatch ? 'add-match-image' : 'add-image';

                    if ( option[imageUrlKey] ) {
                        option[imageKey] = option[imageUrlKey].split('/').pop();
                        option[imagePreviewKey] = true;
                    } else {
                        option[imageKey] = '';
                    }
                    option[imageSelectedkey] = false;

                    $(this.$refs[imageInputRef][index]).val('');

                    const element = $(this.$refs[imageSelectRef][index]);

                    this.$nextTick(() => {
                        if ( option[imageKey] )
                        {
                            element.attr('data-original-title', option[imageKey]);
                        } else {
                            element.attr('title', '');
                            element.attr('data-original-title', '');
                        }
                    });
                }
            },
            removeImage(index, isMatch) {
                if ( this.canRemoveImage(index, isMatch) ) {
                    const key = isMatch ? 'removed-option-match-images' : 'removed-option-images';
                    $(this.$refs[key][index]).trigger('click');
                }
            }
        }
    }
</script>
<style>
    .sz-option-remove, .points-input {
        width: 50%;
    }
    .points-input {
        float: left;
    }
</style>