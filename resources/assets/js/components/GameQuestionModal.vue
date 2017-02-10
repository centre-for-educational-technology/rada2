<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" @keyup.esc="close()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()" v-bind:diabled="inAjaxCall"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ title() }}</h4>
                </div>
                <div class="modal-body">
                    <p class="sz-display-new-lines">{{ description() }}</p>

                    <div v-if="isOneCorrectAnswer()">
                        <ul class="media-list sz-one-correct-answer">
                            <li class="media" v-for="(option, index) in options()" v-on:click="triggerOptionClick(index)">
                                <div class="media-left" v-if="option.image">
                                    <img v-bind:src="option.image" class="media-object" alt="option-image">
                                </div>

                                <div class="media-body media-middle">
                                    <h4 class="media-heading">{{ option.option }}</h4>
                                </div>

                                <div class="media-right media-middle">
                                    <input type="radio" name="option" class="form-control" v-model="selectedOptions" v-bind:value="option.id" ref="option">
                                    <i class="mdi mdi-radiobox-blank" v-if="!isSelectedOption(option.id)"></i>
                                    <i class="mdi mdi-radiobox-marked" v-if="isSelectedOption(option.id)" v-bind:class="{ correct: isCorrectlyAnswered(option.id), incorrect: isIncorrectlyAnswered(option.id) }"></i>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div v-if="isMultipleCorrectAnswers()">
                        <ul class="media-list sz-multiple-correct-answers">
                            <li class="media" v-for="(option, index) in options()" v-on:click="triggerOptionClick(index)">
                                <div class="media-left" v-if="option.image">
                                    <img v-bind:src="option.image" class="media-object" alt="option-image">
                                </div>

                                <div class="media-body media-middle">
                                    <h4 class="media-heading">{{ option.option }}</h4>
                                </div>

                                <div class="media-right media-middle">
                                    <input type="checkbox" name="options[]" class="form-control" v-model="selectedOptions" v-bind:value="option.id" ref="option">
                                    <i class="mdi mdi-checkbox-blank-outline" v-if="!isSelectedOption(option.id)"></i>
                                    <i class="mdi mdi-checkbox-marked-outline" v-if="isSelectedOption(option.id)" v-bind:class="{ correct: isCorrectlyAnswered(option.id), incorrect: isIncorrectlyAnswered(option.id) }"></i>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div v-if="isFreeformAnswer()">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Textual Answer ..." v-model="textualAnswer"></textarea>
                        </div>
                    </div>

                    <div v-if="isMatchPairs()">
                        <div class="row sz-match-pairs">
                            <div class="col-xs-6">
                                <div class="row" v-for="pair in pairs()">
                                    <div class="col-xs-12">
                                        <div class="sz-matchable" v-on:click="choosePair(pair)" v-bind:class="{ 'chosen': isOptionChosen(pair), 'matched': isMatchedPair(pair) }" v-bind:style="matchableStyles" ref="matchable">
                                            <img v-if="pair.image" v-bind:src="pair.image" class="media-object" alt="pair-image">
                                            <div>{{ pair.option }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="row" v-for="pair in pairs(true)">
                                    <div class="col-xs-12">
                                        <div class="sz-matchable" v-on:click="choosePairMatch(pair)" v-bind:class="{ 'chosen': isOptionMatchChosen(pair), 'matched': isMatchedPair(pair) }" v-bind:style="matchableStyles" ref="matchable">
                                            <img v-if="pair.image_match" v-bind:src="pair.image_match" class="media-object" alt="pair-image">
                                            <div>{{ pair.option_match }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="isEmbeddedContent()">
                        <div class="embed-responsive embed-responsive-16by9" v-html="embeddedContent()"></div>

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Textual Answer ..." v-model="textualAnswer"></textarea>
                        </div>
                    </div>

                    <div v-if="isPhoto()" class="sz-photo">
                        <div class="row text-center">
                            <a href="#" class="btn sz-take-image" tabindex="-1" v-on:click.prevent="triggerImageClick()" v-bind:class="{ 'sz-image-taken': hasImageSelected }">
                                <i class="mdi mdi-camera" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="row" v-show="hasImageSelected">
                            <div class="col-xs-10 col-xs-offset-1">
                                <img v-bind:src="imageSrc" alt="uploadable-image" class="sz-uploadable-image">
                            </div>
                        </div>
                        <input type="file" accept="image/*" capture="camera" name="image" ref="image" v-on:change="imageSelected()">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" v-on:click="close()" v-bind:disabled="inAjaxCall">Close</button>
                    <button type="button" class="btn btn-primary" v-bind:disabled="!canSubmit() || inAjaxCall" v-on:click="submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['question', 'gameId'],
        mounted() {
            var vm = this;

            this.$nextTick(() => {
                $(this.$refs.modal).on('hide.bs.modal', e => {
                    if ( vm.inAjaxCall ) {
                        e.preventDefault();
                    }
                });
            });
        },
        data() {
            return {
                selectedOptions: [],
                textualAnswer: '',
                hasImageSelected: false,
                imageSrc: null,
                chosenPair: {
                    option: null,
                    match: null
                },
                matchedPairs: [],
                shuffledPairs: [],
                matchableStyles: {
                    'min-height': '100px'
                },
                inAjaxCall: false
            };
        },
        methods: {
            open() {
                this.$nextTick(() => {
                    if ( this.isMatchPairs() ) {
                        if ( this.pairs().length > 0 ) {
                            this.question.pairs = _.shuffle(this.pairs())

                            // TODO Check solution, move to standalone function
                            // Make sure it is also applied on page resize
                            this.$nextTick(() => {
                                var vm = this;

                                setTimeout(() => {
                                    var heights = _.map(this.$refs.matchable, (matchable) => {
                                        return $(matchable).outerHeight(true);
                                    });
                                    var highest = _.max(heights);
                                    if ( highest ) {
                                        vm.matchableStyles['min-height'] = highest + 'px';
                                    }
                                }, 250);
                            });
                        }
                        this.shuffledPairs = _.shuffle(this.pairs());
                    }

                    $(this.$refs.modal).modal('show');
                });
            },
            close() {
                if ( this.inAjaxCall ) return;

                this.$nextTick(() => {
                    $(this.$refs.modal).modal('hide');
                    this.selectedOptions = [];
                    this.textualAnswer = '';
                    this.hasImageSelected = false;
                    this.imageSrc = null;
                    this.chosenPair.option = null;
                    this.chosenPair.mathc = null;
                    this.matchedPairs = [];
                    this.matchableStyles['min-height'] = '100px';
                    this.inAjaxCall = false;
                });
            },
            submit() {
                if ( this.inAjaxCall ) return;

                var vm = this;

                this.inAjaxCall = true;

                var data = {
                    'game_id': this.gameId,
                    'question_id': this.question.id,
                };

                if ( this.isOneCorrectAnswer() || this.isMultipleCorrectAnswers() ) {
                    data.options = this.selectedOptions;
                } else if ( this.isFreeformAnswer() || this.isEmbeddedContent() ) {
                    data.text = this.textualAnswer;
                }

                if ( this.isPhoto() ) {
                    var formData = new FormData();

                    _.each(data, (item, key) => {
                        formData.append(key, item);
                    });

                    formData.append('image', this.$refs.image.files[0]);

                    data = formData;
                    console.log('zz', data);
                }
                // TODO Need to configure the URL (not important but should still work with subdir installss)
                this.$http.post('/api/games/answer', data).then(response => {
                    vm.inAjaxCall = false;

                    vm.close();
                    // XXX This should not be set like that
                    // A more elegant and meaningful way is needed
                    vm.$parent.markAnswered(this.question.id, response.body);
                }, response => {
                    vm.inAjaxCall = false;
                    console.error('Error', response);
                    // TODO Might need to notify user abut the error
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
            pairs(shuffled) {

                if ( shuffled === true ) {
                    return this.shuffledPairs;
                }

                return ( this.question && this.question.pairs ) ? this.question.pairs : [];
            },
            isInformation() {
                return this.question ? this.question.type == 1 : false;
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
                console.log('File selected', event.target.files[0]);
                // TODO Make sure to only allow JPG/JPEG and PNG
                if ( event.target.files.length > 0 ) {
                    if ( window.FileReader ) {
                        var reader = new FileReader(),
                            vm = this;

                        reader.onload = (e) => {
                            vm.imageSrc = e.target.result;
                        };

                        reader.readAsDataURL(event.target.files[0]);
                    }

                    this.hasImageSelected = true;
                }
            },
            canSubmit() {
                if ( this.isInformation() ) {
                    return true;
                } else if ( this.isOneCorrectAnswer() || this.isMultipleCorrectAnswers() ) {
                    if ( typeof this.selectedOptions === 'object' ) {
                        return this.selectedOptions.length > 0;
                    } else {
                        return !!this.selectedOptions;
                    }
                    return !!this.selectedOptions;
                } else if ( this.isFreeformAnswer() || this.isEmbeddedContent() ) {
                    return !!this.textualAnswer.trim();
                } else if ( this.isMatchPairs() ) {
                    return this.matchedPairs.length === this.pairs().length;
                } else if ( this.isPhoto() ) {
                    return this.hasImageSelected;
                }

                return false;
            },
            resetChosenPair() {
                this.$nextTick(() => {
                    var vm = this;
                    setTimeout(() => {
                        vm.chosenPair.option = null;
                        vm.chosenPair.match = null;
                    }, 250);
                });
            },
            choose(type, pair) {
                if ( this.isMatchedPair(pair) ) {
                    return;
                }

                this.chosenPair[type] = pair.id;

                if ( this.chosenPair.option === this.chosenPair.match ) {
                    this.matchedPairs.push(pair.id);
                    this.resetChosenPair();
                } else if ( this.chosenPair.option !== null && this.chosenPair.match !== null ) {
                    this.resetChosenPair();
                }
            },
            choosePair(pair) {
                this.choose('option', pair);
            },
            choosePairMatch(pair) {
                this.choose('match', pair);
            },
            isOptionChosen(pair) {
                return this.chosenPair.option === pair.id;
            },
            isOptionMatchChosen(pair) {
                return this.chosenPair.match === pair.id;
            },
            isMatchedPair(pair) {
                return this.matchedPairs.indexOf(pair.id) !== -1;
            },
            isCorrectlyAnswered(id) {
                // TODO Check if ajaxHasBroughtInCorrectAnswers
                // and act
                return false;
            },
            isIncorrectlyAnswered(id) {
                // TODO Check if ajaxHasBroughtIncorrectAnswers
                // and act
                return false;
            }
        }
    }
</script>