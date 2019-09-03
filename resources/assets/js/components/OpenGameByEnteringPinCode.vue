<template>
    <div class="open-game-by-entering-pin-code-container">
        <div class="col-xs-12" ref="markerButtonContainer">
            <button class="btn btn-default sz-quick-play-btn" @click="onMarkerButtonClick">
                <i class="mdi mdi-map-marker" aria-hidden="true"></i>
                {{ $t('play') }}
            </button>
        </div>
        <div class="center-block hidden" ref="pinContainer">
            <div class="input-button-container">
                <input type="text"
                       v-model="pin"
                       class="pin-input"
                       :placeholder="placeholder"
                       v-bind:maxlength="pinLength"
                       v-on:keyup.enter="onEnter"
                       ref="pinInput"
                />
                <button
                        v-bind:class="buttonClass"
                        ref="playButton"
                        @click="onPlayButtonClick"
                >
                    <i class="mdi mdi-map-marker"></i>
                    {{ $t('play') }}
                </button>
            </div>
            <div>
                <div class="alert alert-danger" v-if="game && game.error !== null">{{ game.error }}</div>
            </div>
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
            this.defaultButtonClass = 'btn btn-default sz-quick-play-btn btn-lg pull-right play-button';
            this.buttonClass = this.defaultButtonClass;
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
                buttonClass: '',
                searchGame: false,
                placeholder: this.$t('pin-placeholder')
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
                    this.searchGame = true;
                } else {
                    this.searchGame = false;
                }
            },
            onPlayButtonClick() {
                if (this.searchGame === false) {
                    return false;
                }
                this.$refs.playButton.setAttribute('disabled', 'disabled');
                this.$refs.pinInput.setAttribute('disabled', 'disabled');
                this.loading = true;
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
        letter-spacing: 1px;
        width: 80%;
        font-size: 50px;
        font-family: MONOSPACE;
        text-align: center;
        height: 75px;
        text-transform: uppercase;
    }
    #sz-quick-play .open-game-by-entering-pin-code-container .btn.sz-quick-play-btn.play-button {
        padding: 0;
        width: 18%;
    }
    #sz-quick-play .open-game-by-entering-pin-code-container .btn.sz-quick-play-btn.play-button i.mdi {
        margin-top: 10px;
        margin-bottom: 0px;
    }
    #sz-quick-play .open-game-by-entering-pin-code-container .btn.sz-quick-play-btn.play-button i.mdi:before {
        font-size: 40px;
        top: 4px;
    }
    .open-game-by-entering-pin-code-container .center-block {
        width: 100%;
    }
    .open-game-by-entering-pin-code-container .center-block .btn {
        padding: 13px 20px;
        font-size: 22px;
    }
    .input-button-container {
        position: relative;
        display: block;
        overflow: hidden;
        margin-bottom: 15px;
        padding: 25px 0px;
    }
    @media (max-width: 450px) {
        .open-game-by-entering-pin-code-container .pin-input {
            width: 100%;
            margin-bottom: 10px;
        }
        #sz-quick-play .open-game-by-entering-pin-code-container .btn.sz-quick-play-btn.play-button {
            width: 100%
        }
    }
</style>
