"use strict";

function initMap() {
    function isInfoWindowOpen(infoWindow) {
        if ( infoWindow && infoWindow.getMap() ) {
            return true;
        }

        return false;
    }
    function closeInfoWindow(infoWindow) {
        if (isInfoWindowOpen(infoWindow)) {
            infoWindow.close();
        }
    }
    var mapOptions, map, playerMarker, infoWindow;

    var circle = {
        path: google.maps.SymbolPath.CIRCLE,
        fillColor: 'red',
        fillOpacity: 1.0,
        scale: 4.5,
        strokeColor: 'white',
        strokeWeight: 1
    };

    infoWindow = new google.maps.InfoWindow();

    getLocation(function(position) {
        mapOptions = {
            center: {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            },
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };

        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        playerMarker = new google.maps.Marker({
            title: 'It\'s You!',
            position: {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            },
            map: map,
            icon: circle
        });

        playerMarker.addListener('click', function() {
            closeInfoWindow(infoWindow);
            infoWindow.setContent(this.title);
            infoWindow.open(map, this);
        });

        getLocation(function(position) {
            closeInfoWindow(infoWindow);
            playerMarker.setPosition({
                lat: position.coords.latitude,
                lng: position.coords.longitude
            });
        }, true);
    });
}
