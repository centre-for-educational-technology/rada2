//"use strict";

const VueI18n = require('vue-i18n');
import Raven from 'raven-js';
import RavenVue from 'raven-js/plugins/vue';

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
Vue.component('game-start-modal', require('./components/GameStartModal.vue'));

const playGameApp = new Vue({
    el: '#sz-play-app',
    created: function() {
        var vm = this;

        vm.game = window.SmartZoos.data.game;

        window.addEventListener('beforeunload', vm.leaving);

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
    },
    data() {
        return {
            mapInitialised: false,
            latitude: undefined,
            longitude: undefined,
            geoLocationErrorMessage: null,
            checkUnload: true,
            game: null
        };
    },
    methods: {
        isLoading: function() {
            return !(this.mapInitialised && this.latitude && this.longitude);
        },
        isGameComplete() {
            return this.game && this.game.complete;
        },
        getGeoLocation: function(callback, watch, handleError) {
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
        hasGeoLocationError: function() {
            return !!this.geoLocationErrorMessage;
        },
        leaving: function(event) {
            if ( !this.checkUnload) return false;

            const message = this.$t('exit-confirmation');

            event.returnValue = message;
            return message;
        }
    }
});
