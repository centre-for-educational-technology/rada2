<template>
<div id="question-type-match-pairs" class="sz-question">
    <div class="row sz-option-row" v-for="(option, index) in options">
        <div class="col-xs-5">
            <div class="input-group">
                <input type="text" class="form-control" name="options[]" v-model="option.text">
                <span class="input-group-addon">
                    <a href="#" class="btn sz-image-add" tabindex="-1" v-on:click.prevent="addImage(index, 'option-image')" v-bind:class="{ 'sz-option-has-image': option.image }" v-bind:title="option.image" data-toggle="tooltip" data-placement="top" ref="add-image">
                        <i class="mdi mdi-camera" aria-hidden="true"></i>
                    </a>
                    <input type="file" accept="image/*" capture="camera" style="display:none;" v-bind:name="'option-image-' + index" v-on:change="imageSelected(index, 'add-image')" ref="option-image">
                </span>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="input-group">
                <input type="text" class="form-control" name="matches[]" v-model="option.matchText">
                <span class="input-group-addon">
                    <a href="#" class="btn sz-image-add" tabindex="-1" v-on:click.prevent="addImage(index, 'option-match-image')" v-bind:class="{ 'sz-option-has-image': option.matchImage }" v-bind:title="option.matchImage" data-toggle="tooltip" data-placement="top" ref="add-match-image">
                        <i class="mdi mdi-camera" aria-hidden="true"></i>
                    </a>
                    <input type="file" accept="image/*" capture="camera" style="display:none;" v-bind:name="'option-match-image-' + index" v-on:change="imageSelected(index, 'add-match-image')" ref="option-match-image">
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
                <i class="mdi mdi-plus-circle-outline" aria-hidden="true" title="Add option"></i>
            </a>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('MatchPairs Component ready.');
        },
        data() {
            return  {
                options: [
                    {
                        text: '',
                        image: '',
                        matchText: '',
                        matchImage: ''
                    },
                    {
                        text: '',
                        image: '',
                        matchText: '',
                        matchImage: ''
                    },
                    {
                        text: '',
                        image: '',
                        matchText: '',
                        matchImage: ''
                    },
                    {
                        text: '',
                        image: '',
                        matchText: '',
                        matchImage: ''
                    }
                ]
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
                    text: '',
                    image: '',
                    matchText: '',
                    matchImage: ''
                });
            },
            imageSelected: function(index, ref) {
                if ( !event.target.files.length > 0 ) return;

                if ( ref === 'add-match-image' ) {
                    this.options[index].matchImage = event.target.files[0].name;
                } else {
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
