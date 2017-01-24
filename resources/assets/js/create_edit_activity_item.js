
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.initMap = function() {
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

        return zooGeolocationOptions[$(document).find('select[name="zoo"]').val()];
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

    $(document).find('select[name="zoo"]').on('change', function() {
        var value = $(this).val(),
            latLng = zooGeolocationOptions[value];

        map.setCenter(latLng);
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
    el: 'form#' + window.activityItemFormId,
    data: {
        questionType: $('select[name="type"]').val()
    }
});
