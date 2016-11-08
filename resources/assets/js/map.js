"use strict";

function GameControls(controlDiv, map, playerMarker) {
    var controlUI = document.createElement('div');
    controlUI.style.backgroundColor = '#fff';
    controlUI.style.border = '2px solid #fff';
    controlUI.style.borderRadius = '3px';
    controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
    controlUI.style.cursor = 'pointer';
    controlUI.style.marginBottom = '22px';
    controlUI.style.textAlign = 'center';
    controlDiv.appendChild(controlUI);

    var navigationControlItem = document.createElement('i');
    navigationControlItem.style.fontSize = '24px';
    navigationControlItem.style.color = 'rgb(169,169,169)';
    navigationControlItem.className = 'mdi mdi-navigation';
    navigationControlItem.style.marginRight = '5px';
    navigationControlItem.title = 'Enable or disable position tracking';
    controlUI.appendChild(navigationControlItem);

    navigationControlItem.addEventListener('click', function() {
        if ( map.szTrackingEnabled ) {
            map.szTrackingEnabled = false;
            navigationControlItem.style.color = 'rgb(169,169,169)';
        } else {
            map.szTrackingEnabled = true;
            navigationControlItem.style.color = 'rgb(0,0,255)';
        }
    });

    var currentPositionControlIcon = document.createElement('i');
    currentPositionControlIcon.style.fontSize = '24px';
    currentPositionControlIcon.style.color = 'rgb(25,25,25)';
    currentPositionControlIcon.className = 'mdi mdi-target';
    currentPositionControlIcon.style.marginRight = '5px';
    currentPositionControlIcon.title = 'Center map to current position (double click to enable tracking)';
    controlUI.appendChild(currentPositionControlIcon);

    currentPositionControlIcon.addEventListener('click', function() {
        google.maps.event.trigger(playerMarker, 'click');
        map.setCenter(playerMarker.getPosition());
    });

    var exitControlIcon = document.createElement('i');
    exitControlIcon.style.fontSize = '24px';
    exitControlIcon.style.color = 'rgb(25,25,25)';
    exitControlIcon.className = 'mdi mdi-exit-to-app';
    exitControlIcon.title = 'Exit the game';
    controlUI.appendChild(exitControlIcon);

    exitControlIcon.addEventListener('click', function() {
        var confirmation = confirm('Are you sure you want to exit the game?');

        if ( confirmation ) {
            window.location = window.SmartZoos.config.base_url;
        }
    });
}

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
    function initPlayerMarker(position, infoWindow, map) {
        var circle = {
            path: google.maps.SymbolPath.CIRCLE,
            fillColor: 'red',
            fillOpacity: 1.0,
            scale: 4.5,
            strokeColor: 'white',
            strokeWeight: 1
        };

        var playerMarker = new google.maps.Marker({
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

        return playerMarker;
    }
    function initGameControls(playerMarker, map) {
        var gameControlsDiv = document.createElement('div');
        var gameControls = new GameControls(gameControlsDiv, map, playerMarker);

        gameControls.index = 1;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gameControlsDiv);
    }

    function getClosestMarker(markers, playerLatLng) {
        var closestDistance;
        var closestIndex;
        for (var i=0; i<markers.length;i++) {
            var currentDistance = google.maps.geometry.spherical.computeDistanceBetween(playerLatLng, markers[i].getPosition());
            if ( closestDistance ) {
                if ( closestDistance > currentDistance ) {
                    closestDistance = currentDistance;
                    closestIndex = i;
                }
            } else {
                closestDistance = currentDistance;
                closestIndex = i;
            }
        }

        return markers[closestIndex];
    }

    function detectAndActivateClosestMarker(currentPosition, markers, currentClosestMarker) {
        var newClosestMarker = getClosestMarker(markers, currentPosition);

        if ( closestMarker && closestMarker !== newClosestMarker ) {
            closestMarker.setIcon(null);
            google.maps.event.trigger(newClosestMarker, 'click');
        }

        google.maps.event.trigger(newClosestMarker, 'click');

        closestMarker = newClosestMarker;

        closestMarker.setIcon({
            labelOrigin: new google.maps.Point(11, 12),
            url: window.SmartZoos.config.map.green_dotless_icon_url
        });
    }

    var mapOptions, map, playerMarker, infoWindow;
    var markers = [];
    var lines = [];
    var closestMarker;

    infoWindow = new google.maps.InfoWindow();

    getLocation(function(position) {
        $('#overlay').fadeOut();
        mapOptions = {
            center: {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            },
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            disableDoubleClickZoom: true
        };

        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        playerMarker = initPlayerMarker(position, infoWindow, map);
        google.maps.event.trigger(playerMarker, 'click');

        initGameControls(playerMarker, map);

        getLocation(function(position) {
            playerMarker.setPosition({
                lat: position.coords.latitude,
                lng: position.coords.longitude
            });
            if ( map.szTrackingEnabled === true ) {
                map.setCenter(playerMarker.getPosition());
            }
            detectAndActivateClosestMarker(playerMarker.getPosition(), markers, closestMarker);
        }, true);

        google.maps.event.addListener(map, 'dblclick', function(ev) {
            var marker = new google.maps.Marker({
                title: 'Marker ' + (markers.length + 1),
                label: (markers.length + 1).toString(),
                position: ev.latLng,
                map: map,
                animation: google.maps.Animation.DROP
            });
            markers.push(marker);

            marker.addListener('click', function() {
                closeInfoWindow(infoWindow);
                infoWindow.setContent(this.title);
                infoWindow.open(map, this);
            });

            if ( markers.length > 1 ) {
                var line = new google.maps.Polyline({
                    path: [
                        markers[markers.length-2].getPosition(),
                        markers[markers.length-1].getPosition()
                    ],
                    strokeWeight: 2,
                    strokeOpacity: 0.5,
                    icons: [{
                        icon: {path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW},
                        offset: '100%'
                    }],
                    geodesic: true,
                    map: map
                });
            }

            detectAndActivateClosestMarker(playerMarker.getPosition(), markers, closestMarker);
        });
    }, false, function(error) {
        document.getElementById('overlay').childNodes[1].innerHTML = 'ERROR: ' + error.message;
        document.getElementById('overlay').childNodes[1].style.color = '#8B0000';

        //$('#overlay > span').css('color', 'red');
    });
}
