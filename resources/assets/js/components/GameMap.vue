<template>
    <div style="height:100%;width:100%;">
        <game-information-modal ref="informationModal" v-if="game" v-bind:activity="game.activity"></game-information-modal>
        <game-question-modal v-bind:question="question" v-bind:game-id="game.id" v-bind:base-url="baseUrl" v-if="question" ref="questionModal"></game-question-modal>
        <game-results-modal v-bind:activity="game.activity" v-bind:answers="game.answers" v-if="game && game.complete" ref="resultsModal"></game-results-modal>
        <div id="map">
        </div>
    </div>
</template>

<script>
    function GameControls(controlDiv, map, playerMarker, vm) {
        var controlUI = document.createElement('div');
        controlUI.id = 'sz-map-controls'
        controlDiv.appendChild(controlUI);

        var completionControlItem = document.createElement('i');
        completionControlItem.className = 'label label-success';
        completionControlItem.style.fontSize = '20px';
        completionControlItem.style.position = 'relative';
        completionControlItem.style.top = '-7px';
        completionControlItem.style.marginLeft = '5px';
        completionControlItem.style.marginRight = '5px';
        completionControlItem.textContent = vm.getAnsweredQuestionsCount() + '/' + _.size(vm.game.activity.questions);
        controlUI.appendChild(completionControlItem);

        vm.$watch('game.answers', function() {
            completionControlItem.textContent = vm.getAnsweredQuestionsCount() + '/' + _.size(vm.game.activity.questions);
        });

        var informationControlItem = document.createElement('i');
        informationControlItem.className = 'mdi mdi-information-outline';
        informationControlItem.title = vm.$t('info');
        controlUI.appendChild(informationControlItem);

        informationControlItem.addEventListener('click', function() {
            vm.$refs.informationModal.open();
        });

        var navigationControlItem = document.createElement('i');
        navigationControlItem.className = 'mdi mdi-navigation';
        navigationControlItem.title = vm.$t('position-tracking');
        controlUI.appendChild(navigationControlItem);

        navigationControlItem.addEventListener('click', function() {
            if ( map.szTrackingEnabled ) {
                map.szTrackingEnabled = false;
                navigationControlItem.className = 'mdi mdi-navigation';
            } else {
                map.panTo(playerMarker.getPosition());
                google.maps.event.trigger(playerMarker, 'click');
                map.szTrackingEnabled = true;
                navigationControlItem.className = 'mdi mdi-navigation active';
            }
        });

        var boundsControlItem = document.createElement('i');
        boundsControlItem.className = 'mdi mdi-map-marker-multiple';
        boundsControlItem.title = vm.$t('apply-item-bounds');
        controlUI.appendChild(boundsControlItem);

        boundsControlItem.addEventListener('click', function() {
            var bounds = vm.getMarkerBounds();

            if ( !bounds.isEmpty() ) {
                map.fitBounds(bounds);
            }
        });

        var exitControlIcon = document.createElement('i');
        exitControlIcon.className = 'mdi mdi-exit-to-app';
        exitControlIcon.title = vm.$t('exit');
        controlUI.appendChild(exitControlIcon);

        exitControlIcon.addEventListener('click', function() {
            vm.exit();
        });
    }

    var connectMarkers =  window.SmartZoos.config.connect_markers || false;

    export default {
        components: {
            'game-information-modal': require('./GameInformationModal.vue'),
            'game-question-modal': require('./GameQuestionModal.vue'),
            'game-results-modal': require('./GameResultsModal.vue')
        },
        props: ['latitude', 'longitude'],
        mounted() {
            this.baseUrl = window.SmartZoos.config.base_url;

            this.game = window.SmartZoos.data.game;

            this.mapData = {};
            this.mapData.markers = [];
            this.mapData.mapOptions = {
                center: {
                    lat: this.latitude,
                    lng: this.longitude
                },
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                zoomControl: true,
                streetViewControl: true,
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
            this.mapData.iconAnchor = new google.maps.Point(17.35, 20);
            this.mapData.iconSize = new google.maps.Size(52, 60);
            this.mapData.iconScaledSize = new google.maps.Size(34.7, 40);

            this.initMap();
        },
        data() {
            return {
                question: null,
                game: null,
                baseUrl: ''
            };
        },
        methods: {
            initMap() {
                var _this = this;

                this.mapData.map = new google.maps.Map(document.getElementById('map'), this.mapData.mapOptions);

                this.mapData.infoWindow = new google.maps.InfoWindow();

                this.initGroundOverlays();

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
                        map.panTo(playerMarker.getPosition());
                    }
                    _this.initUpdateClosestUnansweredMarkerArrow();
                    if ( _this.hasProximityCheck() ) {
                        // TODO Might make sense to cancel in case location
                        // does change rpidly
                        // Giving it half a second or so should be good enough
                        _.each(_this.mapData.markers, function(marker) {
                            if ( !_this.isAnswered(marker.questionId) ) {
                                _this.detectAndSetMarkerIcon(marker);
                            }
                        });
                    }
                }, true);

                if ( _this.game.activity.questions ) {
                    var map = _this.mapData.map,
                        markers = _this.mapData.markers,
                        infoWindow = _this.mapData.infoWindow,
                        playerMarker = _this.mapData.playerMarker;

                    _.each(_this.game.activity.questions, function(question) {
                        var marker = new google.maps.Marker({
                            title: question.title,
                            position: {
                                lat: Number(question.latitude),
                                lng: Number(question.longitude)
                            },
                            map: map,
                            animation: google.maps.Animation.DROP,
                            questionId: question.id
                        });

                        _this.detectAndSetMarkerIcon(marker);

                        markers.push(marker);

                        marker.addListener('click', function() {
                            if ( _this.isAnswered(question.id) ) {
                                return;
                            }

                            if ( _this.hasProximityCheck() ) {
                                var distance = google.maps.geometry.spherical.computeDistanceBetween(playerMarker.getPosition(), marker.getPosition());

                                if ( distance <= _this.getProximityRadius() ) {
                                    _this.openQuestionModal(question);
                                }
                            } else {
                                _this.openQuestionModal(question);
                            }
                        });
                    });

                    if ( connectMarkers ) {
                        _this.connectMarkers();
                    }

                    _this.initUpdateClosestUnansweredMarkerArrow();
                }

                this.$nextTick(() => {
                    if ( this.game.complete ) {
                        this.$refs.resultsModal.open();
                    } else {
                        this.$refs.informationModal.open();
                    }
                });
            },
            initGroundOverlays() {
                this.mapData.skansenGroundOverlay = new google.maps.GroundOverlay(this.baseUrl + '/img/map/overlays/skansen.png',{
                    north: 59.329167,
                    south: 59.324011,
                    east: 18.111242,
                    west: 18.099022
                }, {
                    clickable: false,
                    map: this.mapData.map
                });
            },
            initGameControls() {
                var map = this.mapData.map,
                    playerMarker = this.mapData.playerMarker,
                    gameControlsDiv = document.createElement('div'),
                    gameControls = new GameControls(gameControlsDiv, map, playerMarker, this);

                // XXX This is a strange code pience that sends index without a reason()
                gameControls.index = 1;
                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gameControlsDiv);
            },
            closeInfoWindow() {
                var infoWindow = this.mapData.infoWindow;

                if ( infoWindow && infoWindow.getMap() ) {
                    infoWindow.close();
                }
            },
            initPlayerMarker() {
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
                    title: this.$t('its-you'),
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

                if ( this.hasProximityCheck() ) {
                    var activeDistanceCircle = new google.maps.Circle({
                        map: map,
                        radius: this.getProximityRadius(),
                        fillColor: 'blue',
                        fillOpacity: 0.25,
                        strokeColor: 'blue',
                        strokeWeight: 1,
                        strokeOpacity: 0.5
                    });
                    activeDistanceCircle.bindTo('center', playerMarker, 'position');
                }

                google.maps.event.trigger(playerMarker, 'click');

                this.mapData.playerMarker = playerMarker;
            },
            isAnswered(questionId) {
                return _.has(this.game.answers, questionId);
            },
            isCorrect(questionId) {
                const answer = _.get(this.game.answers, questionId, null);

                return answer && answer.correct === true;
            },
            markAnswered(id, answer) {
                this.$set(this.game.answers, id, answer);

                // TODO Might make sense to raise an error if marker can not be found
                var marker = _.find(this.mapData.markers, function(marker) { return marker.questionId === id; });

                if ( marker ) {
                    this.detectAndSetMarkerIcon(marker);
                }

                var answerIds = _.keys(this.game.answers).map(id => {
                    return _.toNumber(id);
                });
                var questionIds = _.map(this.game.activity.questions, question => {
                    return question.id;
                });

                this.initUpdateClosestUnansweredMarkerArrow();

                if ( _.intersection(questionIds, answerIds).length === questionIds.length ) {
                    this.game.complete = true;

                    this.$nextTick(() => {
                        this.$refs.resultsModal.open();
                    });
                }
            },
            connectMarkers() {
                var map = this.mapData.map,
                    markers = this.mapData.markers;

                if ( markers.length > 1 ) {
                    _.each(markers, (marker, index) => {
                        if ( index === 0 ) {
                            return;
                        }

                        var line = new google.maps.Polyline({
                            path: [
                                markers[index-1].getPosition(),
                                markers[index].getPosition()
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
                    });
                }
            },
            exit() {
                var confirmation = confirm(this.$t('exit-confirmation'));

                if ( confirmation ) {
                    // Prevent unload check from being applied
                    this.$parent.checkUnload = false;
                    window.location = this.baseUrl;
                }
            },
            hasProximityCheck() {
                return this.game.activity.proximity_check;
            },
            getProximityRadius() {
                return this.game.activity.proximity_radius || 25;
            },
            openQuestionModal(question) {
                this.question = question;
                this.$nextTick(() => {
                    this.$refs.questionModal.open();
                });
            },
            detectAndSetMarkerIcon(marker) {
                // TODO Check it we should fail in case question could not be found
                const question = _.find(this.game.activity.questions, ['id', marker.questionId]);
                const nameMapping = {
                    1: 'information',
                    2: 'one-correct-answer',
                    3: 'multiple-correct-answers',
                    4: 'freeform-answer',
                    5: 'match-pairs',
                    6: 'embedded-content',
                    7: 'photo'
                };
                let iconBase = this.baseUrl + '/img/icons/item/';

                if ( this.isAnswered(question.id) ) {
                    iconBase += this.isCorrect(question.id) ? 'correct/' : 'incorrect/';
                } else if ( this.hasProximityCheck() ) {
                    const distance = google.maps.geometry.spherical.computeDistanceBetween(this.mapData.playerMarker.getPosition(), marker.getPosition());

                    if ( distance > this.getProximityRadius() ) {
                        iconBase += 'inactive/';
                    }
                }

                marker.setIcon({
                    anchor: this.mapData.iconAnchor,
                    size: this.mapData.iconSize,
                    scaledSize: this.mapData.iconScaledSize,
                    url: iconBase + nameMapping[question.type] + '.png'
                });
            },
            getMarkerBounds() {
                if ( this.mapData.markerBounds ) return this.mapData.markerBounds;

                this.mapData.markerBounds = new google.maps.LatLngBounds();

                if ( this.mapData.markers.length > 0 ) {
                    const vm = this;

                    _.each(this.mapData.markers, function(marker) {
                        vm.mapData.markerBounds.extend(marker.getPosition());
                    });
                }

                return this.mapData.markerBounds;
            },
            getAnsweredQuestionsCount() {
                if ( _.size(this.game.activity.questions) === 0 || _.size(this.game.answers) === 0 ) return 0;

                var questionIds = _.map(this.game.activity.questions, question => {
                    return question.id;
                });

                var answered = _.filter(this.game.answers, answer => {
                    return questionIds.indexOf(answer.question) !== -1;
                });

                return _.size(answered);
            },
            getClosestUnansweredMarker() {
                var vm = this,
                    unansweredMarkers = _.filter(this.mapData.markers, marker => { return !vm.isAnswered(marker.questionId); }),
                    playerMarker = this.mapData.playerMarker;

                if ( unansweredMarkers.length > 0 ) {
                    return _.minBy(unansweredMarkers, marker => {
                        return google.maps.geometry.spherical.computeDistanceBetween(playerMarker.getPosition(), marker.getPosition());
                    });
                }

                return null;
            },
            initUpdateClosestUnansweredMarkerArrow() {
                var vm = this,
                    marker = vm.getClosestUnansweredMarker();

                if ( !marker ) {
                    if ( vm.mapData.closestUnansweredMarkerArrow ) {
                        vm.mapData.closestUnansweredMarkerArrow.setMap(null);
                    }
                    return;
                }

                if ( !vm.mapData.closestUnansweredMarkerArrow ) {
                    vm.mapData.closestUnansweredMarkerArrow = new google.maps.Polyline({
                        path: [
                            vm.mapData.playerMarker.getPosition(),
                            marker.getPosition()
                        ],
                        strokeColor: 'red',
                        strokeWeight: 2,
                        strokeOpacity: 0.4,
                        icons: [{
                            icon: {
                                path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                                fillColor: 'red',
                                strokeColor: 'red',
                                fillOpacity: 0.8,
                                strokeOpacity: 0.8,
                                scale: 4
                            },
                            offset: '50px',
                        }],
                        geodesic: true,
                        map: vm.mapData.map,
                        zIndex: 2
                    });
                } else {
                    vm.mapData.closestUnansweredMarkerArrow.setPath([
                        vm.mapData.playerMarker.getPosition(),
                        marker.getPosition()
                    ]);
                }
            }
        }
    }
</script>
