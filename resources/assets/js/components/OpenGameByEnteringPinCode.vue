<template>
    <div class="open-game-by-entering-pin-code-container">
        <div class="col-xs-12" ref="markerButtonContainer">
            <button class="btn btn-default sz-quick-play-btn" @click="onMarkerButtonClick">
                <i class="mdi mdi-map-marker" aria-hidden="true"></i>
                {{ $t('play') }}
            </button>
        </div>
        <div class="center-block hidden" ref="pinContainer">
            <div class="alert alert-danger" v-if="game && game.error !== null">{{ game.error }}</div>
            <input type="text"
                   v-model="pin"
                   class="pin-input"
                   v-bind:maxlength="pinLength"
                   v-on:keyup.enter="onEnter"
                   ref="pinInput"
            />
            <button @click="onPlayButtonClick"
                    v-bind:class="buttonClass"
                    ref="playButton"
            >
                {{ $t('play') }}
            </button>
        </div>
    </div>
</template>

<script>
    import debounce from '../debounce';

    function Game(data) {
        const url = data.url;
        const name = data.name;
        const error = data.error;

        return {
            url: url,
            name: name,
            error: error
        }
    }
    export default {
        props: [],
        mixins: [],
        beforeCreate() {},
        created() {},
        beforeMount() {},
        mounted() {
            this.defaultButtonClass = 'btn btn-success btn-lg pull-right';
            this.buttonClass = this.defaultButtonClass + ' hidden';
            this.$nextTick(() => {
                this.baseUrl = window.RADA.config.base_url;
                this.pinLength = window.RADA.config.pin_length;
            });
        },
        beforeUpdate() {},
        updated() {},
        beforeDestroy() {},
        destroyed() {},
        data() {
            return {
                baseUrl: '',
                loading: false,
                pin: '',
                game: null,
                pinLength: 5,
                defaultButtonClass: '',
                buttonClass: ''
            }
        },
        watch: {
            pin: debounce(function(pin) {
                this.game = null;
                this.showHideStartButton(pin);
            }, 500)
        },
        methods: {
            showHideStartButton(pin) {
                if (pin.length === this.pinLength) {
                    this.buttonClass = this.defaultButtonClass;
                } else {
                    this.buttonClass = this.defaultButtonClass + ' hidden';
                }
            },
            onPlayButtonClick() {
                this.$refs.playButton.setAttribute('disabled', 'disabled');
                this.$refs.pinInput.setAttribute('disabled', 'disabled');
                this.loading = true;
                this.wait(() => {
                    this.findGame(responseData => {
                        this.loading = false;
                        if (responseData !== null) {
                            this.game = new Game(responseData);
                            this.$refs.playButton.removeAttribute('disabled');
                            this.$refs.pinInput.removeAttribute('disabled');

                            if (this.game.url !== null) {
                                window.location.href = this.game.url;
                            }
                        }
                    });
                });
            },
            wait(callback) {
                setTimeout(() => {
                    callback();
                }, 2000);
            },
            findGame(callback) {
                const url = this.baseUrl + '/api/activities/find-game';
                const data = {
                    pin: this.pin
                };
                this.$http.post(url, data).then(response => {
                    callback(response.body);
                }, response => {
                    callback(null);
                    console.log('Error: ' + response);
                });
            },
            onEnter() {
                this.onPlayButtonClick();
            },
            onMarkerButtonClick() {
                this.$refs.pinContainer.classList.remove('hidden');
                this.$refs.markerButtonContainer.classList.add('hidden');
            }
        }
    }
</script>

<style scoped>
    .open-game-by-entering-pin-code-container .pin-input {
        margin-top: 1px;
        float: left;
        letter-spacing: 15px;
        width: 190px;
        padding-left: 15px;
        font-size: 32px;
        font-family: MONOSPACE;
    }
    .open-game-by-entering-pin-code-container .center-block {
        width: 305px;
    }
    .open-game-by-entering-pin-code-container .center-block .btn {
        padding: 13px 20px;
        font-size: 22px;
    }
</style>