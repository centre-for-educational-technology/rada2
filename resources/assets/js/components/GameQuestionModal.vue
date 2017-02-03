<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" @keyup.esc="close()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ title() }}</h4>
                </div>
                <div class="modal-body">
                    <h3>Question</h3>
                    <p class="sz-display-new-lines">
                        {{ description() }}
                    </p>

                    <div v-if="isOneCorrectAnswer()">
                        <ul class="media-list">
                            <li class="media" v-for="(option, index) in options()">
                                <div class="media-left" v-if="option.image">
                                    <img v-bind:src="option.image" class="media-object" alt="option-image" style="max-width:150px;height:auto;">
                                </div>

                                <div class="media-body media-middle">
                                    <h4 class="media-heading">
                                        {{ option.option }}
                                    </h4>
                                </div>

                                <div class="media-right media-middle">
                                    <input type="radio" name="option" class="form-control" v-model="selectedOptions" v-bind:value="option.id" ref="option" style="display:none;">
                                    <i class="mdi mdi-radiobox-blank" v-if="!isSelectedOption(option.id)" v-on:click="triggerOptionClick(index)"></i>
                                    <i class="mdi mdi-radiobox-marked" v-if="isSelectedOption(option.id)"></i>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div v-if="isMultipleCorrectAnswers()">
                        <ul class="media-list">
                            <li class="media" v-for="(option, index) in options()">
                                <div class="media-left" v-if="option.image">
                                    <img v-bind:src="option.image" class="media-object" alt="option-image" style="max-width:150px;height:auto;">
                                </div>

                                <div class="media-body media-middle">
                                    <h4 class="media-heading">
                                        {{ option.option }}
                                    </h4>
                                </div>

                                <div class="media-right media-middle">
                                    <input type="checkbox" name="options[]" class="form-control" v-model="selectedOptions" v-bind:value="option.id" ref="option" style="display:none;">
                                    <i class="mdi mdi-checkbox-blank-circle-outline" v-if="!isSelectedOption(option.id)" v-on:click="triggerOptionClick(index)"></i>
                                    <i class="mdi mdi-checkbox-marked-circle-outline" v-if="isSelectedOption(option.id)" v-on:click="triggerOptionClick(index)"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="form-group" v-if="isFreeformAnswer()">
                    <textarea class="form-control" v-model="textualAnswer"></textarea>
                </div>

                <div v-if="isMatchPairs()">
                    <div class="alert alert-danger">
                        <strong>This is just a preview, not a working match pairs!</strong>
                    </div>

                    <div class="row" v-for="(pair, index) in pairs()">
                        <div class="col-xs-6">
                            <img v-if="pair.image" v-bind:src="pair.image" class="media-object" alt="pair-image" style="max-width:100%;height:auto;">
                            <div>
                                {{ pair.option }}
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <img v-if="pair.image_match" v-bind:src="pair.image_match" class="media-object" alt="pair-image" style="max-width:100%;height:auto;">
                            <div>
                                {{ pair.option_match }}
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="isEmbeddedContent()">
                    <div class="embed-responsive embed-responsive-16by9" v-html="embeddedContent()">
                    </div>
                </div>

                <div v-if="isPhoto()" style="text-align: center;">
                    <a href="#" class="btn sz-take-image" tabindex="-1" v-on:click.prevent="triggerImageClick()" v-bind:class="{ 'sz-image-taken': hasImageSelected }" style="font-size: 96px;">
                        <i class="mdi mdi-camera" aria-hidden="true"></i>
                    </a>
                    <input type="file" accept="image/*" capture="camera" style="display:none;" name="image" ref="image" v-on:change="imageSelected()">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" v-on:click="close()">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['question'],
        mounted() {
        },
        data() {
            return {
                selectedOptions: [],
                textualAnswer: '',
                hasImageSelected: false
            };
        },
        methods: {
            open() {
                this.$nextTick(function() {
                    $(this.$refs.modal).modal('show');
                });
            },
            close() {
                this.$nextTick(function() {
                    $(this.$refs.modal).modal('hide');
                    this.selectedOptions = [];
                    this.textualAnswer = '';
                    this.hasImageSelected = false;
                });
            },
            title() {
                return this.question ? this.question.title : '';
            },
            description() {
                return this.question ? this.question.description : '';
            },
            embeddedContent() {
                return this.question ? this.question.embedded_content : '';
            },
            options() {
                return ( this.question && this.question.options ) ? this.question.options : [];
            },
            pairs() {
                return ( this.question && this.question.pairs ) ? this.question.pairs : [];
            },
            isOneCorrectAnswer() {
                return this.question ? this.question.type == 2 : false;
            },
            isMultipleCorrectAnswers() {
                return this.question ? this.question.type == 3 : false;
            },
            isFreeformAnswer() {
                return this.question ? this.question.type == 4 : false;
            },
            isMatchPairs() {
                return this.question ? this.question.type == 5 : false;
            },
            isEmbeddedContent() {
                return this.question ? this.question.type == 6 : false;
            },
            isPhoto() {
                return this.question ? this.question.type == 7 : false;
            },
            isSelectedOption(id) {
                if ( this.selectedOptions && typeof this.selectedOptions === 'object' ) {
                    return this.selectedOptions.indexOf(id) !== -1;
                }

                return this.selectedOptions === id;
            },
            triggerOptionClick(index) {
                $(this.$refs['option'][index]).trigger('click');
            },
            triggerImageClick() {
                $(this.$refs.image).trigger('click');
            },
            imageSelected() {
                // TODO It might be needed to do something with the file selected
                console.log('File selected', event.target.files[0]);
                this.hasImageSelected = true;
            }
        }
    }
</script>
