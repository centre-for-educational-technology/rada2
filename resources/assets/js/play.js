//"use strict";

const VueI18n = require('vue-i18n');
import Raven from 'raven-js';
import RavenVue from 'raven-js/plugins/vue';
import Hammer from 'hammerjs';

Vue.use(VueI18n);
Vue.config.lang = window.SmartZoos.config.locale;
Vue.locale(window.SmartZoos.config.locale, _.cloneDeep(window.SmartZoos.data.translations));

if ( SmartZoos.config.sentry && SmartZoos.config.sentry.sdn) {
    Raven
        .config(SmartZoos.config.sentry.sdn)
        .addPlugin(RavenVue, Vue)
        .install();
}

Vue.component('game-map', require('./components/GameMap.vue'));
Vue.component('game-tutorial-modal', require('./components/GameTutorialModal.vue'));
Vue.component('game-information-modal', require('./components/GameInformationModal.vue'));
Vue.component('game-results-modal', require('./components/GameResultsModal.vue'));

const playGameApp = new Vue({
    el: '#sz-play-app',
    created: function() {
        var vm = this;

        vm.baseUrl = window.SmartZoos.config.base_url;
        vm.game = window.SmartZoos.data.game;

        window.addEventListener('beforeunload', vm.leaving);

        vm.$on('dialog:tutorial:close', () => {
            vm.setHasSeenTotorial();
        });

        if ( !vm.isGameComplete() ) {
            window.initMap = function() {
                vm.mapInitialised = true;
            };

            vm.getGeoLocation(function(position) {
                vm.latitude = position.coords.latitude;
                vm.longitude = position.coords.longitude;
            }, false, function(error) {
                vm.geoLocationErrorMessage = error.message;
            });

            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = '//maps.googleapis.com/maps/api/js?key=' + window.SmartZoos.config.map.key + '&callback=initMap&libraries=geometry';
            document.body.appendChild(script);
        }
    },
    mounted() {
        if ( !this.isGameComplete() ) {

            if ( !this.hasSeenTutorial() ) {
                this.$refs.tutorialModal.open();
            } else {
                this.$refs.informationModal.open();
            }
        } else {
            this.$refs.resultsModal.open();
        }
    },
    data() {
        return {
            baseUrl: '',
            mapInitialised: false,
            latitude: undefined,
            longitude: undefined,
            geoLocationErrorMessage: null,
            checkUnload: true,
            game: null
        };
    },
    methods: {
        isLoading() {
            return !(this.mapInitialised && this.latitude && this.longitude);
        },
        isGameComplete() {
            return this.game && this.game.complete;
        },
        getGeoLocation(callback, watch, handleError) {
            if ( typeof handleError !== 'function' ) {
                handleError = function(error) {
                    if ( window.console && window.console.error && typeof window.console.error === 'function' ) {
                        window.console.error('Geolocation error', error); // TODO Consider making traslatable
                    }
                };
            }

            if ( window.navigator.geolocation ) {
                const geolocationOptions = {
                    enableHighAccuracy: true
                };
                if ( watch === true ) {
                    window.navigator.geolocation.watchPosition(callback, handleError, geolocationOptions);
                } else {
                    window.navigator.geolocation.getCurrentPosition(callback, handleError, geolocationOptions);
                }
            } else {
                throw 'Geolocation is unavailable!'; // TODO Consider making translatable
            }
        },
        hasGeoLocationError() {
            return !!this.geoLocationErrorMessage;
        },
        leaving(event) {
            if ( !this.checkUnload) return false;

            const message = this.$t('exit-confirmation');

            event.returnValue = message;
            return message;
        },
        exit() {
            var confirmation = confirm(this.$t('exit-confirmation'));

            if ( confirmation ) {
                // Prevent unload check from being applied
                this.checkUnload = false;
                window.location = this.baseUrl;
            }
        },
        hasSeenTutorial() {
            if ( !window.sessionStorage ) return false;

            return window.sessionStorage.getItem('seen:game:tutorial') === 'true';
        },
        setHasSeenTotorial() {
            if ( window.sessionStorage ) {
                try {
                    window.sessionStorage.setItem('seen:game:tutorial', 'true');
                } catch (err) {
                    // Handles the QuotaExceededError in some versions of Safari on iOS
                }
            }
        }
    }
});
