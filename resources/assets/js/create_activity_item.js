
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

window.initMap = function() {
    function setLatandLngValues(latLng) {
        document.getElementById('latitude').value = ( typeof latLng.lat === 'function' ) ? latLng.lat() : latLng.lat;
        document.getElementById('longitude').value = ( typeof latLng.lng === 'function' ) ? latLng.lng() : latLng.lng;
    }

    var mapOptions, map, marker;

    var currentLatLng = zooGeolocationOptions[$(document).find('select[name="zoo"]').val()];

    mapOptions = {
        center: currentLatLng,
        zoom: 18,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
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

    marker = new google.maps.Marker({
        animation: google.maps.Animation.DROP,
        title: '',
        position: currentLatLng,
        map: map,
        draggable: true,
    });

    setLatandLngValues(currentLatLng);

    marker.addListener('dragend', function(event) {
        setLatandLngValues(event.latLng);
    });

    $(document).find('select[name="zoo"]').on('change', function() {
        var value = $(this).val(),
            latLng = zooGeolocationOptions[value];

        map.setCenter(latLng);
        marker.setPosition(latLng);
        setLatandLngValues(latLng);
    });
};
