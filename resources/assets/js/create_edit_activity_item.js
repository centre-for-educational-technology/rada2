
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.initMap = function() {
    var enableStreetView = window.Laravel.map.enableStreetView || false;

    function $t(key) {
        if ( window.Laravel.translations && window.Laravel.translations.hasOwnProperty(key) ) {
            return window.Laravel.translations[key];
        }

        console.warn('Could not find translation for: ' + key);
        return key;
    }

    function initGameControls(map, cb) {
        if ( !navigator.geolocation ) {
            return false;
        }

        var gameControls = document.createElement('div'),
            controlUI = document.createElement('div');

        controlUI.id = 'sz-map-controls';
        gameControls.appendChild(controlUI);

        var navigationControlItem = document.createElement('i');
        navigationControlItem.className = 'mdi mdi-target';
        navigationControlItem.title = $t('set-current-position');
        controlUI.appendChild(navigationControlItem);

        var inGeoposition = false;
        var zooSelect = document.getElementById('zoo');
        navigationControlItem.addEventListener('click', function() {
            if ( inGeoposition ) return;
            inGeoposition = true;
            zooSelect.disabled = true;

            navigationControlItem.style.color = '#cccccc';
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    navigationControlItem.style.color = null;
                    zooSelect.disabled = false;
                    inGeoposition = false;
                    cb(position);
                },
                function(error) {
                    navigationControlItem.style.color = null;
                    zooSelect.disabled = false;
                    inGeoposition = false;
                    alert($t('geolocation-error'));
                    console.error('Geolocation error', error);
                }, {
                    enableHighAccuracy: true
                });
        });

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gameControls);
    }

    // TODO This code is a repatition of one from GameMap component
    // It might make sense to rewrite it into a mixin
    // This would require using a component for the map instead
    function initGroundOverlays(map) {
        return new google.maps.GroundOverlay(window.Laravel.baseUrl + '/img/map/overlays/skansen.png',{
            north: 59.329167,
            south: 59.324011,
            east: 18.111242,
            west: 18.099022
        }, {
            clickable: false,
            map: map
        });
    }

    function setLatAndLngValues(latLng) {
        document.getElementById('latitude').value = ( typeof latLng.lat === 'function' ) ? latLng.lat() : latLng.lat;
        document.getElementById('longitude').value = ( typeof latLng.lng === 'function' ) ? latLng.lng() : latLng.lng;
    }

    function initializeMarker(map, latLng) {
      var marker = new google.maps.Marker({
          animation: google.maps.Animation.DROP,
          title: '',
          position: latLng,
          map: map,
          draggable: true,
      });

      marker.addListener('dragend', function(event) {
          setLatAndLngValues(event.latLng);
      });

      return marker;
    }

    function replayMarkerAnimation(marker) {
        marker.setAnimation(google.maps.Animation.BOUNCE);
        setTimeout(function() {
            marker.setAnimation(null);
        }, 500);
    }

    function repositionMarker(latLng, marker, map) {
        setLatAndLngValues(latLng);
        map.panTo(latLng);
        marker.setPosition(latLng);
        replayMarkerAnimation(marker);
    }

    function getInitialLatLng() {
        var latitude = document.getElementById('latitude').value,
            longitude = document.getElementById('longitude').value;
        if ( latitude && longitude ) {
            return {
                lat: Number(latitude),
                lng: Number(longitude)
            };
        }

        return window.Laravel.zooGeolocationOptions[$(document).find('select[name="zoo"]').val()];
    }

    var mapOptions, map, marker;

    var currentLatLng = getInitialLatLng();

    mapOptions = {
        center: currentLatLng,
        zoom: 18,
        mapTypeId: google.maps.MapTypeId.HYBRID,
        disableDefaultUI: true,
        zoomControl: true,
        streetViewControl: enableStreetView,
        mapTypeControl: true,
        styles: [
            {
                featureType: 'poi',
                stylers: [{visibility: 'off'}]
            },
            {
                featureType: 'transit.station',
                stylers: [{visibility: 'off'}]
          },
        ]
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    setLatAndLngValues(currentLatLng);

    marker = initializeMarker(map, currentLatLng);

    initGameControls(map, function(position) {
        var latLng = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };

        repositionMarker(latLng, marker, map);
    });

    initGroundOverlays(map);

    $(document).find('select[name="zoo"]').on('change', function() {
        var value = $(this).val(),
            latLng = window.Laravel.zooGeolocationOptions[value];

        repositionMarker(latLng, marker, map);
    });

    let longPress = false;
    let startTime;
    let endTime;

    map.addListener('mousedown', function(event) {
        startTime = new Date().getTime();
    });

    map.addListener('mouseup', function(event) {
        endTime = new Date().getTime();
        longPress = (endTime - startTime < 500) ? false : true;
    });

    map.addListener('click', function(event) {
        if ( longPress ) {
            setLatAndLngValues(event.latLng);
            marker.setPosition(event.latLng);
            replayMarkerAnimation(marker);
        }
    });
};

const VueI18n = require('vue-i18n');
Vue.use(VueI18n);
Vue.config.lang = window.Laravel.locale;
Vue.locale(window.Laravel.locale, _.cloneDeep(window.Laravel.translations));

Vue.component('one-correct-answer', require('./components/OneCorrectAnswer.vue'));
Vue.component('multiple-correct-answers', require('./components/MultipleCorrectAnswers.vue'));
Vue.component('match-pairs', require('./components/MatchPairs.vue'));

const addActivityItemApp = new Vue({
    el: 'form#' + window.Laravel.activityItemFormId,
    mounted() {
        const vm = this;

        $('[data-toggle="tooltip"]').tooltip();

        if ( window.Laravel.hasImage ) {
            vm.hasImage = true;
        }

        $(vm.$refs.image).on('change', (e) => {
            this.canResetImage = true;
        });
    },
    data() {
        return {
            questionType: $('select[name="type"]').val(),
            canResetImage: false,
            hasImage: false
        };
    },
    methods: {
        hasQuestionData() {
            return window.Laravel.activityItemQuestionData && window.Laravel.activityItemQuestionData.length > 0;
        },
        getQuestionData() {
            return window.Laravel.activityItemQuestionData;
        },
        changedQuestionType() {
            if ( this.hasQuestionData() ) {
                delete window.Laravel.activityItemQuestionData;
            }
        },
        getOptionImageUrl(image) {
            return window.Laravel.activityItemAssetsBaseUrl + '/' + image;
        },
        hasPreview(option, imageKey, flagKey) {
            imageKey = imageKey || 'image';
            flagKey = flagKey || 'imagePreview';
            if ( option.id && option[imageKey] && option[flagKey] !== false ) {
                return true;
            }

            return false;
        },
        resetImage(e) {
            e.preventDefault();

            if ( !$(this.$refs.image).val() ) return;

            this.canResetImage = false;
            $(this.$refs.image).val('');
        },
        canRemoveImage() {
            return !this.hasImage || this.canResetImage;
        },
        hasRemovedImagesData() {
            return window.Laravel.removedImages && window.Laravel.removedImages.length > 0;
        },
        getRemovedImagesData() {
            return window.Laravel.removedImages;
        },
        hasRemovedImageMatchesData() {
            return window.Laravel.removedImageMatches && window.Laravel.removedImageMatches.length > 0;
        },
        getRemovedImageMatchesData() {
            return window.Laravel.removedImageMatches;
        }
    }
});
