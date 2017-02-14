
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.initMap = function() {
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
        navigationControlItem.title = 'Set current position'; // TODO Translate
        controlUI.appendChild(navigationControlItem);

        navigationControlItem.addEventListener('click', function() {
            navigator.geolocation.getCurrentPosition(
                cb,
                function(error) {
                    alert('Geolocation error'); // TODO Translate
                    console.log('Geolocation error', error);
                });
        });

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gameControls);
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

    function removeMarker(marker) {
      google.maps.event.clearListeners(marker, 'click');
      marker.setMap(null);
      marker = null;
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
        disableDoubleClickZoom: true,
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

        map.panTo(latLng);
        removeMarker(marker);
        setLatAndLngValues(latLng);
        setTimeout(function() {
            marker = initializeMarker(map, latLng);
        }, 250);
    });

    $(document).find('select[name="zoo"]').on('change', function() {
        var value = $(this).val(),
            latLng = window.Laravel.zooGeolocationOptions[value];

        map.panTo(latLng);
        removeMarker(marker);
        setLatAndLngValues(latLng);
        setTimeout(function() {
          marker = initializeMarker(map, latLng);
        }, 250);
    });
};

Vue.component('one-correct-answer', require('./components/OneCorrectAnswer.vue'));
Vue.component('multiple-correct-answers', require('./components/MultipleCorrectAnswers.vue'));
Vue.component('match-pairs', require('./components/MatchPairs.vue'));

const addActivityItemApp = new Vue({
    el: 'form#' + window.Laravel.activityItemFormId,
    data: {
        questionType: $('select[name="type"]').val()
    },
    methods: {
        hasQuestionData: function() {
            return window.Laravel.activityItemQuestionData && window.Laravel.activityItemQuestionData.length > 0;
        },
        getQuestionData: function() {
            return window.Laravel.activityItemQuestionData;
        },
        getOptionImageUrl: function(image) {
            return window.Laravel.activityItemAssetsBaseUrl + '/' + image;
        },
        hasPreview: function(option, imageKey, flagKey) {
            imageKey = imageKey || 'image';
            flagKey = flagKey || 'imagePreview';
            if ( option.id && option[imageKey] && option[flagKey] !== false ) {
                return true;
            }

            return false;
        }
    }
});
