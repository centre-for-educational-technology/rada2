//"use strict";

const VueI18n = require('vue-i18n');

Vue.use(VueI18n);
Vue.config.lang = window.SmartZoos.config.locale;
Vue.locale(window.SmartZoos.config.locale, _.cloneDeep(window.SmartZoos.data.translations));

Vue.component('game-map', require('./components/GameMap.vue'));

const playGameApp = new Vue({
    el: '#sz-play-app',
    created: function() {
        var vm = this;

        window.initMap = function() {
            vm.getGeoLocation(function(position) {
                vm.latitude = position.coords.latitude;
                vm.longitude = position.coords.longitude;
                vm.mapInitialised = true;
            }, false, function(error) {
                vm.geoLocationErrorMessage = error.message;
            });
        };

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
            geoLocationErrorMessage: null
        };
    },
    methods: {
        isLoading: function() {
            return !this.mapInitialised;
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
        }
    }
});
