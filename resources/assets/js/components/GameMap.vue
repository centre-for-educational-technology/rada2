<template>
    <div id="map">
    </div>
</template>

<script>
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
            // TODO Make translatable
            var confirmation = confirm('Are you sure you want to exit the game?');

            if ( confirmation ) {
                window.location = window.SmartZoos.config.base_url;
            }
        });
    }

    export default {
        props: ['latitude', 'longitude'],
        mounted() {
            this.mapData = {};
            this.mapData.markers = [];
            this.mapData.mapOptions = {
                center: {
                    lat: this.latitude,
                    lng: this.longitude
                },
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.HYBRID,
                disableDefaultUI: true,
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
            }
            this.initMap();
        },
        methods: {
            initMap: function() {
                var _this = this;

                this.mapData.map = new google.maps.Map(document.getElementById('map'), this.mapData.mapOptions);

                this.mapData.infoWindow = new google.maps.InfoWindow();

                this.initPlayerMarker();

                this.initGameControls();

                this.$parent.getGeoLocation(function(position) {
                    var map = _this.mapData.map,
                        playerMarker = _this.mapData.playerMarker;

                    playerMarker.setPosition({
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    });
                    if ( map.szTrackingEnabled === true ) {
                        map.setCenter(playerMarker.getPosition());
                    }
                    /*if ( markers.length > 0 ) {
                        detectAndActivateClosestMarker(playerMarker.getPosition(), markers, closestMarker);
                    }*/
                }, true);

                if ( window.SmartZoos.data.activity.activity_items ) {
                    var map = _this.mapData.map,
                        markers = _this.mapData.markers,
                        infoWindow = _this.mapData.infoWindow;

                    _.each(window.SmartZoos.data.activity.activity_items, function(item) {
                        var marker = new google.maps.Marker({
                            title: item.title,
                            //label: (markers.length + 1).toString(),
                            position: {
                                lat: Number(item.latitude),
                                lng: Number(item.longitude)
                            },
                            map: map,
                            animation: google.maps.Animation.DROP
                        });
                        markers.push(marker);

                        marker.addListener('click', function() {
                            _this.closeInfoWindow();
                            infoWindow.setContent(this.title);
                            infoWindow.open(map, this);
                        });
                    });
                }
            },
            initGameControls: function() {
                var map = this.mapData.map,
                    playerMarker = this.mapData.playerMarker,
                    gameControlsDiv = document.createElement('div'),
                    gameControls = new GameControls(gameControlsDiv, map, playerMarker);

                gameControls.index = 1;
                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gameControlsDiv);
            },
            closeInfoWindow: function() {
                var infoWindow = this.mapData.infoWindow;

                if ( infoWindow && infoWindow.getMap() ) {
                    infoWindow.close();
                }
            },
            initPlayerMarker: function() {
                var circle,
                    playerMarker,
                    activeDistanceCircle,
                    _this = this,
                    map = this.mapData.map,
                    infoWindow = this.mapData.infoWindow;

                circle = {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillColor: 'red',
                    fillOpacity: 1.0,
                    scale: 4.5,
                    strokeColor: 'white',
                    strokeWeight: 1
                };

                var playerMarker = new google.maps.Marker({
                    title: 'It\'s You!', // TODO Make sure that this is translated
                    position: {
                        lat: this.latitude,
                        lng: this.longitude
                    },
                    map: map,
                    icon: circle
                });

                playerMarker.addListener('click', function() {
                    _this.closeInfoWindow();
                    infoWindow.setContent(this.title);
                    infoWindow.open(map, this);
                });

                var activeDistanceCircle = new google.maps.Circle({
                    map: map,
                    radius: 25,
                    fillColor: 'blue',
                    fillOpacity: 0.25,
                    strokeColor: 'blue',
                    strokeWeight: 1,
                    strokeOpacity: 0.5
                });
                activeDistanceCircle.bindTo('center', playerMarker, 'position');

                google.maps.event.trigger(playerMarker, 'click');

                this.mapData.playerMarker = playerMarker;
            }
        }
    }
</script>
