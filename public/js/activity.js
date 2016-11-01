"use strict";

function getLocation(callback, watch) {
    function handleError(error) {
        console.error('Geolocation error', error);
    }

    if ( navigator.geolocation ) {
        if ( watch === true ) {
            navigator.geolocation.watchPosition(callback, handleError);
        } else {
            navigator.geolocation.getCurrentPosition(callback, handleError);
        }
    } else {
        throw 'Geolocation is unavailable!';
    }
}

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

    var currentPositionControlIcon = document.createElement('i');
    currentPositionControlIcon.style.fontSize = '24px';
    currentPositionControlIcon.style.color = 'rgb(25,25,25)';
    currentPositionControlIcon.className = 'mdi mdi-target';
    currentPositionControlIcon.style.marginRight = '5px';
    currentPositionControlIcon.title = 'Center map to current position';
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
            // TODO Navigate o home page or listing page
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

    var mapOptions, map, playerMarker, infoWindow;

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

        playerMarker = initPlayerMarker(position, infoWindow, map);

        initGameControls(playerMarker, map);

        getLocation(function(position) {
            closeInfoWindow(infoWindow);
            playerMarker.setPosition({
                lat: position.coords.latitude,
                lng: position.coords.longitude
            });
        }, true);
    });
}

//# sourceMappingURL=activity.js.map
