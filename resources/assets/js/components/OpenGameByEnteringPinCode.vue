<template>
    <div class="open-game-by-entering-pin-code-container">
        <input type="password" v-model="pin" class="pin-input" />
        <button v-if="showStartButton === true" @click="onStartButtonClick">Start</button>
    </div>
</template>

<script>
    import debounce from '../debounce';

    function Game(data) {
        const url = data.url;
        const name = data.name;

        return {
            url: url,
            name: name
        }
    }
    export default {
        props: [],
        mixins: [],
        beforeCreate() {},
        created() {},
        beforeMount() {},
        mounted() {
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
                showStartButton: false
            }
        },
        watch: {
            pin: debounce(function(pin) {
                this.showHideStartButton(pin);
            }, 500)
        },
        methods: {
            showHideStartButton(pin) {
                this.showStartButton = pin.length === this.pinLength;
            },
            onStartButtonClick(evt) {
                evt.target.setAttribute('disabled', 'disabled');
                this.loading = true;
                this.wait(() => {
                    this.findGame(responseData => {
                        this.loading = false;
                        if (responseData !== null) {
                            this.game = new Game(responseData);
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
            }
        }
    }
</script>

<style scoped>
    .open-game-by-entering-pin-code-container .pin-input {

    }
</style>