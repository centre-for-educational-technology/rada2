/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['question'],
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      var vm = _this;
      $(_this.$refs.modal).on('hidden.bs.modal', function (e) {
        if (vm.correctCode === true) {
          vm.$nextTick(function () {
            vm.$parent.$refs.questionModal.open();
          });
        } else {
          vm.$parent.question = null;
        }

        vm.accessCode = null;
        vm.correctCode = false;
        vm.animated = false;
      });
      $(_this.$refs.modal).on('shown.bs.modal', function (e) {
        vm.$nextTick(function () {
          $(_this.$refs.input).focus();
        });
      });
    });
  },
  data: function data() {
    return {
      accessCode: null,
      correctCode: false,
      animated: false
    };
  },
  methods: {
    open: function open() {
      var _this2 = this;

      this.$nextTick(function () {
        $(_this2.$refs.modal).modal('show');
      });
    },
    close: function close() {
      var _this3 = this;

      this.$nextTick(function () {
        $(_this3.$refs.modal).modal('hide');
      });
    },
    title: function title() {
      return this.question && this.question.title ? this.question.title : '';
    },
    hasAccessCodeClues: function hasAccessCodeClues() {
      var accessCodeClues = this.accessCodeClues();
      return !!(accessCodeClues && accessCodeClues.trim());
    },
    accessCodeClues: function accessCodeClues() {
      return this.question && this.question.access_code_clues ? this.question.access_code_clues : '';
    },
    canCheck: function canCheck() {
      return !!this.accessCode;
    },
    check: function check() {
      if (!this.canCheck()) return;
      var vm = this;
      vm.animated = false;
      vm.$nextTick(function () {
        if (vm.accessCode.toLowerCase().trim() === vm.question.access_code.toLowerCase().trim()) {
          vm.correctCode = true;
          vm.close();
        } else {
          vm.correctCode = false;
        }

        vm.animated = true;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['question'],
  mixins: [],
  mounted: function mounted() {},
  data: function data() {
    return {
      inAjaxCall: false,
      message: this.$t('items.answering_time.time_is_up')
    };
  },
  methods: {
    title: function title() {
      return this.question ? this.question.title : '';
    },
    open: function open(message) {
      var _this = this;

      this.$nextTick(function () {
        $(_this.$refs.modal).modal('show');
      });

      if (typeof message !== 'undefined') {
        this.message = message;
      }

      return $(this.$refs.modal);
    },
    close: function close() {
      var _this2 = this;

      this.$nextTick(function () {
        $(_this2.$refs.modal).modal('hide');
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['question', 'gameId', 'baseUrl'],
  mixins: [],
  mounted: function mounted() {},
  data: function data() {
    return {
      inAjaxCall: false
    };
  },
  methods: {
    startTimer: function startTimer() {
      var vm = this;
      var data = {
        game_id: this.gameId,
        question_id: this.question.id
      };
      this.inAjaxCall = true;
      this.$http.post(vm.baseUrl + '/api/games/start-answering-timer', data).then(function (response) {
        vm.inAjaxCall = false;
        vm.$parent.markAnswered(vm.question.id, response.body);
        vm.$parent.openQuestionModal(vm.question, vm.$parent.getAnswer(vm.question.id));
        vm.close();
      }, function (response) {
        vm.inAjaxCall = false;
        setTimeout(function () {
          vm.startTimer();
        }, 200);
      });
    },
    title: function title() {
      return this.question ? this.question.title : '';
    },
    open: function open() {
      var _this = this;

      this.$nextTick(function () {
        $(_this.$refs.modal).modal('show');
      });
      return $(this.$refs.modal);
    },
    close: function close() {
      var _this2 = this;

      this.$nextTick(function () {
        $(_this2.$refs.modal).modal('hide');
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameImageDialog.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameImageDialog.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['baseUrl', 'image', 'inAnimationClass', 'outAnimationClass'],
  methods: {
    open: function open() {
      var vm = this;
      vm.$emit('show:image:dialog');
      vm.$nextTick(function () {
        $(vm.$refs.image).removeClass(vm.outAnimationClass).addClass(vm.inAnimationClass);
        $(vm.$refs.dialog).show(0, function () {
          vm.$emit('shown:image:dialog');
          vm.timeoutId = setTimeout(function () {
            vm.close();
          }, 5000);
        });
      });
    },
    close: function close() {
      var vm = this;

      if (vm.timeoutId) {
        clearTimeout(vm.timeoutId);
        vm.timeoutId = null;
      }

      vm.$emit('hide:image:dialog');
      vm.$nextTick(function () {
        $(vm.$refs.image).removeClass(vm.inAnimationClass).addClass(vm.outAnimationClass);
        setTimeout(function () {
          $(vm.$refs.dialog).hide(0, function () {
            vm.$emit('hidden:image:dialog');
          });
        }, 1000);
      });
    },
    imageUrl: function imageUrl() {
      return this.baseUrl + '/img/dialogs/' + this.image;
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameInformationModal.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameInformationModal.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mixins_MarkerIcon_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../mixins/MarkerIcon.js */ "./resources/assets/js/mixins/MarkerIcon.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['activity'],
  mixins: [_mixins_MarkerIcon_js__WEBPACK_IMPORTED_MODULE_0__["default"]],
  mounted: function mounted() {
    this.baseUrl = window.RADA.config.base_url;
  },
  data: function data() {
    return {
      icons: ['active', 'inactive', 'correct', 'incorrect'],
      baseUrl: ''
    };
  },
  methods: {
    open: function open() {
      this.$nextTick(function () {
        $(this.$refs.modal).modal('show');
      });
    },
    close: function close() {
      this.$nextTick(function () {
        $(this.$refs.modal).modal('hide');
      });
    },
    getIconText: function getIconText(type) {
      return this.$t('icons.' + type);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMap.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameMap.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mixins_MarkerIcon_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../mixins/MarkerIcon.js */ "./resources/assets/js/mixins/MarkerIcon.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
function GameControls(controlDiv, map, playerMarker, vm) {
  var mapTypeIds = _.values(google.maps.MapTypeId);

  var controlUI = document.createElement('div');
  controlUI.id = 'sz-map-controls';
  controlUI.className = 'map-controls';
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
  vm.$watch('game.answers', function () {
    completionControlItem.textContent = vm.getAnsweredQuestionsCount() + '/' + _.size(vm.game.activity.questions);
  }); // ------------- MESSAGING --------------------------

  var messagingControlItem = document.createElement('i');
  messagingControlItem.className = 'mdi mdi-email-outline';
  controlUI.appendChild(messagingControlItem);
  messagingControlItem.addEventListener('click', function () {
    vm.$refs.gameMessagesListModal.open();
  });
  var flashExerciseControlItem = document.createElement('i');
  flashExerciseControlItem.className = 'mdi mdi-flash';

  if (vm.activeFlashExerciseId === null) {
    flashExerciseControlItem.className += ' hidden';
  }

  flashExerciseControlItem.id = 'user-flash-exercise-control-item';
  controlUI.appendChild(flashExerciseControlItem);

  function toggleFlashColor() {
    setTimeout(function () {
      flashExerciseControlItem.style = 'color: #ff9800';
      setTimeout(function () {
        flashExerciseControlItem.style = 'color: #000000';
        toggleFlashColor();
      }, 2000);
    }, 1000);
  }

  toggleFlashColor();
  flashExerciseControlItem.addEventListener('click', function () {
    var questions = vm.game.activity.questions.filter(function (question) {
      return question.id === vm.activeFlashExerciseId;
    });

    if (questions.length > 0) {
      var question = questions[0];
      var answer = vm.getAnswer(question.id);
      vm.openQuestionModal(question, answer);
    }
  });
  var userControlItem = document.createElement('i');
  userControlItem.className = 'mdi';

  if (vm.$parent.isLoggedIn) {
    userControlItem.className += ' mdi-account';
  } else {
    userControlItem.className += ' mdi-account-off';
  }

  userControlItem.title = vm.$parent.userName;
  controlUI.appendChild(userControlItem);
  var userControlTooltipVisible = false;
  userControlItem.addEventListener('click', function () {
    $(userControlItem).tooltip('toggle');
    userControlTooltipVisible = userControlTooltipVisible ? false : true;
  });
  $(userControlItem).tooltip({
    'container': 'body',
    'placement': 'bottom',
    'title': $(userControlItem).attr('title'),
    'trigger': 'manual'
  });
  $(window).on('resize', function () {
    if (userControlTooltipVisible) {
      $(userControlItem).tooltip('show');
    }
  });
  var informationControlItem = document.createElement('i');
  informationControlItem.className = 'mdi mdi-information-outline';
  informationControlItem.title = vm.$t('info');
  controlUI.appendChild(informationControlItem);
  informationControlItem.addEventListener('click', function () {
    vm.$parent.$refs.informationModal.open();
  });
  var navigationControlItem = document.createElement('i');
  navigationControlItem.className = 'mdi mdi-crosshairs';
  navigationControlItem.title = vm.$t('position-tracking');
  controlUI.appendChild(navigationControlItem);
  navigationControlItem.addEventListener('click', function () {
    if (map.szTrackingEnabled) {
      map.szTrackingEnabled = false;
      navigationControlItem.className = 'mdi mdi-crosshairs';
    } else {
      map.panTo(playerMarker.getPosition());
      google.maps.event.trigger(playerMarker, 'click');
      map.szTrackingEnabled = true;
      navigationControlItem.className = 'mdi mdi-crosshairs-gps active';
    }
  });
  var boundsControlItem = document.createElement('i');
  boundsControlItem.className = 'mdi mdi-map-marker-multiple';
  boundsControlItem.title = vm.$t('apply-item-bounds');
  controlUI.appendChild(boundsControlItem);
  boundsControlItem.addEventListener('click', function () {
    var bounds = vm.getMarkerBounds();

    if (!bounds.isEmpty()) {
      map.fitBounds(bounds);
    }
  });
  var exitControlIcon = document.createElement('i');
  exitControlIcon.className = 'mdi mdi-exit-to-app';
  exitControlIcon.title = vm.$t('exit');
  controlUI.appendChild(exitControlIcon);
  exitControlIcon.addEventListener('click', function () {
    vm.$parent.exit();
  });
  var mapTypeControlItem = document.createElement('i');
  mapTypeControlItem.className = 'mdi mdi-layers';
  mapTypeControlItem.title = vm.$t('change-map-type');
  controlUI.appendChild(mapTypeControlItem);
  mapTypeControlItem.addEventListener('click', function () {
    var nextIndex = _.indexOf(mapTypeIds, map.mapTypeId) + 1;

    if (nextIndex === mapTypeIds.length) {
      nextIndex = 0;
    }

    map.setMapTypeId(mapTypeIds[nextIndex]);
  });
}

var connectMarkers = window.RADA.config.connect_markers || false;
var enableStreetView = window.RADA.config.map.enableStreetView || false;

/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    'game-question-modal': __webpack_require__(/*! ./GameQuestionModal.vue */ "./resources/assets/js/components/GameQuestionModal.vue")["default"],
    'game-answering-time-modal': __webpack_require__(/*! ./GameAnsweringTimeModal.vue */ "./resources/assets/js/components/GameAnsweringTimeModal.vue")["default"],
    'game-answering-time-is-up-modal': __webpack_require__(/*! ./GameAnsweringTimeIsUpModal.vue */ "./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue")["default"],
    'game-access-code-modal': __webpack_require__(/*! ./GameAccessCodeModal.vue */ "./resources/assets/js/components/GameAccessCodeModal.vue")["default"],
    'game-image-dialog': __webpack_require__(/*! ./GameImageDialog.vue */ "./resources/assets/js/components/GameImageDialog.vue")["default"],
    'game-messages-list-modal': __webpack_require__(/*! ./GameMessagesListModal.vue */ "./resources/assets/js/components/GameMessagesListModal.vue")["default"],
    'notification-modal': __webpack_require__(/*! ./NotificationModal.vue */ "./resources/assets/js/components/NotificationModal.vue")["default"]
  },
  props: ['latitude', 'longitude', 'game', 'baseUrl'],
  mixins: [_mixins_MarkerIcon_js__WEBPACK_IMPORTED_MODULE_0__["default"]],
  mounted: function mounted() {
    var _this2 = this;

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
      streetViewControl: enableStreetView,
      styles: [{
        featureType: 'poi',
        stylers: [{
          visibility: 'off'
        }]
      }, {
        featureType: 'transit.station',
        stylers: [{
          visibility: 'off'
        }]
      }]
    };
    this.mapData.iconAnchor = new google.maps.Point(20, 20);
    this.mapData.iconSize = new google.maps.Size(60, 60);
    this.mapData.iconScaledSize = new google.maps.Size(40, 40);
    this.$nextTick(function () {
      _this2.initMap();

      _this2.getGameData();
    });
  },
  data: function data() {
    return {
      question: null,
      answer: null,
      gpsError: false,
      position: null,
      flashExercises: [],
      activeFlashExerciseId: null,
      notificationTitle: null,
      notificationMessage: null,
      gameIsStopped: false
    };
  },
  watch: {
    gpsError: function gpsError(value) {
      var mapControlsElement = document.getElementById('sz-map-controls'); // Ignore any attempts to show GPS error until UI is ready

      if (!mapControlsElement) return;
      var elementId = 'sz-gps-error',
          element = document.getElementById('sz-gps-error');

      if (value === true) {
        if (!element) {
          this.initGpsErrorControl(elementId);
        } else {
          element.style.display = 'initial';
        }
      } else {
        if (element) {
          element.style.display = 'none';
        }
      }
    }
  },
  methods: {
    initMap: function initMap() {
      var _this = this;

      this.mapData.map = new google.maps.Map(document.getElementById('map'), this.mapData.mapOptions);
      this.mapData.infoWindow = new google.maps.InfoWindow({
        disableAutoPan: true
      });
      this.initGroundOverlays();
      this.initPlayerMarker();
      this.initGameControls();

      if (_this.game.activity.questions) {
        var map = _this.mapData.map,
            markers = _this.mapData.markers,
            infoWindow = _this.mapData.infoWindow,
            playerMarker = _this.mapData.playerMarker;

        _.each(_this.game.activity.questions, function (question) {
          if (question.is_flash) {
            _this.flashExercises.push(question);

            setTimeout(function () {
              $('#admin-flash-exercises-control-item').removeClass('hidden');
            }, 2500);
            return true;
          }

          var marker = new google.maps.Marker({
            title: question.title,
            position: {
              lat: Number(question.latitude),
              lng: Number(question.longitude)
            },
            map: map,
            animation: google.maps.Animation.DROP,
            questionId: question.id,
            questionType: question.type,
            hasAccessCode: _this.hasAccessCode(question),
            optimized: false
          });

          _this.$nextTick(function () {
            _this.detectAndSetMarkerIcon(marker);
          });

          markers.push(marker);
          marker.addListener('click', function () {
            var answer = _this.getAnswer(question.id);

            if (_this.isAnswered(question.id)) {
              _this.openQuestionModal(question, answer);

              return;
            }

            if (_this.getEnforceItemsOrder() > 0) {
              var nextMarkers = _this.getNextUnansweredMarkers();

              if (nextMarkers.length > 0) {
                var nextMarker = nextMarkers.find(function (thisMarker) {
                  return marker.questionId === thisMarker.questionId;
                });

                if (typeof nextMarker === 'undefined') {
                  return _this.openNewInfoWindow(infoWindow, marker, map);
                }
              } else {
                return _this.openNewInfoWindow(infoWindow, marker, map);
              }
            }

            if (_this.hasProximityCheck()) {
              var distance = google.maps.geometry.spherical.computeDistanceBetween(playerMarker.getPosition(), marker.getPosition());

              if (distance <= _this.getProximityRadius()) {
                _this.openQuestionModal(question, answer);
              } else if (_this.hasAccessCode(question)) {
                _this.openAccessCodeModal(question);
              } else {
                _this.openNewInfoWindow(infoWindow, marker, map);
              }
            } else {
              _this.openQuestionModal(question, answer);
            }
          });
        });

        if (connectMarkers) {
          _this.connectMarkers();
        }

        _this.initUpdateClosestUnansweredMarkerArrow();
      }

      this.$parent.getGeoLocation(function (position) {
        var map = _this.mapData.map,
            playerMarker = _this.mapData.playerMarker;
        _this.gpsError = false;
        playerMarker.setPosition({
          lat: position.coords.latitude,
          lng: position.coords.longitude
        });

        if (map.szTrackingEnabled === true) {
          map.panTo(playerMarker.getPosition());
        }

        _this.initUpdateClosestUnansweredMarkerArrow();

        if (_this.hasProximityCheck()) {
          // TODO Might make sense to cancel in case location
          // does change rpidly
          // Giving it half a second or so should be good enough
          _.each(_this.mapData.markers, function (marker) {
            if (!_this.isAnswered(marker.questionId)) {
              _this.detectAndSetMarkerIcon(marker);
            }
          });
        }

        _this.setPosition(position);

        _this.logPlayerPosition(_this.getPosition());

        _this.initPlayerPositionLogging();
      }, true, function (error) {
        _this.gpsError = true;
      });
    },
    initActiveFlashExercise: function initActiveFlashExercise() {
      this.getActiveFlashExercise();
    },
    getActiveFlashExercise: function getActiveFlashExercise() {
      var _this3 = this;

      this.$http.get('/api/games/' + this.game.id + '/get-active-flash-exercise').then(function (response) {
        if (typeof response.body.id !== 'undefined') {
          $('#user-flash-exercise-control-item').removeClass('hidden');

          if (_this3.activeFlashExerciseId === null) {
            _this3.activeFlashExerciseId = parseInt(response.body.id);

            _this3.showNotification(_this3.$t('new-flash-exercise-title'), _this3.$t('new-flash-exercise-message'));
          }
        } else {
          if (_this3.activeFlashExerciseId !== null) {
            _this3.activeFlashExerciseId = null;
            $('#user-flash-exercise-control-item').addClass('hidden');

            _this3.$refs.questionModal.closeQuestion(_this3.$t('flash-exercise-has-been-deactivated'));
          }
        }

        setTimeout(function () {
          _this3.getActiveFlashExercise();
        }, 5000);
      }, function (error) {});
    },
    getGameData: function getGameData() {
      var _this4 = this;

      this.$http.get('/api/games/' + this.game.id + '/get-game-data').then(function (response) {
        if (typeof response.body !== 'undefined') {
          var data = response.body;

          _this4.showHideFlashExercises(data.flash_exercise);

          _this4.showHideGameIsStopped(data.start_stop);

          _this4.showNewMessages(data.messages);
        }
      });
      setTimeout(function () {
        _this4.getGameData();
      }, 5000);
    },
    showNewMessages: function showNewMessages(messages) {
      this.showNextMessage(messages, 0);
    },
    showNextMessage: function showNextMessage(messages, index) {
      var _this5 = this;

      var length = messages.length;

      if (index < length) {
        setTimeout(function () {
          var message = messages[index];

          _this5.openNewMessageModal(message);

          if (index + 1 < length) {
            setTimeout(function () {
              _this5.showNextMessage(messages, index + 1);
            }, 5000);
          }
        }, 5000);
      }
    },
    openNewMessageModal: function openNewMessageModal(message) {
      this.notificationTitle = this.$t('new-message');
      this.notificationMessage = message.message;
      this.$refs.notificationModal.open();
    },
    showHideFlashExercises: function showHideFlashExercises(data) {
      if (typeof data.id !== 'undefined') {
        $('#user-flash-exercise-control-item').removeClass('hidden');

        if (this.activeFlashExerciseId === null) {
          this.activeFlashExerciseId = parseInt(data.id);
          this.showNotification(this.$t('new-flash-exercise-title'), this.$t('new-flash-exercise-message'));
        }
      } else {
        if (this.activeFlashExerciseId !== null) {
          this.activeFlashExerciseId = null;
          this.$refs.notificationModal.close();
          $('#user-flash-exercise-control-item').addClass('hidden');
          this.$refs.questionModal.closeQuestion(this.$t('flash-exercise-has-been-deactivated'));
        }
      }
    },
    showHideGameIsStopped: function showHideGameIsStopped(data) {
      if ((typeof data.started !== 'undefined' && data.started === 1) === false) {
        this.$parent.checkUnload = false;
        window.location.href = '/games/' + this.game.id + '/stopped';
      }
    },
    showNotification: function showNotification(title, message) {
      var _this6 = this;

      this.$refs.notificationModal.close();
      this.$nextTick(function () {
        _this6.notificationTitle = title;
        _this6.notificationMessage = message;

        _this6.$refs.notificationModal.open();
      });
    },
    initGroundOverlays: function initGroundOverlays() {
      this.mapData.skansenGroundOverlay = new google.maps.GroundOverlay(this.baseUrl + '/img/map/overlays/skansen.png', {
        north: 59.329167,
        south: 59.324011,
        east: 18.111242,
        west: 18.099022
      }, {
        clickable: false,
        map: this.mapData.map
      });
    },
    initGameControls: function initGameControls() {
      var map = this.mapData.map,
          playerMarker = this.mapData.playerMarker,
          gameControlsDiv = document.createElement('div'),
          gameControls = new GameControls(gameControlsDiv, map, playerMarker, this); // XXX This is a strange code pience that sends index without a reason

      gameControls.index = 1;
      map.controls[google.maps.ControlPosition.TOP_RIGHT].push(gameControlsDiv);
    },
    initGpsErrorControl: function initGpsErrorControl(elementId) {
      var element = document.createElement('div');
      element.id = elementId;
      element.innerHTML = '<span>' + this.$t('gps-error') + '</span>';
      element.style['margin-top'] = document.getElementById('sz-map-controls').offsetHeight + 'px';
      this.mapData.map.controls[google.maps.ControlPosition.TOP_LEFT].push(element);
    },
    closeInfoWindow: function closeInfoWindow() {
      var infoWindow = this.mapData.infoWindow;

      if (infoWindow && infoWindow.getMap()) {
        infoWindow.close();
      }
    },
    openNewInfoWindow: function openNewInfoWindow(infoWindow, marker, map) {
      this.closeInfoWindow();
      infoWindow.setContent(marker.title);
      infoWindow.open(map, marker);
      return true;
    },
    initPlayerMarker: function initPlayerMarker() {
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
      playerMarker.addListener('click', function () {
        _this.closeInfoWindow();

        infoWindow.setContent(this.title);
        infoWindow.open(map, this);
      });

      if (this.hasProximityCheck()) {
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
    findQuestionById: function findQuestionById(id) {
      return _.find(this.game.activity.questions, ['id', id]);
    },
    isAnswered: function isAnswered(questionId) {
      var answer = this.getAnswer(questionId);

      if (answer === null) {
        return false;
      }

      return answer.is_answered > 0;
    },
    isCorrect: function isCorrect(questionId) {
      var answer = this.getAnswer(questionId);
      return answer && answer.correct === true;
    },
    hasAccessCode: function hasAccessCode(question) {
      return !!(question && question.access_code);
    },
    markAnswered: function markAnswered(id, answer) {
      this.$set(this.game.answers, id, answer); // TODO Might make sense to raise an error if marker can not be found

      var marker = _.find(this.mapData.markers, function (marker) {
        return marker.questionId === id;
      });

      if (marker) {
        this.detectAndSetMarkerIcon(marker);
      }

      var answerIds = _.keys(this.game.answers).map(function (id) {
        return _.toNumber(id);
      });

      var questionIds = _.map(this.game.activity.questions, function (question) {
        return question.id;
      });

      this.initUpdateClosestUnansweredMarkerArrow();

      if (_.intersection(questionIds, answerIds).length === questionIds.length && answer.is_answered) {
        this.game.complete = true;
      }
    },
    connectMarkers: function connectMarkers() {
      var map = this.mapData.map,
          markers = this.mapData.markers;

      if (markers.length > 1) {
        _.each(markers, function (marker, index) {
          if (index === 0) {
            return;
          }

          var line = new google.maps.Polyline({
            path: [markers[index - 1].getPosition(), markers[index].getPosition()],
            strokeWeight: 2,
            strokeOpacity: 0.5,
            icons: [{
              icon: {
                path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
              },
              offset: '100%'
            }],
            geodesic: true,
            map: map
          });
        });
      }
    },
    hasProximityCheck: function hasProximityCheck() {
      return this.game.activity.proximity_check;
    },
    getProximityRadius: function getProximityRadius() {
      return this.game.activity.proximity_radius || 25;
    },
    getEnforceItemsOrder: function getEnforceItemsOrder() {
      return parseInt(this.game.activity.enforce_items_order) || 0;
    },
    openAnsweringTimeModal: function openAnsweringTimeModal(question) {
      var _this7 = this;

      this.question = question;
      this.$nextTick(function () {
        _this7.$refs.answeringTimeModal.open();
      });
    },
    getAnswer: function getAnswer(questionId, defaultValue) {
      if (typeof defaultValue === 'undefined') {
        defaultValue = null;
      }

      return _.get(this.game.answers, questionId, defaultValue);
    },
    isAnswering: function isAnswering(questionId) {
      var answer = this.getAnswer(questionId);

      if (answer === null || answer.is_answered > 0) {
        return false;
      } else if (answer.answering_start_time != null) {
        return true;
      }

      return false;
    },
    openAnsweringTimeIsUpModal: function openAnsweringTimeIsUpModal(message) {
      var _this8 = this;

      this.$nextTick(function () {
        _this8.$refs.answeringTimeIsUpModal.open(message);
      });
    },
    openQuestionModal: function openQuestionModal(question, answer) {
      var _this9 = this;

      if (!!question.answering_time_check && this.isAnswering(question.id) === false && this.isAnswered(question.id) === false) {
        this.openAnsweringTimeModal(question);
      } else {
        this.question = question;
        this.answer = answer ? answer : null;
        this.$nextTick(function () {
          _this9.$refs.questionModal.open();
        });
      }
    },
    openAccessCodeModal: function openAccessCodeModal(question) {
      var _this10 = this;

      this.question = question;
      this.answer = null;
      this.$nextTick(function () {
        _this10.$refs.accessCodeModal.open();
      });
    },
    detectMarkerIconState: function detectMarkerIconState(marker) {
      // TODO Check if we should fail in case question could not be found
      var question = this.findQuestionById(marker.questionId);
      var distance = google.maps.geometry.spherical.computeDistanceBetween(this.mapData.playerMarker.getPosition(), marker.getPosition());

      if (question && this.isAnswered(question.id)) {
        return this.isCorrect(question.id) ? 'correct' : 'incorrect';
      } else if (this.getEnforceItemsOrder() > 0) {
        var nextMarkers = this.getNextUnansweredMarkers();

        if (nextMarkers.length > 0) {
          for (var nextMarkerIndex in nextMarkers) {
            var nextMarker = nextMarkers[nextMarkerIndex];

            if (marker.questionId === nextMarker.questionId) {
              return 'active';
            }
          }

          return 'inactive';
        } else {
          return 'inactive';
        }
      } else if (this.hasProximityCheck() && distance > this.getProximityRadius()) {
        return 'inactive';
      }

      return 'active';
    },
    detectAndSetMarkerIcon: function detectAndSetMarkerIcon(marker) {
      if (typeof marker.isUser !== 'undefined') {
        return false;
      }

      var state = this.detectMarkerIconState(marker);
      var hasAccessCode = marker.hasAccessCode;

      if (this.getEnforceItemsOrder() > 0) {
        hasAccessCode = false;
      }

      marker.setIcon({
        anchor: this.mapData.iconAnchor,
        size: this.mapData.iconSize,
        scaledSize: this.mapData.iconScaledSize,
        url: this.getIconUrl(state, marker.questionType, hasAccessCode)
      });
    },
    getMarkerBounds: function getMarkerBounds() {
      if (this.mapData.markerBounds) return this.mapData.markerBounds;
      this.mapData.markerBounds = new google.maps.LatLngBounds();

      if (this.mapData.markers.length > 0) {
        var vm = this;

        _.each(this.mapData.markers, function (marker) {
          vm.mapData.markerBounds.extend(marker.getPosition());
        });
      }

      return this.mapData.markerBounds;
    },
    getAnsweredQuestionsCount: function getAnsweredQuestionsCount() {
      if (_.size(this.game.activity.questions) === 0 || _.size(this.game.answers) === 0) return 0;

      var questionIds = _.map(this.game.activity.questions, function (question) {
        return question.id;
      });

      var answered = _.filter(this.game.answers, function (answer) {
        return questionIds.indexOf(answer.question) !== -1;
      });

      return _.size(answered);
    },
    getUnansweredMarkers: function getUnansweredMarkers() {
      var vm = this;
      return _.filter(this.mapData.markers, function (marker) {
        return typeof marker.isUser === 'undefined' && !vm.isAnswered(marker.questionId);
      });
    },
    getClosestUnansweredMarker: function getClosestUnansweredMarker() {
      var vm = this,
          unansweredMarkers = vm.getUnansweredMarkers(),
          playerMarker = this.mapData.playerMarker;

      if (unansweredMarkers.length > 0) {
        return _.minBy(unansweredMarkers, function (marker) {
          return google.maps.geometry.spherical.computeDistanceBetween(playerMarker.getPosition(), marker.getPosition());
        });
      }

      return null;
    },
    getNextUnansweredMarker: function getNextUnansweredMarker() {
      var vm = this,
          unansweredMarkers = vm.getUnansweredMarkers(),
          playerMarker = this.mapData.playerMarker;

      if (unansweredMarkers.length > 0) {
        return _.minBy(unansweredMarkers, function (marker) {
          var question = vm.findQuestionById(marker.questionId);

          if (question) {
            var position = parseInt(question.position);
            var distance = google.maps.geometry.spherical.computeDistanceBetween(playerMarker.getPosition(), marker.getPosition());
            return parseFloat(position + '.' + distance);
          }

          return 10000;
        });
      }

      return null;
    },
    getNextUnansweredMarkers: function getNextUnansweredMarkers() {
      var vm = this,
          unansweredMarkers = vm.getUnansweredMarkers(),
          markers = [];

      if (unansweredMarkers.length > 0) {
        var nextMarker = this.getNextUnansweredMarker();

        if (nextMarker && nextMarker.questionId) {
          var nextQuestionId = nextMarker.questionId;
          var nextQuestion = this.findQuestionById(nextQuestionId);

          if (typeof nextQuestion !== 'undefined') {
            var nextPosition = nextQuestion.position;

            _.each(unansweredMarkers, function (marker) {
              var question = vm.findQuestionById(marker.questionId);

              if (question && question.position === nextPosition) {
                markers.push(marker);
              }
            });
          }
        }
      }

      return markers;
    },
    initUpdateClosestUnansweredMarkerArrow: function initUpdateClosestUnansweredMarkerArrow() {
      var vm = this;
      var marker = null;

      if (vm.getEnforceItemsOrder() > 0) {
        marker = vm.getNextUnansweredMarker();
      } else {
        marker = vm.getClosestUnansweredMarker();
      }

      if (!marker) {
        if (vm.mapData.closestUnansweredMarkerArrow) {
          vm.mapData.closestUnansweredMarkerArrow.setMap(null);
        }

        return;
      }

      if (!vm.mapData.closestUnansweredMarkerArrow) {
        vm.mapData.closestUnansweredMarkerArrow = new google.maps.Polyline({
          path: [vm.mapData.playerMarker.getPosition(), marker.getPosition()],
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
            offset: '50px'
          }],
          geodesic: true,
          map: vm.mapData.map,
          zIndex: 2
        });
      } else {
        vm.mapData.closestUnansweredMarkerArrow.setPath([vm.mapData.playerMarker.getPosition(), marker.getPosition()]);
      }

      this.detectAndSetMarkerIcon(marker);
    },
    initPlayerPositionLogging: function initPlayerPositionLogging() {
      if (this.game.complete) return;
      var vm = this;
      var playerPositionIntervalId = setInterval(function () {
        vm.logPlayerPosition(vm.getPosition());
      }, 60000);
      vm.$watch('game.complete', function (newVal, oldVal) {
        if (newVal === true) {
          clearInterval(playerPositionIntervalId);
        }
      });
    },
    setPosition: function setPosition(position) {
      this.position = position;
    },
    getPosition: function getPosition() {
      return this.position;
    },
    logPlayerPosition: function logPlayerPosition(position) {
      if (!position) return;
      var data = {
        game_id: this.game.id,
        position: {
          coords: {
            latitude: position.coords.latitude,
            longitude: position.coords.longitude,
            altitude: position.coords.altitude,
            accuracy: position.coords.accuracy,
            altitudeAccuracy: position.coords.altitudeAccuracy,
            heading: position.coords.heading,
            speed: position.coords.speed
          },
          timestamp: position.timestamp
        }
      };
      this.$http.post(this.baseUrl + '/api/games/position', data).then(function (response) {// Succeed silently
      }, function (response) {// Fail silently
      });
    },
    openImageDialog: function openImageDialog(id, answer) {
      var _this11 = this;

      var question = this.findQuestionById(id);
      var dialog; // TODO Consider creating a mixin that would have methods to
      // determine question types

      if (question.type === 2 || question.type === 3 || question.type === 8) {
        if (answer.correct === true) {
          dialog = this.$refs.correctImageDialog;
        } else {
          dialog = this.$refs.incorrectImageDialog;
        }
      } else {
        dialog = this.$refs.submittedImageDialog;
      }

      dialog.open();
      dialog.$once('hidden:image:dialog', function () {
        _this11.markAnswered(id, answer);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['game_id', 'type'],
  mixins: [],
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      _this.getMessages();
    });
  },
  data: function data() {
    return {
      messages: [],
      newMessage: '',
      inAjaxCall: false,
      event: null
    };
  },
  methods: {
    isManager: function isManager() {
      return this.type === 'monitoring';
    },
    deleteMessage: function deleteMessage(e, id) {
      var _this2 = this;

      this.$http.get('/api/games/' + this.game_id + '/delete-message/' + id).then(function (response) {
        _this2.getMessages();
      });
    },
    addNewMessage: function addNewMessage(e) {
      var _this3 = this;

      if (this.newMessage.length > 0) {
        this.$http.post('/api/games/' + this.game_id + '/add-new-message', {
          message: this.newMessage
        }).then(function (response) {
          _this3.newMessage = '';

          _this3.getMessages();
        });
      }
    },
    getMessages: function getMessages() {
      var _this4 = this;

      this.$http.get('/api/games/' + this.game_id + '/get-all-messages').then(function (response) {
        _this4.messages = response.body || [];
      });
    },
    open: function open() {
      var _this5 = this;

      this.$nextTick(function () {
        $(_this5.$refs.modal).modal('show');

        _this5.getMessages();
      });
      return $(this.$refs.modal);
    },
    close: function close() {
      var _this6 = this;

      this.$nextTick(function () {
        $(_this6.$refs.modal).modal('hide');
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameQuestionModal.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameQuestionModal.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mixins_Image_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../mixins/Image.js */ "./resources/assets/js/mixins/Image.js");
/* harmony import */ var _mixins_MissingWord_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./../mixins/MissingWord.js */ "./resources/assets/js/mixins/MissingWord.js");
/* harmony import */ var _debounce__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../debounce */ "./resources/assets/js/debounce.js");
/* harmony import */ var _debounce__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_debounce__WEBPACK_IMPORTED_MODULE_2__);
function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['question', 'answer', 'gameId', 'baseUrl', 'isPreview'],
  mixins: [_mixins_Image_js__WEBPACK_IMPORTED_MODULE_0__["default"], _mixins_MissingWord_js__WEBPACK_IMPORTED_MODULE_1__["default"]],
  mounted: function mounted() {
    var _this = this;

    var vm = this;
    this.$nextTick(function () {
      $(_this.$refs.modal).on('hide.bs.modal', function (e) {
        if (vm.inAjaxCall) {
          e.preventDefault();
        }
      });
    });
  },
  data: function data() {
    return {
      isOpen: false,
      selectedOptions: [],
      textualAnswer: '',
      hasImageSelected: false,
      imageSrc: null,
      chosenPair: {
        option: null,
        match: null
      },
      matchedPairs: [],
      shuffledPairs: [],
      matchableStyles: {
        'min-height': '100px'
      },
      inAjaxCall: false,
      incorrectImageFormat: false,
      answeringTime: null,
      missingWords: [],
      isMissingWordFilled: false
    };
  },
  methods: {
    calculateRemainingAnsweringTime: function calculateRemainingAnsweringTime() {
      var _this2 = this;

      if (this.answer && this.answer.answering_start_time !== null && this.$parent.isAnswered(this.question.id) === false) {
        var startTimeString = this.answer.answering_start_time;
        var startTimeDate = new Date(startTimeString);
        var nowDate = new Date();
        var totalTimeInMilliseconds = 1000 * this.question.answering_time;
        var usedTime = nowDate.getTime() - startTimeDate.getTime();
        var usedTimeInMilliseconds = 1000 * Math.round(usedTime / 1000);
        var remainingTimeInMilliseconds = totalTimeInMilliseconds - usedTimeInMilliseconds;

        if (remainingTimeInMilliseconds < 0) {
          this.$nextTick(function () {
            _this2.closeQuestion();
          });
          return false;
        }

        var remainingTimeDate = new Date(remainingTimeInMilliseconds);
        this.answeringTime = '';

        if (remainingTimeDate.getUTCHours() > 0) {
          this.answeringTime += ('0' + remainingTimeDate.getUTCHours()).slice(-2);
          this.answeringTime += ':';
        }

        if (remainingTimeDate.getUTCMinutes() > 0) {
          this.answeringTime += ('0' + remainingTimeDate.getUTCMinutes()).slice(-2);
          this.answeringTime += ':';
        } else {
          this.answeringTime += '00:';
        }

        this.answeringTime += ('0' + remainingTimeDate.getUTCSeconds()).slice(-2);
        setTimeout(function () {
          _this2.calculateRemainingAnsweringTime();
        }, 1000);
      } else {
        this.answeringTime = null;
      }
    },
    closeQuestion: function closeQuestion(closeMessage) {
      var vm = this;
      var data = {
        game_id: this.gameId,
        question_id: this.question.id
      };
      this.inAjaxCall = true;
      this.$http.post(vm.baseUrl + '/api/games/close-question', data).then(function (response) {
        var isOpen = vm.isOpen;
        vm.inAjaxCall = false;
        vm.$parent.markAnswered(vm.question.id, response.body);
        vm.close();
        $('.modal-backdrop').remove();
        vm.$parent.answer = null;

        if (isOpen === true) {
          vm.$nextTick(function () {
            vm.$parent.openAnsweringTimeIsUpModal(closeMessage);
          });
        }
      }, function (response) {
        vm.inAjaxCall = false;
        setTimeout(function () {
          vm.closeQuestion();
        }, 2000);
      });
    },
    open: function open() {
      var _this3 = this;

      var url = '/api/games/' + this.gameId + '/start-question/' + this.question.id;
      this.$http.get(url).then(function (response) {
        _this3.isOpen = true;

        _this3.generateMissingWords();

        _this3.calculateRemainingAnsweringTime();

        if (_this3.isMatchPairs()) {
          if (_this3.pairs().length > 0) {
            if (!_this3.isAnswered()) {
              _this3.question.pairs = _.shuffle(_this3.pairs());
            } // TODO This produces a small visible size change,
            // might make sense to display things as invisible (not hidden)
            // do the resize and only then show


            $(_this3.$refs.modal).one('shown.bs.modal', function (e) {
              var vm = _this3;

              var heights = _.map(_this3.$refs.matchable, function (matchable) {
                return $(matchable).outerHeight(true);
              });

              var highest = _.max(heights);

              if (highest) {
                vm.matchableStyles['min-height'] = highest + 'px';
              }
            });
          }

          if (!_this3.isAnswered()) {
            _this3.shuffledPairs = _.shuffle(_this3.pairs());
          } else {
            _this3.shuffledPairs = _this3.pairs();
          }
        } else if (_this3.isOneCorrectAnswer() || _this3.isMultipleCorrectAnswers()) {
          if (_this3.options().length > 0) {
            _this3.question.options = _.shuffle(_this3.options());
          }
        }

        $(_this3.$refs.modal).modal('show');
      });
      return $(this.$refs.modal);
    },
    close: function close() {
      var _this4 = this;

      this.$nextTick(function () {
        $(_this4.$refs.modal).modal('hide');
        _this4.isOpen = false;
        _this4.selectedOptions = [];
        _this4.textualAnswer = '';
        _this4.hasImageSelected = false;
        _this4.imageSrc = null;
        _this4.chosenPair.option = null;
        _this4.chosenPair.mathc = null;
        _this4.matchedPairs = [];
        _this4.shuffledPairs = [];
        _this4.matchableStyles['min-height'] = '100px';
        _this4.inAjaxCall = false;
        $(_this4.$refs.image).val('');
        _this4.incorrectImageFormat = false;
        _this4.answeringTime = null;
        _this4.missingWords = [];
        _this4.isMissingWordFilled = false;
      });
    },
    submit: function submit() {
      if (this.inAjaxCall) return;
      var vm = this;
      this.inAjaxCall = true;
      var data = {
        'game_id': this.gameId,
        'question_id': this.question.id
      };

      if (this.isOneCorrectAnswer() || this.isMultipleCorrectAnswers()) {
        data.options = this.selectedOptions;
      } else if (this.isFreeformAnswer() || this.isEmbeddedContent()) {
        data.text = this.textualAnswer;
      }

      if (this.isPhoto()) {
        var formData = new FormData();

        _.each(data, function (item, key) {
          formData.append(key, item);
        });

        formData.append('image', this.$refs.image.files[0]);
        data = formData;
      }

      if (this.isMissingWord()) {
        data.text = this.missingWordsToString(this.missingWords);
      }

      this.$http.post(vm.baseUrl + '/api/games/answer', data).then(function (response) {
        vm.inAjaxCall = false; // const url = vm.baseUrl + '/api/games/' + vm.gameId + '/send-question-answer-to-lrs/' + vm.question.id;
        // vm.$http.get(url).then(respone => {});

        vm.$parent.openImageDialog(vm.question.id, response.body);
        vm.close();
      }, function (response) {
        vm.inAjaxCall = false;
        console.error('Error', response); // TODO Might need to notify user abut the error
      });
    },
    title: function title() {
      return this.question ? this.question.title : '';
    },
    description: function description() {
      return this.question ? this.question.description : '';
    },
    hasImage: function hasImage() {
      return this.question && this.question.image_url;
    },
    image: function image() {
      return this.question ? this.question.image_url : '';
    },
    embeddedContent: function embeddedContent() {
      return this.question ? this.question.embedded_content : '';
    },
    hasReadMore: function hasReadMore() {
      return this.question && this.question.read_more;
    },
    readMore: function readMore() {
      return this.question ? this.question.read_more : '';
    },
    options: function options() {
      return this.question && this.question.options ? this.question.options : [];
    },
    pairs: function pairs(shuffled) {
      if (shuffled === true) {
        return this.shuffledPairs;
      }

      return this.question && this.question.pairs ? this.question.pairs : [];
    },
    isInformation: function isInformation() {
      return this.question ? this.question.type == window.Laravel.questionTypeConstants.INFORMATION : false;
    },
    isOneCorrectAnswer: function isOneCorrectAnswer() {
      return this.question ? this.question.type == window.Laravel.questionTypeConstants.ONE_CORRECT_ANSWER : false;
    },
    isMultipleCorrectAnswers: function isMultipleCorrectAnswers() {
      return this.question ? this.question.type == window.Laravel.questionTypeConstants.MULTIPLE_CORRECT_ANSWERS : false;
    },
    isFreeformAnswer: function isFreeformAnswer() {
      return this.question ? this.question.type == window.Laravel.questionTypeConstants.FREEFORM_ANSWER : false;
    },
    isMatchPairs: function isMatchPairs() {
      return this.question ? this.question.type == window.Laravel.questionTypeConstants.MATCH_PAIRS : false;
    },
    isEmbeddedContent: function isEmbeddedContent() {
      return this.question ? this.question.type == window.Laravel.questionTypeConstants.EMBEDDED_CONTENT : false;
    },
    isPhoto: function isPhoto() {
      return this.question ? this.question.type == window.Laravel.questionTypeConstants.PHOTO : false;
    },
    isMissingWord: function isMissingWord() {
      return this.question ? this.question.type == window.Laravel.questionTypeConstants.MISSING_WORD : false;
    },
    onMissingWordChange: _debounce__WEBPACK_IMPORTED_MODULE_2___default()(function (e) {
      var input = e.target;
      var index = input.getAttribute('data-index');
      this.$set(this.missingWords[index], 'answer', input.value);
      this.$set(this.missingWords[index], 'isCorrect', input.value.trim().toLowerCase() === this.missingWords[index].text.trim().toLowerCase());
      var words = this.missingWords.filter(function (word) {
        return word.type === 'input' && word.answer.trim().length === 0;
      });
      this.isMissingWordFilled = words.length === 0;
    }, 100),
    generateMissingWords: function generateMissingWords() {
      if (!this.isMissingWord()) {
        return false;
      }

      var question = this.question.missing_word;
      var answer = '';
      var questionArray = this.missingWordsToArray(question);
      var answerArray = [];

      if (this.isAnswered()) {
        answer = this.answer.answer.text;
        answerArray = this.missingWordsToArray(answer);
        var questionArrayLength = questionArray.length;
        var answerArrayLength = answerArray.length;

        if (questionArrayLength === answerArrayLength) {
          for (var i = 0; i < questionArrayLength; i++) {
            questionArray[i].answer = answerArray[i].text;
            questionArray[i].isCorrect = questionArray[i].text.trim().toLowerCase() === answerArray[i].text.trim().toLowerCase();
          }
        }
      }

      this.missingWords = questionArray;
    },
    isSelectedOption: function isSelectedOption(id) {
      var options;

      if (!this.isAnswered()) {
        options = this.selectedOptions;
      } else {
        options = this.answer.answer.options;
      }

      if (options && _typeof(options) === 'object') {
        return options.indexOf(id) !== -1;
      }

      return options === id;
    },
    triggerOptionClick: function triggerOptionClick(index) {
      if (!this.isAnswered()) {
        $(this.$refs['option'][index]).trigger('click');
      }
    },
    triggerImageClick: function triggerImageClick() {
      $(this.$refs.image).trigger('click');
    },
    imageSelected: function imageSelected(event) {
      if (event.target.files.length > 0) {
        var file = event.target.files[0];

        if (!this.isValidImageFormat(file)) {
          $(event.target).val('');
          this.hasImageSelected = false;
          this.incorrectImageFormat = true;
          return;
        }

        if (window.FileReader) {
          var reader = new FileReader(),
              vm = this;

          reader.onload = function (e) {
            vm.imageSrc = e.target.result;
          };

          reader.readAsDataURL(file);
        }

        this.hasImageSelected = true;
        this.incorrectImageFormat = false;
      }
    },
    canSubmit: function canSubmit() {
      if (this.isInformation()) {
        return true;
      } else if (this.isOneCorrectAnswer() || this.isMultipleCorrectAnswers()) {
        if (_typeof(this.selectedOptions) === 'object') {
          return this.selectedOptions.length > 0;
        } else {
          return !!this.selectedOptions;
        }

        return !!this.selectedOptions;
      } else if (this.isFreeformAnswer() || this.isEmbeddedContent()) {
        return !!this.textualAnswer.trim();
      } else if (this.isMatchPairs()) {
        return this.matchedPairs.length === this.pairs().length;
      } else if (this.isPhoto()) {
        return this.hasImageSelected;
      } else if (this.isMissingWord()) {
        return this.isMissingWordFilled;
      }

      return false;
    },
    resetChosenPair: function resetChosenPair() {
      var _this5 = this;

      this.$nextTick(function () {
        var vm = _this5;
        setTimeout(function () {
          vm.chosenPair.option = null;
          vm.chosenPair.match = null;
        }, 250);
      });
    },
    choose: function choose(type, pair) {
      if (this.isMatchedPair(pair)) {
        return;
      }

      this.chosenPair[type] = pair.id;

      if (this.chosenPair.option === this.chosenPair.match) {
        this.matchedPairs.push(pair.id);
        this.resetChosenPair();
      } else if (this.chosenPair.option !== null && this.chosenPair.match !== null) {
        this.resetChosenPair();
      }
    },
    choosePair: function choosePair(pair) {
      this.choose('option', pair);
    },
    choosePairMatch: function choosePairMatch(pair) {
      this.choose('match', pair);
    },
    isOptionChosen: function isOptionChosen(pair) {
      return this.chosenPair.option === pair.id;
    },
    isOptionMatchChosen: function isOptionMatchChosen(pair) {
      return this.chosenPair.match === pair.id;
    },
    isMatchedPair: function isMatchedPair(pair) {
      if (this.isAnswered()) {
        return true;
      }

      return this.matchedPairs.indexOf(pair.id) !== -1;
    },
    isAnswered: function isAnswered() {
      return !!this.answer && this.answer.is_answered;
    },
    isCorrectOption: function isCorrectOption(option) {
      return !!option.correct;
    },
    optionIconClass: function optionIconClass(option) {
      var classes = [];
      var isCorrect = this.isCorrectOption(option);
      var isChosen = this.isSelectedOption(option.id);

      if (isChosen) {
        if (isCorrect) {
          classes.push('correct');
        } else {
          classes.push('incorrect');
        }
      }

      if (this.isOneCorrectAnswer()) {
        if (isCorrect) {
          classes.push('mdi-checkbox-marked-circle-outline');
        } else {
          classes.push('mdi-close-circle-outline');
        }
      } else if (this.isMultipleCorrectAnswers()) {
        if (isCorrect) {
          classes.push('mdi-checkbox-marked-outline');
        } else {
          classes.push('mdi-close-box-outline');
        }
      }

      return classes;
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameRatingModal.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameRatingModal.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['game', 'baseUrl'],
  data: function data() {
    return {
      stars: [1, 2, 3, 4, 5],
      callback: null,
      event: null
    };
  },
  methods: {
    addRating: function addRating(e, star) {
      var _this = this;

      this.$http.get('/api/games/' + this.game.id + '/add-rating/' + star).then(function (response) {
        _this.close();
      });
    },
    mouseOverStar: function mouseOverStar(e) {
      var this_value = e.target.dataset.value;
      var stars = document.getElementsByClassName('star');
      var starsLength = stars.length;

      for (var i = 0; i < starsLength; i++) {
        var star = stars[i];
        var star_value = star.dataset.value;

        if (star_value <= this_value) {
          star.classList.remove('mdi-star-outline');
          star.classList.add('mdi-star');
        } else {
          star.classList.remove('mdi-star');
          star.classList.add('mdi-star-outline');
        }
      }
    },
    open: function open(callback) {
      var _this2 = this;

      this.callback = callback;
      this.$nextTick(function () {
        $(_this2.$refs.modal).modal('show');
      });
    },
    close: function close() {
      var _this3 = this;

      this.$nextTick(function () {
        $(_this3.$refs.modal).modal('hide');

        _this3.callback();
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameResultsModal.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameResultsModal.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mixins_MissingWord_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../mixins/MissingWord.js */ "./resources/assets/js/mixins/MissingWord.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['game', 'baseUrl'],
  mixins: [_mixins_MissingWord_js__WEBPACK_IMPORTED_MODULE_0__["default"]],
  mounted: function mounted() {
    var vm = this;
    this.$http.get(vm.baseUrl + '/api/games/' + vm.game.id + '/voucher', {}).then(function (response) {
      if (response.body.hasVoucher) {
        vm.voucher = response.body.voucher;
      }
    }, function (response) {//console.error('Error', response);
    });
  },
  data: function data() {
    return {
      voucher: false
    };
  },
  computed: {
    totalQuestionsCount: function totalQuestionsCount() {
      return this.game.activity.questions.length;
    },
    correctQuestionsCount: function correctQuestionsCount() {
      var vm = this;
      return _.filter(this.game.activity.questions, function (question) {
        if (vm.isCorrect(question)) {
          return question;
        }
      }).length;
    },
    getResultQuestions: function getResultQuestions() {
      if (this.game.activity.complete === true) {
        return this.game.activity.questions;
      }

      var answers = this.game.answers;
      return this.game.activity.questions.filter(function (question) {
        return typeof answers[question.id] !== 'undefined';
      });
    }
  },
  methods: {
    open: function open() {
      var _this = this;

      this.$nextTick(function () {
        $(_this.$refs.modal).modal('show');
        setTimeout(function () {
          if ($(document).find('body').hasClass('modal-open') === false) {
            $(document).find('body').addClass('modal-open');
          }
        }, 500);
      });
    },
    exit: function exit() {
      this.$parent.exit();
    },
    isInformation: function isInformation(question) {
      return question ? question.type == window.Laravel.questionTypeConstants.INFORMATION : false;
    },
    isOneCorrectAnswer: function isOneCorrectAnswer(question) {
      return question ? question.type == window.Laravel.questionTypeConstants.ONE_CORRECT_ANSWER : false;
    },
    isMultipleCorrectAnswers: function isMultipleCorrectAnswers(question) {
      return question ? question.type == window.Laravel.questionTypeConstants.MULTIPLE_CORRECT_ANSWERS : false;
    },
    isFreeformAnswer: function isFreeformAnswer(question) {
      return question ? question.type == window.Laravel.questionTypeConstants.FREEFORM_ANSWER : false;
    },
    isMatchPairs: function isMatchPairs(question) {
      return question ? question.type == window.Laravel.questionTypeConstants.MATCH_PAIRS : false;
    },
    isEmbeddedContent: function isEmbeddedContent(question) {
      return question ? question.type == window.Laravel.questionTypeConstants.EMBEDDED_CONTENT : false;
    },
    isPhoto: function isPhoto(question) {
      return question ? question.type == window.Laravel.questionTypeConstants.PHOTO : false;
    },
    isMissingWord: function isMissingWord(question) {
      return question ? question.type == window.Laravel.questionTypeConstants.MISSING_WORD : false;
    },
    hasAnswer: function hasAnswer(question) {
      return !!(this.game.answers && this.game.answers[question.id]);
    },
    isCorrect: function isCorrect(question) {
      if (!this.hasAnswer(question)) {
        return false;
      }

      return this.game.answers[question.id].correct;
    },
    hasGrade: function hasGrade(question) {
      if (!this.hasAnswer(question)) {
        return false;
      }

      return this.game.answers[question.id].grade !== null;
    },
    hasOptions: function hasOptions(question) {
      if (!this.hasAnswer(question)) {
        return false;
      }

      return !!this.game.answers[question.id].answer.options;
    },
    choseOption: function choseOption(question, option) {
      if (!this.hasOptions(question)) {
        return false;
      }

      return this.game.answers[question.id].answer.options.indexOf(option.id) !== -1;
    },
    isCorrectOption: function isCorrectOption(option) {
      return !!option.correct;
    },
    hasText: function hasText(question) {
      if (!this.hasAnswer(question)) {
        return false;
      }

      return !!this.game.answers[question.id].answer.text;
    },
    getText: function getText(question) {
      return this.game.answers[question.id].answer.text;
    },
    getMissingWordText: function getMissingWordText(question) {
      var answerText = this.getText(question);
      var questionText = question.missing_word;
      var answerArray = this.missingWordsToArray(answerText);
      var questionArray = this.missingWordsToArray(questionText);
      var questionArrayLength = questionArray.length;
      var text = '';

      for (var i = 0; i < questionArrayLength; i++) {
        /** @type {MissingWord} questionWord **/
        var questionWord = questionArray[i];
        /** @type {MissingWord} answerWord **/

        var answerWord = answerArray[i];

        if (questionWord.type === 'text') {
          text += questionWord.text;
        } else if (questionWord.type === 'input') {
          if (answerWord.text === questionWord.text) {
            text += '<span class="correct">';
            text += answerWord.text;
            text += '</span>';
          } else {
            text += '<span class="incorrect">';
            text += answerWord.text;
            text += '<span class="correct">( ';
            text += questionWord.text;
            text += ' )</span>';
            text += '</span>';
          }
        }
      }

      return text;
    },
    hasImage: function hasImage(question) {
      if (!this.hasAnswer(question)) {
        return false;
      }

      return !!this.game.answers[question.id].image;
    },
    getImage: function getImage(question) {
      return this.game.answers[question.id].image;
    },
    optionIconClass: function optionIconClass(question, option) {
      var classes = [];
      var isCorrect = this.isCorrectOption(option);
      var isChosen = this.choseOption(question, option);

      if (isChosen) {
        if (isCorrect) {
          classes.push('correct');
        } else {
          classes.push('incorrect');
        }
      }

      if (this.isOneCorrectAnswer(question)) {
        if (isCorrect) {
          classes.push('mdi-checkbox-marked-circle-outline');
        } else {
          classes.push('mdi-close-circle-outline');
        }
      } else if (this.isMultipleCorrectAnswers(question)) {
        if (isCorrect) {
          classes.push('mdi-checkbox-marked-outline');
        } else {
          classes.push('mdi-close-box-outline');
        }
      }

      return classes;
    },
    showResults: function showResults() {
      this.resultsShown = !this.resultsShown;
    },
    getVoucherImageUrl: function getVoucherImageUrl() {
      return this.baseUrl + '/img/vouchers/voucher.png';
    },
    getVoucherUrl: function getVoucherUrl() {
      return this.baseUrl + '/discount_vouchers';
    },
    gotVoucher: function gotVoucher() {
      return !!this.voucher;
    },
    voucherTitle: function voucherTitle() {
      return this.gotVoucher() ? this.voucher.title : '';
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameTutorialModal.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameTutorialModal.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['activity'],
  mounted: function mounted() {
    this.baseUrl = window.RADA.config.base_url;
    var vm = this;
    this.hammertime = new Hammer.Manager(this.$refs.tips, {
      recognizers: [[Hammer.Swipe, {
        direction: Hammer.DIRECTION_HORIZONTAL
      }]]
    });
    this.hammertime.on('swipeleft', function () {
      vm.nextItem();

      if (vm.isLastItem()) {
        vm.close();
      }
    });
    this.hammertime.on('swiperight', function () {
      vm.previousItem();
    });
  },
  data: function data() {
    return {
      baseUrl: '',
      currentItem: 'gameplay_instructions',
      items: ['gameplay_instructions', 'look_closely', 'look_out', 'do_not_disturb', 'help_others'],
      enterActiveClass: 'animated slideInRight',
      leaveActiveClass: 'animated slideOutLeft'
    };
  },
  methods: {
    open: function open() {
      var _this = this;

      this.$nextTick(function () {
        $(_this.$refs.modal).modal('show');
      });
    },
    close: function close() {
      var _this2 = this;

      this.$nextTick(function () {
        $(_this2.$refs.modal).modal('hide');

        _this2.$root.$emit('dialog:tutorial:close');
      });
    },
    getItemImageUrl: function getItemImageUrl(key, format) {
      if (!format) {
        format = 'jpg';
      }

      return this.baseUrl + '/img/guidelines/' + key + '.' + format;
    },
    isFirstItem: function isFirstItem() {
      return this.items.indexOf(this.currentItem) === 0;
    },
    isLastItem: function isLastItem() {
      return this.items.indexOf(this.currentItem) === this.items.length - 1;
    },
    nextItem: function nextItem() {
      var _this3 = this;

      if (!this.isLastItem() && this.currentItem) {
        var vm = this;
        this.enterActiveClass = 'animated slideInRight';
        this.leaveActiveClass = 'animated slideOutLeft';
        $(this.$refs.tips).css('min-height', $(this.$refs.tips).height());
        this.$nextTick(function () {
          vm.currentItem = vm.items[vm.items.indexOf(vm.currentItem) + 1];
          setTimeout(function () {
            $(_this3.$refs.tips).css('min-height', '');
          }, 2000);
        });
      }
    },
    previousItem: function previousItem() {
      var _this4 = this;

      if (!this.isFirstItem() && this.currentItem) {
        var vm = this;
        this.enterActiveClass = 'animated slideInLeft';
        this.leaveActiveClass = 'animated slideOutRight';
        $(this.$refs.tips).css('min-height', $(this.$refs.tips).height());
        this.$nextTick(function () {
          vm.currentItem = vm.items[vm.items.indexOf(vm.currentItem) - 1];
          setTimeout(function () {
            $(_this4.$refs.tips).css('min-height', '');
          }, 2000);
        });
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/NotificationModal.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/NotificationModal.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['title', 'message'],
  data: function data() {
    return {
      inAjaxCall: false
    };
  },
  methods: {
    open: function open() {
      var _this = this;

      this.$nextTick(function () {
        $(_this.$refs.modal).modal('show');
      });
      return $(this.$refs.modal);
    },
    close: function close() {
      var _this2 = this;

      this.$nextTick(function () {
        $(_this2.$refs.modal).modal('hide');
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// Imports
var ___CSS_LOADER_API_IMPORT___ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
exports = ___CSS_LOADER_API_IMPORT___(false);
// Module
exports.push([module.i, "\n.grading-control-item {\n    position: relative;\n}\n.grading-control-item .badge {\n    position: absolute;\n    top: 0;\n    right: -5px;\n    background: #3097d1;\n}\n.btn.mdi-flash {\n    color: #000;\n}\n.btn.mdi-flash:hover {\n    color: #FF9800;\n}\n", ""]);
// Exports
module.exports = exports;


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// Imports
var ___CSS_LOADER_API_IMPORT___ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
exports = ___CSS_LOADER_API_IMPORT___(false);
// Module
exports.push([module.i, "\n.flash-exercise[data-v-5266066c] {\n    margin-bottom: 15px;\n    height: 36px;\n    line-height: 36px;\n}\n.flash-exercise .name[data-v-5266066c] {\n    padding-left: 15px;\n}\ntextarea[data-v-5266066c] {\n    margin-bottom: 10px;\n}\n.message[data-v-5266066c] {\n    border-bottom: 1px dotted #ccc;\n}\n.message td[data-v-5266066c] {\n    padding: 10px;\n}\n", ""]);
// Exports
module.exports = exports;


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// Imports
var ___CSS_LOADER_API_IMPORT___ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
exports = ___CSS_LOADER_API_IMPORT___(false);
// Module
exports.push([module.i, "\n.missing-word-container span[data-v-673a7024] {\n    line-height: 24px;\n    height: 34px;\n    display: inline;\n    white-space: pre-line;\n}\n.missing-word-container input[data-v-673a7024] {\n    margin: 0 10px;\n    padding: 0 10px;\n}\n.missing-word-container .incorrect[data-v-673a7024] {\n    color: red;\n    font-weight: bold;\n    padding: 0 5px;\n}\n.missing-word-container .correct[data-v-673a7024] {\n    color: green;\n    font-weight: bold;\n    padding: 0 5px;\n}\n", ""]);
// Exports
module.exports = exports;


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// Imports
var ___CSS_LOADER_API_IMPORT___ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
exports = ___CSS_LOADER_API_IMPORT___(false);
// Module
exports.push([module.i, "\n.modal-body.text-center, .modal-footer.text-center {\n    text-align: center;\n}\n.star {\n    font-size: 80px;\n}\n", ""]);
// Exports
module.exports = exports;


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// Imports
var ___CSS_LOADER_API_IMPORT___ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
exports = ___CSS_LOADER_API_IMPORT___(false);
// Module
exports.push([module.i, "\n.missing-word-container .correct, .missing-word-container .incorrect {\n    color: #2ab27b;\n    font-weight: bold;\n    padding: 0 5px;\n}\n.missing-word-container .incorrect {\n    color: red;\n}\n", ""]);
// Exports
module.exports = exports;


/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/api.js":
/*!*****************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/api.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
// eslint-disable-next-line func-names
module.exports = function (useSourceMap) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = cssWithMappingToString(item, useSourceMap);

      if (item[2]) {
        return "@media ".concat(item[2], " {").concat(content, "}");
      }

      return content;
    }).join('');
  }; // import a list of modules into the list
  // eslint-disable-next-line func-names


  list.i = function (modules, mediaQuery, dedupe) {
    if (typeof modules === 'string') {
      // eslint-disable-next-line no-param-reassign
      modules = [[null, modules, '']];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var i = 0; i < this.length; i++) {
        // eslint-disable-next-line prefer-destructuring
        var id = this[i][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _i = 0; _i < modules.length; _i++) {
      var item = [].concat(modules[_i]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        // eslint-disable-next-line no-continue
        continue;
      }

      if (mediaQuery) {
        if (!item[2]) {
          item[2] = mediaQuery;
        } else {
          item[2] = "".concat(mediaQuery, " and ").concat(item[2]);
        }
      }

      list.push(item);
    }
  };

  return list;
};

function cssWithMappingToString(item, useSourceMap) {
  var content = item[1] || ''; // eslint-disable-next-line prefer-destructuring

  var cssMapping = item[3];

  if (!cssMapping) {
    return content;
  }

  if (useSourceMap && typeof btoa === 'function') {
    var sourceMapping = toComment(cssMapping);
    var sourceURLs = cssMapping.sources.map(function (source) {
      return "/*# sourceURL=".concat(cssMapping.sourceRoot || '').concat(source, " */");
    });
    return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
  }

  return [content].join('\n');
} // Adapted from convert-source-map (MIT)


function toComment(sourceMap) {
  // eslint-disable-next-line no-undef
  var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
  var data = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(base64);
  return "/*# ".concat(data, " */");
}

/***/ }),

/***/ "./node_modules/hammerjs/hammer.js":
/*!*****************************************!*\
  !*** ./node_modules/hammerjs/hammer.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_RESULT__;/*! Hammer.JS - v2.0.7 - 2016-04-22
 * http://hammerjs.github.io/
 *
 * Copyright (c) 2016 Jorik Tangelder;
 * Licensed under the MIT license */
(function(window, document, exportName, undefined) {
  'use strict';

var VENDOR_PREFIXES = ['', 'webkit', 'Moz', 'MS', 'ms', 'o'];
var TEST_ELEMENT = document.createElement('div');

var TYPE_FUNCTION = 'function';

var round = Math.round;
var abs = Math.abs;
var now = Date.now;

/**
 * set a timeout with a given scope
 * @param {Function} fn
 * @param {Number} timeout
 * @param {Object} context
 * @returns {number}
 */
function setTimeoutContext(fn, timeout, context) {
    return setTimeout(bindFn(fn, context), timeout);
}

/**
 * if the argument is an array, we want to execute the fn on each entry
 * if it aint an array we don't want to do a thing.
 * this is used by all the methods that accept a single and array argument.
 * @param {*|Array} arg
 * @param {String} fn
 * @param {Object} [context]
 * @returns {Boolean}
 */
function invokeArrayArg(arg, fn, context) {
    if (Array.isArray(arg)) {
        each(arg, context[fn], context);
        return true;
    }
    return false;
}

/**
 * walk objects and arrays
 * @param {Object} obj
 * @param {Function} iterator
 * @param {Object} context
 */
function each(obj, iterator, context) {
    var i;

    if (!obj) {
        return;
    }

    if (obj.forEach) {
        obj.forEach(iterator, context);
    } else if (obj.length !== undefined) {
        i = 0;
        while (i < obj.length) {
            iterator.call(context, obj[i], i, obj);
            i++;
        }
    } else {
        for (i in obj) {
            obj.hasOwnProperty(i) && iterator.call(context, obj[i], i, obj);
        }
    }
}

/**
 * wrap a method with a deprecation warning and stack trace
 * @param {Function} method
 * @param {String} name
 * @param {String} message
 * @returns {Function} A new function wrapping the supplied method.
 */
function deprecate(method, name, message) {
    var deprecationMessage = 'DEPRECATED METHOD: ' + name + '\n' + message + ' AT \n';
    return function() {
        var e = new Error('get-stack-trace');
        var stack = e && e.stack ? e.stack.replace(/^[^\(]+?[\n$]/gm, '')
            .replace(/^\s+at\s+/gm, '')
            .replace(/^Object.<anonymous>\s*\(/gm, '{anonymous}()@') : 'Unknown Stack Trace';

        var log = window.console && (window.console.warn || window.console.log);
        if (log) {
            log.call(window.console, deprecationMessage, stack);
        }
        return method.apply(this, arguments);
    };
}

/**
 * extend object.
 * means that properties in dest will be overwritten by the ones in src.
 * @param {Object} target
 * @param {...Object} objects_to_assign
 * @returns {Object} target
 */
var assign;
if (typeof Object.assign !== 'function') {
    assign = function assign(target) {
        if (target === undefined || target === null) {
            throw new TypeError('Cannot convert undefined or null to object');
        }

        var output = Object(target);
        for (var index = 1; index < arguments.length; index++) {
            var source = arguments[index];
            if (source !== undefined && source !== null) {
                for (var nextKey in source) {
                    if (source.hasOwnProperty(nextKey)) {
                        output[nextKey] = source[nextKey];
                    }
                }
            }
        }
        return output;
    };
} else {
    assign = Object.assign;
}

/**
 * extend object.
 * means that properties in dest will be overwritten by the ones in src.
 * @param {Object} dest
 * @param {Object} src
 * @param {Boolean} [merge=false]
 * @returns {Object} dest
 */
var extend = deprecate(function extend(dest, src, merge) {
    var keys = Object.keys(src);
    var i = 0;
    while (i < keys.length) {
        if (!merge || (merge && dest[keys[i]] === undefined)) {
            dest[keys[i]] = src[keys[i]];
        }
        i++;
    }
    return dest;
}, 'extend', 'Use `assign`.');

/**
 * merge the values from src in the dest.
 * means that properties that exist in dest will not be overwritten by src
 * @param {Object} dest
 * @param {Object} src
 * @returns {Object} dest
 */
var merge = deprecate(function merge(dest, src) {
    return extend(dest, src, true);
}, 'merge', 'Use `assign`.');

/**
 * simple class inheritance
 * @param {Function} child
 * @param {Function} base
 * @param {Object} [properties]
 */
function inherit(child, base, properties) {
    var baseP = base.prototype,
        childP;

    childP = child.prototype = Object.create(baseP);
    childP.constructor = child;
    childP._super = baseP;

    if (properties) {
        assign(childP, properties);
    }
}

/**
 * simple function bind
 * @param {Function} fn
 * @param {Object} context
 * @returns {Function}
 */
function bindFn(fn, context) {
    return function boundFn() {
        return fn.apply(context, arguments);
    };
}

/**
 * let a boolean value also be a function that must return a boolean
 * this first item in args will be used as the context
 * @param {Boolean|Function} val
 * @param {Array} [args]
 * @returns {Boolean}
 */
function boolOrFn(val, args) {
    if (typeof val == TYPE_FUNCTION) {
        return val.apply(args ? args[0] || undefined : undefined, args);
    }
    return val;
}

/**
 * use the val2 when val1 is undefined
 * @param {*} val1
 * @param {*} val2
 * @returns {*}
 */
function ifUndefined(val1, val2) {
    return (val1 === undefined) ? val2 : val1;
}

/**
 * addEventListener with multiple events at once
 * @param {EventTarget} target
 * @param {String} types
 * @param {Function} handler
 */
function addEventListeners(target, types, handler) {
    each(splitStr(types), function(type) {
        target.addEventListener(type, handler, false);
    });
}

/**
 * removeEventListener with multiple events at once
 * @param {EventTarget} target
 * @param {String} types
 * @param {Function} handler
 */
function removeEventListeners(target, types, handler) {
    each(splitStr(types), function(type) {
        target.removeEventListener(type, handler, false);
    });
}

/**
 * find if a node is in the given parent
 * @method hasParent
 * @param {HTMLElement} node
 * @param {HTMLElement} parent
 * @return {Boolean} found
 */
function hasParent(node, parent) {
    while (node) {
        if (node == parent) {
            return true;
        }
        node = node.parentNode;
    }
    return false;
}

/**
 * small indexOf wrapper
 * @param {String} str
 * @param {String} find
 * @returns {Boolean} found
 */
function inStr(str, find) {
    return str.indexOf(find) > -1;
}

/**
 * split string on whitespace
 * @param {String} str
 * @returns {Array} words
 */
function splitStr(str) {
    return str.trim().split(/\s+/g);
}

/**
 * find if a array contains the object using indexOf or a simple polyFill
 * @param {Array} src
 * @param {String} find
 * @param {String} [findByKey]
 * @return {Boolean|Number} false when not found, or the index
 */
function inArray(src, find, findByKey) {
    if (src.indexOf && !findByKey) {
        return src.indexOf(find);
    } else {
        var i = 0;
        while (i < src.length) {
            if ((findByKey && src[i][findByKey] == find) || (!findByKey && src[i] === find)) {
                return i;
            }
            i++;
        }
        return -1;
    }
}

/**
 * convert array-like objects to real arrays
 * @param {Object} obj
 * @returns {Array}
 */
function toArray(obj) {
    return Array.prototype.slice.call(obj, 0);
}

/**
 * unique array with objects based on a key (like 'id') or just by the array's value
 * @param {Array} src [{id:1},{id:2},{id:1}]
 * @param {String} [key]
 * @param {Boolean} [sort=False]
 * @returns {Array} [{id:1},{id:2}]
 */
function uniqueArray(src, key, sort) {
    var results = [];
    var values = [];
    var i = 0;

    while (i < src.length) {
        var val = key ? src[i][key] : src[i];
        if (inArray(values, val) < 0) {
            results.push(src[i]);
        }
        values[i] = val;
        i++;
    }

    if (sort) {
        if (!key) {
            results = results.sort();
        } else {
            results = results.sort(function sortUniqueArray(a, b) {
                return a[key] > b[key];
            });
        }
    }

    return results;
}

/**
 * get the prefixed property
 * @param {Object} obj
 * @param {String} property
 * @returns {String|Undefined} prefixed
 */
function prefixed(obj, property) {
    var prefix, prop;
    var camelProp = property[0].toUpperCase() + property.slice(1);

    var i = 0;
    while (i < VENDOR_PREFIXES.length) {
        prefix = VENDOR_PREFIXES[i];
        prop = (prefix) ? prefix + camelProp : property;

        if (prop in obj) {
            return prop;
        }
        i++;
    }
    return undefined;
}

/**
 * get a unique id
 * @returns {number} uniqueId
 */
var _uniqueId = 1;
function uniqueId() {
    return _uniqueId++;
}

/**
 * get the window object of an element
 * @param {HTMLElement} element
 * @returns {DocumentView|Window}
 */
function getWindowForElement(element) {
    var doc = element.ownerDocument || element;
    return (doc.defaultView || doc.parentWindow || window);
}

var MOBILE_REGEX = /mobile|tablet|ip(ad|hone|od)|android/i;

var SUPPORT_TOUCH = ('ontouchstart' in window);
var SUPPORT_POINTER_EVENTS = prefixed(window, 'PointerEvent') !== undefined;
var SUPPORT_ONLY_TOUCH = SUPPORT_TOUCH && MOBILE_REGEX.test(navigator.userAgent);

var INPUT_TYPE_TOUCH = 'touch';
var INPUT_TYPE_PEN = 'pen';
var INPUT_TYPE_MOUSE = 'mouse';
var INPUT_TYPE_KINECT = 'kinect';

var COMPUTE_INTERVAL = 25;

var INPUT_START = 1;
var INPUT_MOVE = 2;
var INPUT_END = 4;
var INPUT_CANCEL = 8;

var DIRECTION_NONE = 1;
var DIRECTION_LEFT = 2;
var DIRECTION_RIGHT = 4;
var DIRECTION_UP = 8;
var DIRECTION_DOWN = 16;

var DIRECTION_HORIZONTAL = DIRECTION_LEFT | DIRECTION_RIGHT;
var DIRECTION_VERTICAL = DIRECTION_UP | DIRECTION_DOWN;
var DIRECTION_ALL = DIRECTION_HORIZONTAL | DIRECTION_VERTICAL;

var PROPS_XY = ['x', 'y'];
var PROPS_CLIENT_XY = ['clientX', 'clientY'];

/**
 * create new input type manager
 * @param {Manager} manager
 * @param {Function} callback
 * @returns {Input}
 * @constructor
 */
function Input(manager, callback) {
    var self = this;
    this.manager = manager;
    this.callback = callback;
    this.element = manager.element;
    this.target = manager.options.inputTarget;

    // smaller wrapper around the handler, for the scope and the enabled state of the manager,
    // so when disabled the input events are completely bypassed.
    this.domHandler = function(ev) {
        if (boolOrFn(manager.options.enable, [manager])) {
            self.handler(ev);
        }
    };

    this.init();

}

Input.prototype = {
    /**
     * should handle the inputEvent data and trigger the callback
     * @virtual
     */
    handler: function() { },

    /**
     * bind the events
     */
    init: function() {
        this.evEl && addEventListeners(this.element, this.evEl, this.domHandler);
        this.evTarget && addEventListeners(this.target, this.evTarget, this.domHandler);
        this.evWin && addEventListeners(getWindowForElement(this.element), this.evWin, this.domHandler);
    },

    /**
     * unbind the events
     */
    destroy: function() {
        this.evEl && removeEventListeners(this.element, this.evEl, this.domHandler);
        this.evTarget && removeEventListeners(this.target, this.evTarget, this.domHandler);
        this.evWin && removeEventListeners(getWindowForElement(this.element), this.evWin, this.domHandler);
    }
};

/**
 * create new input type manager
 * called by the Manager constructor
 * @param {Hammer} manager
 * @returns {Input}
 */
function createInputInstance(manager) {
    var Type;
    var inputClass = manager.options.inputClass;

    if (inputClass) {
        Type = inputClass;
    } else if (SUPPORT_POINTER_EVENTS) {
        Type = PointerEventInput;
    } else if (SUPPORT_ONLY_TOUCH) {
        Type = TouchInput;
    } else if (!SUPPORT_TOUCH) {
        Type = MouseInput;
    } else {
        Type = TouchMouseInput;
    }
    return new (Type)(manager, inputHandler);
}

/**
 * handle input events
 * @param {Manager} manager
 * @param {String} eventType
 * @param {Object} input
 */
function inputHandler(manager, eventType, input) {
    var pointersLen = input.pointers.length;
    var changedPointersLen = input.changedPointers.length;
    var isFirst = (eventType & INPUT_START && (pointersLen - changedPointersLen === 0));
    var isFinal = (eventType & (INPUT_END | INPUT_CANCEL) && (pointersLen - changedPointersLen === 0));

    input.isFirst = !!isFirst;
    input.isFinal = !!isFinal;

    if (isFirst) {
        manager.session = {};
    }

    // source event is the normalized value of the domEvents
    // like 'touchstart, mouseup, pointerdown'
    input.eventType = eventType;

    // compute scale, rotation etc
    computeInputData(manager, input);

    // emit secret event
    manager.emit('hammer.input', input);

    manager.recognize(input);
    manager.session.prevInput = input;
}

/**
 * extend the data with some usable properties like scale, rotate, velocity etc
 * @param {Object} manager
 * @param {Object} input
 */
function computeInputData(manager, input) {
    var session = manager.session;
    var pointers = input.pointers;
    var pointersLength = pointers.length;

    // store the first input to calculate the distance and direction
    if (!session.firstInput) {
        session.firstInput = simpleCloneInputData(input);
    }

    // to compute scale and rotation we need to store the multiple touches
    if (pointersLength > 1 && !session.firstMultiple) {
        session.firstMultiple = simpleCloneInputData(input);
    } else if (pointersLength === 1) {
        session.firstMultiple = false;
    }

    var firstInput = session.firstInput;
    var firstMultiple = session.firstMultiple;
    var offsetCenter = firstMultiple ? firstMultiple.center : firstInput.center;

    var center = input.center = getCenter(pointers);
    input.timeStamp = now();
    input.deltaTime = input.timeStamp - firstInput.timeStamp;

    input.angle = getAngle(offsetCenter, center);
    input.distance = getDistance(offsetCenter, center);

    computeDeltaXY(session, input);
    input.offsetDirection = getDirection(input.deltaX, input.deltaY);

    var overallVelocity = getVelocity(input.deltaTime, input.deltaX, input.deltaY);
    input.overallVelocityX = overallVelocity.x;
    input.overallVelocityY = overallVelocity.y;
    input.overallVelocity = (abs(overallVelocity.x) > abs(overallVelocity.y)) ? overallVelocity.x : overallVelocity.y;

    input.scale = firstMultiple ? getScale(firstMultiple.pointers, pointers) : 1;
    input.rotation = firstMultiple ? getRotation(firstMultiple.pointers, pointers) : 0;

    input.maxPointers = !session.prevInput ? input.pointers.length : ((input.pointers.length >
        session.prevInput.maxPointers) ? input.pointers.length : session.prevInput.maxPointers);

    computeIntervalInputData(session, input);

    // find the correct target
    var target = manager.element;
    if (hasParent(input.srcEvent.target, target)) {
        target = input.srcEvent.target;
    }
    input.target = target;
}

function computeDeltaXY(session, input) {
    var center = input.center;
    var offset = session.offsetDelta || {};
    var prevDelta = session.prevDelta || {};
    var prevInput = session.prevInput || {};

    if (input.eventType === INPUT_START || prevInput.eventType === INPUT_END) {
        prevDelta = session.prevDelta = {
            x: prevInput.deltaX || 0,
            y: prevInput.deltaY || 0
        };

        offset = session.offsetDelta = {
            x: center.x,
            y: center.y
        };
    }

    input.deltaX = prevDelta.x + (center.x - offset.x);
    input.deltaY = prevDelta.y + (center.y - offset.y);
}

/**
 * velocity is calculated every x ms
 * @param {Object} session
 * @param {Object} input
 */
function computeIntervalInputData(session, input) {
    var last = session.lastInterval || input,
        deltaTime = input.timeStamp - last.timeStamp,
        velocity, velocityX, velocityY, direction;

    if (input.eventType != INPUT_CANCEL && (deltaTime > COMPUTE_INTERVAL || last.velocity === undefined)) {
        var deltaX = input.deltaX - last.deltaX;
        var deltaY = input.deltaY - last.deltaY;

        var v = getVelocity(deltaTime, deltaX, deltaY);
        velocityX = v.x;
        velocityY = v.y;
        velocity = (abs(v.x) > abs(v.y)) ? v.x : v.y;
        direction = getDirection(deltaX, deltaY);

        session.lastInterval = input;
    } else {
        // use latest velocity info if it doesn't overtake a minimum period
        velocity = last.velocity;
        velocityX = last.velocityX;
        velocityY = last.velocityY;
        direction = last.direction;
    }

    input.velocity = velocity;
    input.velocityX = velocityX;
    input.velocityY = velocityY;
    input.direction = direction;
}

/**
 * create a simple clone from the input used for storage of firstInput and firstMultiple
 * @param {Object} input
 * @returns {Object} clonedInputData
 */
function simpleCloneInputData(input) {
    // make a simple copy of the pointers because we will get a reference if we don't
    // we only need clientXY for the calculations
    var pointers = [];
    var i = 0;
    while (i < input.pointers.length) {
        pointers[i] = {
            clientX: round(input.pointers[i].clientX),
            clientY: round(input.pointers[i].clientY)
        };
        i++;
    }

    return {
        timeStamp: now(),
        pointers: pointers,
        center: getCenter(pointers),
        deltaX: input.deltaX,
        deltaY: input.deltaY
    };
}

/**
 * get the center of all the pointers
 * @param {Array} pointers
 * @return {Object} center contains `x` and `y` properties
 */
function getCenter(pointers) {
    var pointersLength = pointers.length;

    // no need to loop when only one touch
    if (pointersLength === 1) {
        return {
            x: round(pointers[0].clientX),
            y: round(pointers[0].clientY)
        };
    }

    var x = 0, y = 0, i = 0;
    while (i < pointersLength) {
        x += pointers[i].clientX;
        y += pointers[i].clientY;
        i++;
    }

    return {
        x: round(x / pointersLength),
        y: round(y / pointersLength)
    };
}

/**
 * calculate the velocity between two points. unit is in px per ms.
 * @param {Number} deltaTime
 * @param {Number} x
 * @param {Number} y
 * @return {Object} velocity `x` and `y`
 */
function getVelocity(deltaTime, x, y) {
    return {
        x: x / deltaTime || 0,
        y: y / deltaTime || 0
    };
}

/**
 * get the direction between two points
 * @param {Number} x
 * @param {Number} y
 * @return {Number} direction
 */
function getDirection(x, y) {
    if (x === y) {
        return DIRECTION_NONE;
    }

    if (abs(x) >= abs(y)) {
        return x < 0 ? DIRECTION_LEFT : DIRECTION_RIGHT;
    }
    return y < 0 ? DIRECTION_UP : DIRECTION_DOWN;
}

/**
 * calculate the absolute distance between two points
 * @param {Object} p1 {x, y}
 * @param {Object} p2 {x, y}
 * @param {Array} [props] containing x and y keys
 * @return {Number} distance
 */
function getDistance(p1, p2, props) {
    if (!props) {
        props = PROPS_XY;
    }
    var x = p2[props[0]] - p1[props[0]],
        y = p2[props[1]] - p1[props[1]];

    return Math.sqrt((x * x) + (y * y));
}

/**
 * calculate the angle between two coordinates
 * @param {Object} p1
 * @param {Object} p2
 * @param {Array} [props] containing x and y keys
 * @return {Number} angle
 */
function getAngle(p1, p2, props) {
    if (!props) {
        props = PROPS_XY;
    }
    var x = p2[props[0]] - p1[props[0]],
        y = p2[props[1]] - p1[props[1]];
    return Math.atan2(y, x) * 180 / Math.PI;
}

/**
 * calculate the rotation degrees between two pointersets
 * @param {Array} start array of pointers
 * @param {Array} end array of pointers
 * @return {Number} rotation
 */
function getRotation(start, end) {
    return getAngle(end[1], end[0], PROPS_CLIENT_XY) + getAngle(start[1], start[0], PROPS_CLIENT_XY);
}

/**
 * calculate the scale factor between two pointersets
 * no scale is 1, and goes down to 0 when pinched together, and bigger when pinched out
 * @param {Array} start array of pointers
 * @param {Array} end array of pointers
 * @return {Number} scale
 */
function getScale(start, end) {
    return getDistance(end[0], end[1], PROPS_CLIENT_XY) / getDistance(start[0], start[1], PROPS_CLIENT_XY);
}

var MOUSE_INPUT_MAP = {
    mousedown: INPUT_START,
    mousemove: INPUT_MOVE,
    mouseup: INPUT_END
};

var MOUSE_ELEMENT_EVENTS = 'mousedown';
var MOUSE_WINDOW_EVENTS = 'mousemove mouseup';

/**
 * Mouse events input
 * @constructor
 * @extends Input
 */
function MouseInput() {
    this.evEl = MOUSE_ELEMENT_EVENTS;
    this.evWin = MOUSE_WINDOW_EVENTS;

    this.pressed = false; // mousedown state

    Input.apply(this, arguments);
}

inherit(MouseInput, Input, {
    /**
     * handle mouse events
     * @param {Object} ev
     */
    handler: function MEhandler(ev) {
        var eventType = MOUSE_INPUT_MAP[ev.type];

        // on start we want to have the left mouse button down
        if (eventType & INPUT_START && ev.button === 0) {
            this.pressed = true;
        }

        if (eventType & INPUT_MOVE && ev.which !== 1) {
            eventType = INPUT_END;
        }

        // mouse must be down
        if (!this.pressed) {
            return;
        }

        if (eventType & INPUT_END) {
            this.pressed = false;
        }

        this.callback(this.manager, eventType, {
            pointers: [ev],
            changedPointers: [ev],
            pointerType: INPUT_TYPE_MOUSE,
            srcEvent: ev
        });
    }
});

var POINTER_INPUT_MAP = {
    pointerdown: INPUT_START,
    pointermove: INPUT_MOVE,
    pointerup: INPUT_END,
    pointercancel: INPUT_CANCEL,
    pointerout: INPUT_CANCEL
};

// in IE10 the pointer types is defined as an enum
var IE10_POINTER_TYPE_ENUM = {
    2: INPUT_TYPE_TOUCH,
    3: INPUT_TYPE_PEN,
    4: INPUT_TYPE_MOUSE,
    5: INPUT_TYPE_KINECT // see https://twitter.com/jacobrossi/status/480596438489890816
};

var POINTER_ELEMENT_EVENTS = 'pointerdown';
var POINTER_WINDOW_EVENTS = 'pointermove pointerup pointercancel';

// IE10 has prefixed support, and case-sensitive
if (window.MSPointerEvent && !window.PointerEvent) {
    POINTER_ELEMENT_EVENTS = 'MSPointerDown';
    POINTER_WINDOW_EVENTS = 'MSPointerMove MSPointerUp MSPointerCancel';
}

/**
 * Pointer events input
 * @constructor
 * @extends Input
 */
function PointerEventInput() {
    this.evEl = POINTER_ELEMENT_EVENTS;
    this.evWin = POINTER_WINDOW_EVENTS;

    Input.apply(this, arguments);

    this.store = (this.manager.session.pointerEvents = []);
}

inherit(PointerEventInput, Input, {
    /**
     * handle mouse events
     * @param {Object} ev
     */
    handler: function PEhandler(ev) {
        var store = this.store;
        var removePointer = false;

        var eventTypeNormalized = ev.type.toLowerCase().replace('ms', '');
        var eventType = POINTER_INPUT_MAP[eventTypeNormalized];
        var pointerType = IE10_POINTER_TYPE_ENUM[ev.pointerType] || ev.pointerType;

        var isTouch = (pointerType == INPUT_TYPE_TOUCH);

        // get index of the event in the store
        var storeIndex = inArray(store, ev.pointerId, 'pointerId');

        // start and mouse must be down
        if (eventType & INPUT_START && (ev.button === 0 || isTouch)) {
            if (storeIndex < 0) {
                store.push(ev);
                storeIndex = store.length - 1;
            }
        } else if (eventType & (INPUT_END | INPUT_CANCEL)) {
            removePointer = true;
        }

        // it not found, so the pointer hasn't been down (so it's probably a hover)
        if (storeIndex < 0) {
            return;
        }

        // update the event in the store
        store[storeIndex] = ev;

        this.callback(this.manager, eventType, {
            pointers: store,
            changedPointers: [ev],
            pointerType: pointerType,
            srcEvent: ev
        });

        if (removePointer) {
            // remove from the store
            store.splice(storeIndex, 1);
        }
    }
});

var SINGLE_TOUCH_INPUT_MAP = {
    touchstart: INPUT_START,
    touchmove: INPUT_MOVE,
    touchend: INPUT_END,
    touchcancel: INPUT_CANCEL
};

var SINGLE_TOUCH_TARGET_EVENTS = 'touchstart';
var SINGLE_TOUCH_WINDOW_EVENTS = 'touchstart touchmove touchend touchcancel';

/**
 * Touch events input
 * @constructor
 * @extends Input
 */
function SingleTouchInput() {
    this.evTarget = SINGLE_TOUCH_TARGET_EVENTS;
    this.evWin = SINGLE_TOUCH_WINDOW_EVENTS;
    this.started = false;

    Input.apply(this, arguments);
}

inherit(SingleTouchInput, Input, {
    handler: function TEhandler(ev) {
        var type = SINGLE_TOUCH_INPUT_MAP[ev.type];

        // should we handle the touch events?
        if (type === INPUT_START) {
            this.started = true;
        }

        if (!this.started) {
            return;
        }

        var touches = normalizeSingleTouches.call(this, ev, type);

        // when done, reset the started state
        if (type & (INPUT_END | INPUT_CANCEL) && touches[0].length - touches[1].length === 0) {
            this.started = false;
        }

        this.callback(this.manager, type, {
            pointers: touches[0],
            changedPointers: touches[1],
            pointerType: INPUT_TYPE_TOUCH,
            srcEvent: ev
        });
    }
});

/**
 * @this {TouchInput}
 * @param {Object} ev
 * @param {Number} type flag
 * @returns {undefined|Array} [all, changed]
 */
function normalizeSingleTouches(ev, type) {
    var all = toArray(ev.touches);
    var changed = toArray(ev.changedTouches);

    if (type & (INPUT_END | INPUT_CANCEL)) {
        all = uniqueArray(all.concat(changed), 'identifier', true);
    }

    return [all, changed];
}

var TOUCH_INPUT_MAP = {
    touchstart: INPUT_START,
    touchmove: INPUT_MOVE,
    touchend: INPUT_END,
    touchcancel: INPUT_CANCEL
};

var TOUCH_TARGET_EVENTS = 'touchstart touchmove touchend touchcancel';

/**
 * Multi-user touch events input
 * @constructor
 * @extends Input
 */
function TouchInput() {
    this.evTarget = TOUCH_TARGET_EVENTS;
    this.targetIds = {};

    Input.apply(this, arguments);
}

inherit(TouchInput, Input, {
    handler: function MTEhandler(ev) {
        var type = TOUCH_INPUT_MAP[ev.type];
        var touches = getTouches.call(this, ev, type);
        if (!touches) {
            return;
        }

        this.callback(this.manager, type, {
            pointers: touches[0],
            changedPointers: touches[1],
            pointerType: INPUT_TYPE_TOUCH,
            srcEvent: ev
        });
    }
});

/**
 * @this {TouchInput}
 * @param {Object} ev
 * @param {Number} type flag
 * @returns {undefined|Array} [all, changed]
 */
function getTouches(ev, type) {
    var allTouches = toArray(ev.touches);
    var targetIds = this.targetIds;

    // when there is only one touch, the process can be simplified
    if (type & (INPUT_START | INPUT_MOVE) && allTouches.length === 1) {
        targetIds[allTouches[0].identifier] = true;
        return [allTouches, allTouches];
    }

    var i,
        targetTouches,
        changedTouches = toArray(ev.changedTouches),
        changedTargetTouches = [],
        target = this.target;

    // get target touches from touches
    targetTouches = allTouches.filter(function(touch) {
        return hasParent(touch.target, target);
    });

    // collect touches
    if (type === INPUT_START) {
        i = 0;
        while (i < targetTouches.length) {
            targetIds[targetTouches[i].identifier] = true;
            i++;
        }
    }

    // filter changed touches to only contain touches that exist in the collected target ids
    i = 0;
    while (i < changedTouches.length) {
        if (targetIds[changedTouches[i].identifier]) {
            changedTargetTouches.push(changedTouches[i]);
        }

        // cleanup removed touches
        if (type & (INPUT_END | INPUT_CANCEL)) {
            delete targetIds[changedTouches[i].identifier];
        }
        i++;
    }

    if (!changedTargetTouches.length) {
        return;
    }

    return [
        // merge targetTouches with changedTargetTouches so it contains ALL touches, including 'end' and 'cancel'
        uniqueArray(targetTouches.concat(changedTargetTouches), 'identifier', true),
        changedTargetTouches
    ];
}

/**
 * Combined touch and mouse input
 *
 * Touch has a higher priority then mouse, and while touching no mouse events are allowed.
 * This because touch devices also emit mouse events while doing a touch.
 *
 * @constructor
 * @extends Input
 */

var DEDUP_TIMEOUT = 2500;
var DEDUP_DISTANCE = 25;

function TouchMouseInput() {
    Input.apply(this, arguments);

    var handler = bindFn(this.handler, this);
    this.touch = new TouchInput(this.manager, handler);
    this.mouse = new MouseInput(this.manager, handler);

    this.primaryTouch = null;
    this.lastTouches = [];
}

inherit(TouchMouseInput, Input, {
    /**
     * handle mouse and touch events
     * @param {Hammer} manager
     * @param {String} inputEvent
     * @param {Object} inputData
     */
    handler: function TMEhandler(manager, inputEvent, inputData) {
        var isTouch = (inputData.pointerType == INPUT_TYPE_TOUCH),
            isMouse = (inputData.pointerType == INPUT_TYPE_MOUSE);

        if (isMouse && inputData.sourceCapabilities && inputData.sourceCapabilities.firesTouchEvents) {
            return;
        }

        // when we're in a touch event, record touches to  de-dupe synthetic mouse event
        if (isTouch) {
            recordTouches.call(this, inputEvent, inputData);
        } else if (isMouse && isSyntheticEvent.call(this, inputData)) {
            return;
        }

        this.callback(manager, inputEvent, inputData);
    },

    /**
     * remove the event listeners
     */
    destroy: function destroy() {
        this.touch.destroy();
        this.mouse.destroy();
    }
});

function recordTouches(eventType, eventData) {
    if (eventType & INPUT_START) {
        this.primaryTouch = eventData.changedPointers[0].identifier;
        setLastTouch.call(this, eventData);
    } else if (eventType & (INPUT_END | INPUT_CANCEL)) {
        setLastTouch.call(this, eventData);
    }
}

function setLastTouch(eventData) {
    var touch = eventData.changedPointers[0];

    if (touch.identifier === this.primaryTouch) {
        var lastTouch = {x: touch.clientX, y: touch.clientY};
        this.lastTouches.push(lastTouch);
        var lts = this.lastTouches;
        var removeLastTouch = function() {
            var i = lts.indexOf(lastTouch);
            if (i > -1) {
                lts.splice(i, 1);
            }
        };
        setTimeout(removeLastTouch, DEDUP_TIMEOUT);
    }
}

function isSyntheticEvent(eventData) {
    var x = eventData.srcEvent.clientX, y = eventData.srcEvent.clientY;
    for (var i = 0; i < this.lastTouches.length; i++) {
        var t = this.lastTouches[i];
        var dx = Math.abs(x - t.x), dy = Math.abs(y - t.y);
        if (dx <= DEDUP_DISTANCE && dy <= DEDUP_DISTANCE) {
            return true;
        }
    }
    return false;
}

var PREFIXED_TOUCH_ACTION = prefixed(TEST_ELEMENT.style, 'touchAction');
var NATIVE_TOUCH_ACTION = PREFIXED_TOUCH_ACTION !== undefined;

// magical touchAction value
var TOUCH_ACTION_COMPUTE = 'compute';
var TOUCH_ACTION_AUTO = 'auto';
var TOUCH_ACTION_MANIPULATION = 'manipulation'; // not implemented
var TOUCH_ACTION_NONE = 'none';
var TOUCH_ACTION_PAN_X = 'pan-x';
var TOUCH_ACTION_PAN_Y = 'pan-y';
var TOUCH_ACTION_MAP = getTouchActionProps();

/**
 * Touch Action
 * sets the touchAction property or uses the js alternative
 * @param {Manager} manager
 * @param {String} value
 * @constructor
 */
function TouchAction(manager, value) {
    this.manager = manager;
    this.set(value);
}

TouchAction.prototype = {
    /**
     * set the touchAction value on the element or enable the polyfill
     * @param {String} value
     */
    set: function(value) {
        // find out the touch-action by the event handlers
        if (value == TOUCH_ACTION_COMPUTE) {
            value = this.compute();
        }

        if (NATIVE_TOUCH_ACTION && this.manager.element.style && TOUCH_ACTION_MAP[value]) {
            this.manager.element.style[PREFIXED_TOUCH_ACTION] = value;
        }
        this.actions = value.toLowerCase().trim();
    },

    /**
     * just re-set the touchAction value
     */
    update: function() {
        this.set(this.manager.options.touchAction);
    },

    /**
     * compute the value for the touchAction property based on the recognizer's settings
     * @returns {String} value
     */
    compute: function() {
        var actions = [];
        each(this.manager.recognizers, function(recognizer) {
            if (boolOrFn(recognizer.options.enable, [recognizer])) {
                actions = actions.concat(recognizer.getTouchAction());
            }
        });
        return cleanTouchActions(actions.join(' '));
    },

    /**
     * this method is called on each input cycle and provides the preventing of the browser behavior
     * @param {Object} input
     */
    preventDefaults: function(input) {
        var srcEvent = input.srcEvent;
        var direction = input.offsetDirection;

        // if the touch action did prevented once this session
        if (this.manager.session.prevented) {
            srcEvent.preventDefault();
            return;
        }

        var actions = this.actions;
        var hasNone = inStr(actions, TOUCH_ACTION_NONE) && !TOUCH_ACTION_MAP[TOUCH_ACTION_NONE];
        var hasPanY = inStr(actions, TOUCH_ACTION_PAN_Y) && !TOUCH_ACTION_MAP[TOUCH_ACTION_PAN_Y];
        var hasPanX = inStr(actions, TOUCH_ACTION_PAN_X) && !TOUCH_ACTION_MAP[TOUCH_ACTION_PAN_X];

        if (hasNone) {
            //do not prevent defaults if this is a tap gesture

            var isTapPointer = input.pointers.length === 1;
            var isTapMovement = input.distance < 2;
            var isTapTouchTime = input.deltaTime < 250;

            if (isTapPointer && isTapMovement && isTapTouchTime) {
                return;
            }
        }

        if (hasPanX && hasPanY) {
            // `pan-x pan-y` means browser handles all scrolling/panning, do not prevent
            return;
        }

        if (hasNone ||
            (hasPanY && direction & DIRECTION_HORIZONTAL) ||
            (hasPanX && direction & DIRECTION_VERTICAL)) {
            return this.preventSrc(srcEvent);
        }
    },

    /**
     * call preventDefault to prevent the browser's default behavior (scrolling in most cases)
     * @param {Object} srcEvent
     */
    preventSrc: function(srcEvent) {
        this.manager.session.prevented = true;
        srcEvent.preventDefault();
    }
};

/**
 * when the touchActions are collected they are not a valid value, so we need to clean things up. *
 * @param {String} actions
 * @returns {*}
 */
function cleanTouchActions(actions) {
    // none
    if (inStr(actions, TOUCH_ACTION_NONE)) {
        return TOUCH_ACTION_NONE;
    }

    var hasPanX = inStr(actions, TOUCH_ACTION_PAN_X);
    var hasPanY = inStr(actions, TOUCH_ACTION_PAN_Y);

    // if both pan-x and pan-y are set (different recognizers
    // for different directions, e.g. horizontal pan but vertical swipe?)
    // we need none (as otherwise with pan-x pan-y combined none of these
    // recognizers will work, since the browser would handle all panning
    if (hasPanX && hasPanY) {
        return TOUCH_ACTION_NONE;
    }

    // pan-x OR pan-y
    if (hasPanX || hasPanY) {
        return hasPanX ? TOUCH_ACTION_PAN_X : TOUCH_ACTION_PAN_Y;
    }

    // manipulation
    if (inStr(actions, TOUCH_ACTION_MANIPULATION)) {
        return TOUCH_ACTION_MANIPULATION;
    }

    return TOUCH_ACTION_AUTO;
}

function getTouchActionProps() {
    if (!NATIVE_TOUCH_ACTION) {
        return false;
    }
    var touchMap = {};
    var cssSupports = window.CSS && window.CSS.supports;
    ['auto', 'manipulation', 'pan-y', 'pan-x', 'pan-x pan-y', 'none'].forEach(function(val) {

        // If css.supports is not supported but there is native touch-action assume it supports
        // all values. This is the case for IE 10 and 11.
        touchMap[val] = cssSupports ? window.CSS.supports('touch-action', val) : true;
    });
    return touchMap;
}

/**
 * Recognizer flow explained; *
 * All recognizers have the initial state of POSSIBLE when a input session starts.
 * The definition of a input session is from the first input until the last input, with all it's movement in it. *
 * Example session for mouse-input: mousedown -> mousemove -> mouseup
 *
 * On each recognizing cycle (see Manager.recognize) the .recognize() method is executed
 * which determines with state it should be.
 *
 * If the recognizer has the state FAILED, CANCELLED or RECOGNIZED (equals ENDED), it is reset to
 * POSSIBLE to give it another change on the next cycle.
 *
 *               Possible
 *                  |
 *            +-----+---------------+
 *            |                     |
 *      +-----+-----+               |
 *      |           |               |
 *   Failed      Cancelled          |
 *                          +-------+------+
 *                          |              |
 *                      Recognized       Began
 *                                         |
 *                                      Changed
 *                                         |
 *                                  Ended/Recognized
 */
var STATE_POSSIBLE = 1;
var STATE_BEGAN = 2;
var STATE_CHANGED = 4;
var STATE_ENDED = 8;
var STATE_RECOGNIZED = STATE_ENDED;
var STATE_CANCELLED = 16;
var STATE_FAILED = 32;

/**
 * Recognizer
 * Every recognizer needs to extend from this class.
 * @constructor
 * @param {Object} options
 */
function Recognizer(options) {
    this.options = assign({}, this.defaults, options || {});

    this.id = uniqueId();

    this.manager = null;

    // default is enable true
    this.options.enable = ifUndefined(this.options.enable, true);

    this.state = STATE_POSSIBLE;

    this.simultaneous = {};
    this.requireFail = [];
}

Recognizer.prototype = {
    /**
     * @virtual
     * @type {Object}
     */
    defaults: {},

    /**
     * set options
     * @param {Object} options
     * @return {Recognizer}
     */
    set: function(options) {
        assign(this.options, options);

        // also update the touchAction, in case something changed about the directions/enabled state
        this.manager && this.manager.touchAction.update();
        return this;
    },

    /**
     * recognize simultaneous with an other recognizer.
     * @param {Recognizer} otherRecognizer
     * @returns {Recognizer} this
     */
    recognizeWith: function(otherRecognizer) {
        if (invokeArrayArg(otherRecognizer, 'recognizeWith', this)) {
            return this;
        }

        var simultaneous = this.simultaneous;
        otherRecognizer = getRecognizerByNameIfManager(otherRecognizer, this);
        if (!simultaneous[otherRecognizer.id]) {
            simultaneous[otherRecognizer.id] = otherRecognizer;
            otherRecognizer.recognizeWith(this);
        }
        return this;
    },

    /**
     * drop the simultaneous link. it doesnt remove the link on the other recognizer.
     * @param {Recognizer} otherRecognizer
     * @returns {Recognizer} this
     */
    dropRecognizeWith: function(otherRecognizer) {
        if (invokeArrayArg(otherRecognizer, 'dropRecognizeWith', this)) {
            return this;
        }

        otherRecognizer = getRecognizerByNameIfManager(otherRecognizer, this);
        delete this.simultaneous[otherRecognizer.id];
        return this;
    },

    /**
     * recognizer can only run when an other is failing
     * @param {Recognizer} otherRecognizer
     * @returns {Recognizer} this
     */
    requireFailure: function(otherRecognizer) {
        if (invokeArrayArg(otherRecognizer, 'requireFailure', this)) {
            return this;
        }

        var requireFail = this.requireFail;
        otherRecognizer = getRecognizerByNameIfManager(otherRecognizer, this);
        if (inArray(requireFail, otherRecognizer) === -1) {
            requireFail.push(otherRecognizer);
            otherRecognizer.requireFailure(this);
        }
        return this;
    },

    /**
     * drop the requireFailure link. it does not remove the link on the other recognizer.
     * @param {Recognizer} otherRecognizer
     * @returns {Recognizer} this
     */
    dropRequireFailure: function(otherRecognizer) {
        if (invokeArrayArg(otherRecognizer, 'dropRequireFailure', this)) {
            return this;
        }

        otherRecognizer = getRecognizerByNameIfManager(otherRecognizer, this);
        var index = inArray(this.requireFail, otherRecognizer);
        if (index > -1) {
            this.requireFail.splice(index, 1);
        }
        return this;
    },

    /**
     * has require failures boolean
     * @returns {boolean}
     */
    hasRequireFailures: function() {
        return this.requireFail.length > 0;
    },

    /**
     * if the recognizer can recognize simultaneous with an other recognizer
     * @param {Recognizer} otherRecognizer
     * @returns {Boolean}
     */
    canRecognizeWith: function(otherRecognizer) {
        return !!this.simultaneous[otherRecognizer.id];
    },

    /**
     * You should use `tryEmit` instead of `emit` directly to check
     * that all the needed recognizers has failed before emitting.
     * @param {Object} input
     */
    emit: function(input) {
        var self = this;
        var state = this.state;

        function emit(event) {
            self.manager.emit(event, input);
        }

        // 'panstart' and 'panmove'
        if (state < STATE_ENDED) {
            emit(self.options.event + stateStr(state));
        }

        emit(self.options.event); // simple 'eventName' events

        if (input.additionalEvent) { // additional event(panleft, panright, pinchin, pinchout...)
            emit(input.additionalEvent);
        }

        // panend and pancancel
        if (state >= STATE_ENDED) {
            emit(self.options.event + stateStr(state));
        }
    },

    /**
     * Check that all the require failure recognizers has failed,
     * if true, it emits a gesture event,
     * otherwise, setup the state to FAILED.
     * @param {Object} input
     */
    tryEmit: function(input) {
        if (this.canEmit()) {
            return this.emit(input);
        }
        // it's failing anyway
        this.state = STATE_FAILED;
    },

    /**
     * can we emit?
     * @returns {boolean}
     */
    canEmit: function() {
        var i = 0;
        while (i < this.requireFail.length) {
            if (!(this.requireFail[i].state & (STATE_FAILED | STATE_POSSIBLE))) {
                return false;
            }
            i++;
        }
        return true;
    },

    /**
     * update the recognizer
     * @param {Object} inputData
     */
    recognize: function(inputData) {
        // make a new copy of the inputData
        // so we can change the inputData without messing up the other recognizers
        var inputDataClone = assign({}, inputData);

        // is is enabled and allow recognizing?
        if (!boolOrFn(this.options.enable, [this, inputDataClone])) {
            this.reset();
            this.state = STATE_FAILED;
            return;
        }

        // reset when we've reached the end
        if (this.state & (STATE_RECOGNIZED | STATE_CANCELLED | STATE_FAILED)) {
            this.state = STATE_POSSIBLE;
        }

        this.state = this.process(inputDataClone);

        // the recognizer has recognized a gesture
        // so trigger an event
        if (this.state & (STATE_BEGAN | STATE_CHANGED | STATE_ENDED | STATE_CANCELLED)) {
            this.tryEmit(inputDataClone);
        }
    },

    /**
     * return the state of the recognizer
     * the actual recognizing happens in this method
     * @virtual
     * @param {Object} inputData
     * @returns {Const} STATE
     */
    process: function(inputData) { }, // jshint ignore:line

    /**
     * return the preferred touch-action
     * @virtual
     * @returns {Array}
     */
    getTouchAction: function() { },

    /**
     * called when the gesture isn't allowed to recognize
     * like when another is being recognized or it is disabled
     * @virtual
     */
    reset: function() { }
};

/**
 * get a usable string, used as event postfix
 * @param {Const} state
 * @returns {String} state
 */
function stateStr(state) {
    if (state & STATE_CANCELLED) {
        return 'cancel';
    } else if (state & STATE_ENDED) {
        return 'end';
    } else if (state & STATE_CHANGED) {
        return 'move';
    } else if (state & STATE_BEGAN) {
        return 'start';
    }
    return '';
}

/**
 * direction cons to string
 * @param {Const} direction
 * @returns {String}
 */
function directionStr(direction) {
    if (direction == DIRECTION_DOWN) {
        return 'down';
    } else if (direction == DIRECTION_UP) {
        return 'up';
    } else if (direction == DIRECTION_LEFT) {
        return 'left';
    } else if (direction == DIRECTION_RIGHT) {
        return 'right';
    }
    return '';
}

/**
 * get a recognizer by name if it is bound to a manager
 * @param {Recognizer|String} otherRecognizer
 * @param {Recognizer} recognizer
 * @returns {Recognizer}
 */
function getRecognizerByNameIfManager(otherRecognizer, recognizer) {
    var manager = recognizer.manager;
    if (manager) {
        return manager.get(otherRecognizer);
    }
    return otherRecognizer;
}

/**
 * This recognizer is just used as a base for the simple attribute recognizers.
 * @constructor
 * @extends Recognizer
 */
function AttrRecognizer() {
    Recognizer.apply(this, arguments);
}

inherit(AttrRecognizer, Recognizer, {
    /**
     * @namespace
     * @memberof AttrRecognizer
     */
    defaults: {
        /**
         * @type {Number}
         * @default 1
         */
        pointers: 1
    },

    /**
     * Used to check if it the recognizer receives valid input, like input.distance > 10.
     * @memberof AttrRecognizer
     * @param {Object} input
     * @returns {Boolean} recognized
     */
    attrTest: function(input) {
        var optionPointers = this.options.pointers;
        return optionPointers === 0 || input.pointers.length === optionPointers;
    },

    /**
     * Process the input and return the state for the recognizer
     * @memberof AttrRecognizer
     * @param {Object} input
     * @returns {*} State
     */
    process: function(input) {
        var state = this.state;
        var eventType = input.eventType;

        var isRecognized = state & (STATE_BEGAN | STATE_CHANGED);
        var isValid = this.attrTest(input);

        // on cancel input and we've recognized before, return STATE_CANCELLED
        if (isRecognized && (eventType & INPUT_CANCEL || !isValid)) {
            return state | STATE_CANCELLED;
        } else if (isRecognized || isValid) {
            if (eventType & INPUT_END) {
                return state | STATE_ENDED;
            } else if (!(state & STATE_BEGAN)) {
                return STATE_BEGAN;
            }
            return state | STATE_CHANGED;
        }
        return STATE_FAILED;
    }
});

/**
 * Pan
 * Recognized when the pointer is down and moved in the allowed direction.
 * @constructor
 * @extends AttrRecognizer
 */
function PanRecognizer() {
    AttrRecognizer.apply(this, arguments);

    this.pX = null;
    this.pY = null;
}

inherit(PanRecognizer, AttrRecognizer, {
    /**
     * @namespace
     * @memberof PanRecognizer
     */
    defaults: {
        event: 'pan',
        threshold: 10,
        pointers: 1,
        direction: DIRECTION_ALL
    },

    getTouchAction: function() {
        var direction = this.options.direction;
        var actions = [];
        if (direction & DIRECTION_HORIZONTAL) {
            actions.push(TOUCH_ACTION_PAN_Y);
        }
        if (direction & DIRECTION_VERTICAL) {
            actions.push(TOUCH_ACTION_PAN_X);
        }
        return actions;
    },

    directionTest: function(input) {
        var options = this.options;
        var hasMoved = true;
        var distance = input.distance;
        var direction = input.direction;
        var x = input.deltaX;
        var y = input.deltaY;

        // lock to axis?
        if (!(direction & options.direction)) {
            if (options.direction & DIRECTION_HORIZONTAL) {
                direction = (x === 0) ? DIRECTION_NONE : (x < 0) ? DIRECTION_LEFT : DIRECTION_RIGHT;
                hasMoved = x != this.pX;
                distance = Math.abs(input.deltaX);
            } else {
                direction = (y === 0) ? DIRECTION_NONE : (y < 0) ? DIRECTION_UP : DIRECTION_DOWN;
                hasMoved = y != this.pY;
                distance = Math.abs(input.deltaY);
            }
        }
        input.direction = direction;
        return hasMoved && distance > options.threshold && direction & options.direction;
    },

    attrTest: function(input) {
        return AttrRecognizer.prototype.attrTest.call(this, input) &&
            (this.state & STATE_BEGAN || (!(this.state & STATE_BEGAN) && this.directionTest(input)));
    },

    emit: function(input) {

        this.pX = input.deltaX;
        this.pY = input.deltaY;

        var direction = directionStr(input.direction);

        if (direction) {
            input.additionalEvent = this.options.event + direction;
        }
        this._super.emit.call(this, input);
    }
});

/**
 * Pinch
 * Recognized when two or more pointers are moving toward (zoom-in) or away from each other (zoom-out).
 * @constructor
 * @extends AttrRecognizer
 */
function PinchRecognizer() {
    AttrRecognizer.apply(this, arguments);
}

inherit(PinchRecognizer, AttrRecognizer, {
    /**
     * @namespace
     * @memberof PinchRecognizer
     */
    defaults: {
        event: 'pinch',
        threshold: 0,
        pointers: 2
    },

    getTouchAction: function() {
        return [TOUCH_ACTION_NONE];
    },

    attrTest: function(input) {
        return this._super.attrTest.call(this, input) &&
            (Math.abs(input.scale - 1) > this.options.threshold || this.state & STATE_BEGAN);
    },

    emit: function(input) {
        if (input.scale !== 1) {
            var inOut = input.scale < 1 ? 'in' : 'out';
            input.additionalEvent = this.options.event + inOut;
        }
        this._super.emit.call(this, input);
    }
});

/**
 * Press
 * Recognized when the pointer is down for x ms without any movement.
 * @constructor
 * @extends Recognizer
 */
function PressRecognizer() {
    Recognizer.apply(this, arguments);

    this._timer = null;
    this._input = null;
}

inherit(PressRecognizer, Recognizer, {
    /**
     * @namespace
     * @memberof PressRecognizer
     */
    defaults: {
        event: 'press',
        pointers: 1,
        time: 251, // minimal time of the pointer to be pressed
        threshold: 9 // a minimal movement is ok, but keep it low
    },

    getTouchAction: function() {
        return [TOUCH_ACTION_AUTO];
    },

    process: function(input) {
        var options = this.options;
        var validPointers = input.pointers.length === options.pointers;
        var validMovement = input.distance < options.threshold;
        var validTime = input.deltaTime > options.time;

        this._input = input;

        // we only allow little movement
        // and we've reached an end event, so a tap is possible
        if (!validMovement || !validPointers || (input.eventType & (INPUT_END | INPUT_CANCEL) && !validTime)) {
            this.reset();
        } else if (input.eventType & INPUT_START) {
            this.reset();
            this._timer = setTimeoutContext(function() {
                this.state = STATE_RECOGNIZED;
                this.tryEmit();
            }, options.time, this);
        } else if (input.eventType & INPUT_END) {
            return STATE_RECOGNIZED;
        }
        return STATE_FAILED;
    },

    reset: function() {
        clearTimeout(this._timer);
    },

    emit: function(input) {
        if (this.state !== STATE_RECOGNIZED) {
            return;
        }

        if (input && (input.eventType & INPUT_END)) {
            this.manager.emit(this.options.event + 'up', input);
        } else {
            this._input.timeStamp = now();
            this.manager.emit(this.options.event, this._input);
        }
    }
});

/**
 * Rotate
 * Recognized when two or more pointer are moving in a circular motion.
 * @constructor
 * @extends AttrRecognizer
 */
function RotateRecognizer() {
    AttrRecognizer.apply(this, arguments);
}

inherit(RotateRecognizer, AttrRecognizer, {
    /**
     * @namespace
     * @memberof RotateRecognizer
     */
    defaults: {
        event: 'rotate',
        threshold: 0,
        pointers: 2
    },

    getTouchAction: function() {
        return [TOUCH_ACTION_NONE];
    },

    attrTest: function(input) {
        return this._super.attrTest.call(this, input) &&
            (Math.abs(input.rotation) > this.options.threshold || this.state & STATE_BEGAN);
    }
});

/**
 * Swipe
 * Recognized when the pointer is moving fast (velocity), with enough distance in the allowed direction.
 * @constructor
 * @extends AttrRecognizer
 */
function SwipeRecognizer() {
    AttrRecognizer.apply(this, arguments);
}

inherit(SwipeRecognizer, AttrRecognizer, {
    /**
     * @namespace
     * @memberof SwipeRecognizer
     */
    defaults: {
        event: 'swipe',
        threshold: 10,
        velocity: 0.3,
        direction: DIRECTION_HORIZONTAL | DIRECTION_VERTICAL,
        pointers: 1
    },

    getTouchAction: function() {
        return PanRecognizer.prototype.getTouchAction.call(this);
    },

    attrTest: function(input) {
        var direction = this.options.direction;
        var velocity;

        if (direction & (DIRECTION_HORIZONTAL | DIRECTION_VERTICAL)) {
            velocity = input.overallVelocity;
        } else if (direction & DIRECTION_HORIZONTAL) {
            velocity = input.overallVelocityX;
        } else if (direction & DIRECTION_VERTICAL) {
            velocity = input.overallVelocityY;
        }

        return this._super.attrTest.call(this, input) &&
            direction & input.offsetDirection &&
            input.distance > this.options.threshold &&
            input.maxPointers == this.options.pointers &&
            abs(velocity) > this.options.velocity && input.eventType & INPUT_END;
    },

    emit: function(input) {
        var direction = directionStr(input.offsetDirection);
        if (direction) {
            this.manager.emit(this.options.event + direction, input);
        }

        this.manager.emit(this.options.event, input);
    }
});

/**
 * A tap is ecognized when the pointer is doing a small tap/click. Multiple taps are recognized if they occur
 * between the given interval and position. The delay option can be used to recognize multi-taps without firing
 * a single tap.
 *
 * The eventData from the emitted event contains the property `tapCount`, which contains the amount of
 * multi-taps being recognized.
 * @constructor
 * @extends Recognizer
 */
function TapRecognizer() {
    Recognizer.apply(this, arguments);

    // previous time and center,
    // used for tap counting
    this.pTime = false;
    this.pCenter = false;

    this._timer = null;
    this._input = null;
    this.count = 0;
}

inherit(TapRecognizer, Recognizer, {
    /**
     * @namespace
     * @memberof PinchRecognizer
     */
    defaults: {
        event: 'tap',
        pointers: 1,
        taps: 1,
        interval: 300, // max time between the multi-tap taps
        time: 250, // max time of the pointer to be down (like finger on the screen)
        threshold: 9, // a minimal movement is ok, but keep it low
        posThreshold: 10 // a multi-tap can be a bit off the initial position
    },

    getTouchAction: function() {
        return [TOUCH_ACTION_MANIPULATION];
    },

    process: function(input) {
        var options = this.options;

        var validPointers = input.pointers.length === options.pointers;
        var validMovement = input.distance < options.threshold;
        var validTouchTime = input.deltaTime < options.time;

        this.reset();

        if ((input.eventType & INPUT_START) && (this.count === 0)) {
            return this.failTimeout();
        }

        // we only allow little movement
        // and we've reached an end event, so a tap is possible
        if (validMovement && validTouchTime && validPointers) {
            if (input.eventType != INPUT_END) {
                return this.failTimeout();
            }

            var validInterval = this.pTime ? (input.timeStamp - this.pTime < options.interval) : true;
            var validMultiTap = !this.pCenter || getDistance(this.pCenter, input.center) < options.posThreshold;

            this.pTime = input.timeStamp;
            this.pCenter = input.center;

            if (!validMultiTap || !validInterval) {
                this.count = 1;
            } else {
                this.count += 1;
            }

            this._input = input;

            // if tap count matches we have recognized it,
            // else it has began recognizing...
            var tapCount = this.count % options.taps;
            if (tapCount === 0) {
                // no failing requirements, immediately trigger the tap event
                // or wait as long as the multitap interval to trigger
                if (!this.hasRequireFailures()) {
                    return STATE_RECOGNIZED;
                } else {
                    this._timer = setTimeoutContext(function() {
                        this.state = STATE_RECOGNIZED;
                        this.tryEmit();
                    }, options.interval, this);
                    return STATE_BEGAN;
                }
            }
        }
        return STATE_FAILED;
    },

    failTimeout: function() {
        this._timer = setTimeoutContext(function() {
            this.state = STATE_FAILED;
        }, this.options.interval, this);
        return STATE_FAILED;
    },

    reset: function() {
        clearTimeout(this._timer);
    },

    emit: function() {
        if (this.state == STATE_RECOGNIZED) {
            this._input.tapCount = this.count;
            this.manager.emit(this.options.event, this._input);
        }
    }
});

/**
 * Simple way to create a manager with a default set of recognizers.
 * @param {HTMLElement} element
 * @param {Object} [options]
 * @constructor
 */
function Hammer(element, options) {
    options = options || {};
    options.recognizers = ifUndefined(options.recognizers, Hammer.defaults.preset);
    return new Manager(element, options);
}

/**
 * @const {string}
 */
Hammer.VERSION = '2.0.7';

/**
 * default settings
 * @namespace
 */
Hammer.defaults = {
    /**
     * set if DOM events are being triggered.
     * But this is slower and unused by simple implementations, so disabled by default.
     * @type {Boolean}
     * @default false
     */
    domEvents: false,

    /**
     * The value for the touchAction property/fallback.
     * When set to `compute` it will magically set the correct value based on the added recognizers.
     * @type {String}
     * @default compute
     */
    touchAction: TOUCH_ACTION_COMPUTE,

    /**
     * @type {Boolean}
     * @default true
     */
    enable: true,

    /**
     * EXPERIMENTAL FEATURE -- can be removed/changed
     * Change the parent input target element.
     * If Null, then it is being set the to main element.
     * @type {Null|EventTarget}
     * @default null
     */
    inputTarget: null,

    /**
     * force an input class
     * @type {Null|Function}
     * @default null
     */
    inputClass: null,

    /**
     * Default recognizer setup when calling `Hammer()`
     * When creating a new Manager these will be skipped.
     * @type {Array}
     */
    preset: [
        // RecognizerClass, options, [recognizeWith, ...], [requireFailure, ...]
        [RotateRecognizer, {enable: false}],
        [PinchRecognizer, {enable: false}, ['rotate']],
        [SwipeRecognizer, {direction: DIRECTION_HORIZONTAL}],
        [PanRecognizer, {direction: DIRECTION_HORIZONTAL}, ['swipe']],
        [TapRecognizer],
        [TapRecognizer, {event: 'doubletap', taps: 2}, ['tap']],
        [PressRecognizer]
    ],

    /**
     * Some CSS properties can be used to improve the working of Hammer.
     * Add them to this method and they will be set when creating a new Manager.
     * @namespace
     */
    cssProps: {
        /**
         * Disables text selection to improve the dragging gesture. Mainly for desktop browsers.
         * @type {String}
         * @default 'none'
         */
        userSelect: 'none',

        /**
         * Disable the Windows Phone grippers when pressing an element.
         * @type {String}
         * @default 'none'
         */
        touchSelect: 'none',

        /**
         * Disables the default callout shown when you touch and hold a touch target.
         * On iOS, when you touch and hold a touch target such as a link, Safari displays
         * a callout containing information about the link. This property allows you to disable that callout.
         * @type {String}
         * @default 'none'
         */
        touchCallout: 'none',

        /**
         * Specifies whether zooming is enabled. Used by IE10>
         * @type {String}
         * @default 'none'
         */
        contentZooming: 'none',

        /**
         * Specifies that an entire element should be draggable instead of its contents. Mainly for desktop browsers.
         * @type {String}
         * @default 'none'
         */
        userDrag: 'none',

        /**
         * Overrides the highlight color shown when the user taps a link or a JavaScript
         * clickable element in iOS. This property obeys the alpha value, if specified.
         * @type {String}
         * @default 'rgba(0,0,0,0)'
         */
        tapHighlightColor: 'rgba(0,0,0,0)'
    }
};

var STOP = 1;
var FORCED_STOP = 2;

/**
 * Manager
 * @param {HTMLElement} element
 * @param {Object} [options]
 * @constructor
 */
function Manager(element, options) {
    this.options = assign({}, Hammer.defaults, options || {});

    this.options.inputTarget = this.options.inputTarget || element;

    this.handlers = {};
    this.session = {};
    this.recognizers = [];
    this.oldCssProps = {};

    this.element = element;
    this.input = createInputInstance(this);
    this.touchAction = new TouchAction(this, this.options.touchAction);

    toggleCssProps(this, true);

    each(this.options.recognizers, function(item) {
        var recognizer = this.add(new (item[0])(item[1]));
        item[2] && recognizer.recognizeWith(item[2]);
        item[3] && recognizer.requireFailure(item[3]);
    }, this);
}

Manager.prototype = {
    /**
     * set options
     * @param {Object} options
     * @returns {Manager}
     */
    set: function(options) {
        assign(this.options, options);

        // Options that need a little more setup
        if (options.touchAction) {
            this.touchAction.update();
        }
        if (options.inputTarget) {
            // Clean up existing event listeners and reinitialize
            this.input.destroy();
            this.input.target = options.inputTarget;
            this.input.init();
        }
        return this;
    },

    /**
     * stop recognizing for this session.
     * This session will be discarded, when a new [input]start event is fired.
     * When forced, the recognizer cycle is stopped immediately.
     * @param {Boolean} [force]
     */
    stop: function(force) {
        this.session.stopped = force ? FORCED_STOP : STOP;
    },

    /**
     * run the recognizers!
     * called by the inputHandler function on every movement of the pointers (touches)
     * it walks through all the recognizers and tries to detect the gesture that is being made
     * @param {Object} inputData
     */
    recognize: function(inputData) {
        var session = this.session;
        if (session.stopped) {
            return;
        }

        // run the touch-action polyfill
        this.touchAction.preventDefaults(inputData);

        var recognizer;
        var recognizers = this.recognizers;

        // this holds the recognizer that is being recognized.
        // so the recognizer's state needs to be BEGAN, CHANGED, ENDED or RECOGNIZED
        // if no recognizer is detecting a thing, it is set to `null`
        var curRecognizer = session.curRecognizer;

        // reset when the last recognizer is recognized
        // or when we're in a new session
        if (!curRecognizer || (curRecognizer && curRecognizer.state & STATE_RECOGNIZED)) {
            curRecognizer = session.curRecognizer = null;
        }

        var i = 0;
        while (i < recognizers.length) {
            recognizer = recognizers[i];

            // find out if we are allowed try to recognize the input for this one.
            // 1.   allow if the session is NOT forced stopped (see the .stop() method)
            // 2.   allow if we still haven't recognized a gesture in this session, or the this recognizer is the one
            //      that is being recognized.
            // 3.   allow if the recognizer is allowed to run simultaneous with the current recognized recognizer.
            //      this can be setup with the `recognizeWith()` method on the recognizer.
            if (session.stopped !== FORCED_STOP && ( // 1
                    !curRecognizer || recognizer == curRecognizer || // 2
                    recognizer.canRecognizeWith(curRecognizer))) { // 3
                recognizer.recognize(inputData);
            } else {
                recognizer.reset();
            }

            // if the recognizer has been recognizing the input as a valid gesture, we want to store this one as the
            // current active recognizer. but only if we don't already have an active recognizer
            if (!curRecognizer && recognizer.state & (STATE_BEGAN | STATE_CHANGED | STATE_ENDED)) {
                curRecognizer = session.curRecognizer = recognizer;
            }
            i++;
        }
    },

    /**
     * get a recognizer by its event name.
     * @param {Recognizer|String} recognizer
     * @returns {Recognizer|Null}
     */
    get: function(recognizer) {
        if (recognizer instanceof Recognizer) {
            return recognizer;
        }

        var recognizers = this.recognizers;
        for (var i = 0; i < recognizers.length; i++) {
            if (recognizers[i].options.event == recognizer) {
                return recognizers[i];
            }
        }
        return null;
    },

    /**
     * add a recognizer to the manager
     * existing recognizers with the same event name will be removed
     * @param {Recognizer} recognizer
     * @returns {Recognizer|Manager}
     */
    add: function(recognizer) {
        if (invokeArrayArg(recognizer, 'add', this)) {
            return this;
        }

        // remove existing
        var existing = this.get(recognizer.options.event);
        if (existing) {
            this.remove(existing);
        }

        this.recognizers.push(recognizer);
        recognizer.manager = this;

        this.touchAction.update();
        return recognizer;
    },

    /**
     * remove a recognizer by name or instance
     * @param {Recognizer|String} recognizer
     * @returns {Manager}
     */
    remove: function(recognizer) {
        if (invokeArrayArg(recognizer, 'remove', this)) {
            return this;
        }

        recognizer = this.get(recognizer);

        // let's make sure this recognizer exists
        if (recognizer) {
            var recognizers = this.recognizers;
            var index = inArray(recognizers, recognizer);

            if (index !== -1) {
                recognizers.splice(index, 1);
                this.touchAction.update();
            }
        }

        return this;
    },

    /**
     * bind event
     * @param {String} events
     * @param {Function} handler
     * @returns {EventEmitter} this
     */
    on: function(events, handler) {
        if (events === undefined) {
            return;
        }
        if (handler === undefined) {
            return;
        }

        var handlers = this.handlers;
        each(splitStr(events), function(event) {
            handlers[event] = handlers[event] || [];
            handlers[event].push(handler);
        });
        return this;
    },

    /**
     * unbind event, leave emit blank to remove all handlers
     * @param {String} events
     * @param {Function} [handler]
     * @returns {EventEmitter} this
     */
    off: function(events, handler) {
        if (events === undefined) {
            return;
        }

        var handlers = this.handlers;
        each(splitStr(events), function(event) {
            if (!handler) {
                delete handlers[event];
            } else {
                handlers[event] && handlers[event].splice(inArray(handlers[event], handler), 1);
            }
        });
        return this;
    },

    /**
     * emit event to the listeners
     * @param {String} event
     * @param {Object} data
     */
    emit: function(event, data) {
        // we also want to trigger dom events
        if (this.options.domEvents) {
            triggerDomEvent(event, data);
        }

        // no handlers, so skip it all
        var handlers = this.handlers[event] && this.handlers[event].slice();
        if (!handlers || !handlers.length) {
            return;
        }

        data.type = event;
        data.preventDefault = function() {
            data.srcEvent.preventDefault();
        };

        var i = 0;
        while (i < handlers.length) {
            handlers[i](data);
            i++;
        }
    },

    /**
     * destroy the manager and unbinds all events
     * it doesn't unbind dom events, that is the user own responsibility
     */
    destroy: function() {
        this.element && toggleCssProps(this, false);

        this.handlers = {};
        this.session = {};
        this.input.destroy();
        this.element = null;
    }
};

/**
 * add/remove the css properties as defined in manager.options.cssProps
 * @param {Manager} manager
 * @param {Boolean} add
 */
function toggleCssProps(manager, add) {
    var element = manager.element;
    if (!element.style) {
        return;
    }
    var prop;
    each(manager.options.cssProps, function(value, name) {
        prop = prefixed(element.style, name);
        if (add) {
            manager.oldCssProps[prop] = element.style[prop];
            element.style[prop] = value;
        } else {
            element.style[prop] = manager.oldCssProps[prop] || '';
        }
    });
    if (!add) {
        manager.oldCssProps = {};
    }
}

/**
 * trigger dom event
 * @param {String} event
 * @param {Object} data
 */
function triggerDomEvent(event, data) {
    var gestureEvent = document.createEvent('Event');
    gestureEvent.initEvent(event, true, true);
    gestureEvent.gesture = data;
    data.target.dispatchEvent(gestureEvent);
}

assign(Hammer, {
    INPUT_START: INPUT_START,
    INPUT_MOVE: INPUT_MOVE,
    INPUT_END: INPUT_END,
    INPUT_CANCEL: INPUT_CANCEL,

    STATE_POSSIBLE: STATE_POSSIBLE,
    STATE_BEGAN: STATE_BEGAN,
    STATE_CHANGED: STATE_CHANGED,
    STATE_ENDED: STATE_ENDED,
    STATE_RECOGNIZED: STATE_RECOGNIZED,
    STATE_CANCELLED: STATE_CANCELLED,
    STATE_FAILED: STATE_FAILED,

    DIRECTION_NONE: DIRECTION_NONE,
    DIRECTION_LEFT: DIRECTION_LEFT,
    DIRECTION_RIGHT: DIRECTION_RIGHT,
    DIRECTION_UP: DIRECTION_UP,
    DIRECTION_DOWN: DIRECTION_DOWN,
    DIRECTION_HORIZONTAL: DIRECTION_HORIZONTAL,
    DIRECTION_VERTICAL: DIRECTION_VERTICAL,
    DIRECTION_ALL: DIRECTION_ALL,

    Manager: Manager,
    Input: Input,
    TouchAction: TouchAction,

    TouchInput: TouchInput,
    MouseInput: MouseInput,
    PointerEventInput: PointerEventInput,
    TouchMouseInput: TouchMouseInput,
    SingleTouchInput: SingleTouchInput,

    Recognizer: Recognizer,
    AttrRecognizer: AttrRecognizer,
    Tap: TapRecognizer,
    Pan: PanRecognizer,
    Swipe: SwipeRecognizer,
    Pinch: PinchRecognizer,
    Rotate: RotateRecognizer,
    Press: PressRecognizer,

    on: addEventListeners,
    off: removeEventListeners,
    each: each,
    merge: merge,
    extend: extend,
    assign: assign,
    inherit: inherit,
    bindFn: bindFn,
    prefixed: prefixed
});

// this prevents errors when Hammer is loaded in the presence of an AMD
//  style loader but by script tag, not by the loader.
var freeGlobal = (typeof window !== 'undefined' ? window : (typeof self !== 'undefined' ? self : {})); // jshint ignore:line
freeGlobal.Hammer = Hammer;

if (true) {
    !(__WEBPACK_AMD_DEFINE_RESULT__ = (function() {
        return Hammer;
    }).call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
} else {}

})(window, document, 'Hammer');


/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=template&id=04d3a9fa&":
/*!******************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=template&id=04d3a9fa& ***!
  \******************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog" },
      on: {
        click: function($event) {
          if ($event.target !== $event.currentTarget) {
            return null
          }
          return _vm.close()
        },
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.close()
        }
      }
    },
    [
      _c(
        "div",
        { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: { type: "button", "aria-label": "Close" },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title" }, [
                _vm._v(_vm._s(_vm.title()))
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _vm.hasAccessCodeClues()
                ? _c("p", [
                    _c("i", { staticClass: "mdi mdi-information-outline" }),
                    _vm._v(
                      "\n                    " +
                        _vm._s(_vm.accessCodeClues()) +
                        "\n                "
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.accessCode,
                    expression: "accessCode"
                  }
                ],
                ref: "input",
                staticClass: "form-control",
                class: {
                  animated: _vm.animated,
                  shake: !_vm.correctCode && _vm.animated
                },
                attrs: {
                  type: "text",
                  placeholder: _vm.$t("access-code-placeholder")
                },
                domProps: { value: _vm.accessCode },
                on: {
                  keyup: function($event) {
                    if (
                      !$event.type.indexOf("key") &&
                      _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                    ) {
                      return null
                    }
                    return _vm.check()
                  },
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.accessCode = $event.target.value
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-default",
                  attrs: { type: "button", title: _vm.$t("close") },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [_c("i", { staticClass: "mdi mdi-close" })]
              ),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-primary",
                  attrs: {
                    type: "button",
                    disabled: !_vm.canCheck(),
                    title: _vm.$t("submit")
                  },
                  on: {
                    click: function($event) {
                      return _vm.check()
                    }
                  }
                },
                [_c("i", { staticClass: "mdi mdi-compare" })]
              )
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=template&id=5ec52480&":
/*!*************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=template&id=5ec52480& ***!
  \*************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog" },
      on: {
        click: function($event) {
          if ($event.target !== $event.currentTarget) {
            return null
          }
          return _vm.close()
        },
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.close()
        }
      }
    },
    [
      _c(
        "div",
        {
          staticClass: "modal-dialog modal-lg sz-game-question",
          attrs: { role: "document" }
        },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: {
                    type: "button",
                    "aria-label": "Close",
                    diabled: _vm.inAjaxCall
                  },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title" }, [
                _vm._v(_vm._s(_vm.title()))
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _vm._v(
                "\n                " + _vm._s(_vm.message) + "\n            "
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-default",
                  attrs: { type: "button", title: _vm.$t("close") },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [_c("i", { staticClass: "mdi mdi-close" })]
              )
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=template&id=6d65ef36&":
/*!*********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=template&id=6d65ef36& ***!
  \*********************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog" },
      on: {
        click: function($event) {
          if ($event.target !== $event.currentTarget) {
            return null
          }
          return _vm.close()
        },
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.close()
        }
      }
    },
    [
      _c(
        "div",
        {
          staticClass: "modal-dialog modal-lg sz-game-question",
          attrs: { role: "document" }
        },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: {
                    type: "button",
                    "aria-label": "Close",
                    diabled: _vm.inAjaxCall
                  },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title" }, [
                _vm._v(_vm._s(_vm.title()))
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _vm._v(
                "\n                " +
                  _vm._s(_vm.$t("items.answering_time.description")) +
                  "\n            "
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-primary",
                  attrs: {
                    type: "button",
                    title: _vm.$t("items.answering_time.start_timer")
                  },
                  on: {
                    click: function($event) {
                      return _vm.startTimer()
                    }
                  }
                },
                [
                  _vm._v(
                    "\n                    " +
                      _vm._s(_vm.$t("items.answering_time.start_timer")) +
                      " "
                  ),
                  _c("i", { staticClass: "mdi mdi-play-circle-outline" })
                ]
              )
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameImageDialog.vue?vue&type=template&id=799abdca&":
/*!**************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameImageDialog.vue?vue&type=template&id=799abdca& ***!
  \**************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "dialog",
      staticClass: "sz-image-dialog",
      on: {
        click: function($event) {
          return _vm.close()
        }
      }
    },
    [
      _c("div", { staticClass: "sz-image-dialog-backdrop" }),
      _vm._v(" "),
      _c("img", {
        ref: "image",
        staticClass: "animated",
        attrs: { alt: "image", src: _vm.imageUrl() }
      })
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameInformationModal.vue?vue&type=template&id=2a6a2e2a&":
/*!*******************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameInformationModal.vue?vue&type=template&id=2a6a2e2a& ***!
  \*******************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog" },
      on: {
        click: function($event) {
          if ($event.target !== $event.currentTarget) {
            return null
          }
          return _vm.close()
        },
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.close()
        }
      }
    },
    [
      _c(
        "div",
        { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: { type: "button", "aria-label": "Close" },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title text-center" }, [
                _vm._v(_vm._s(_vm.activity.title))
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _vm._m(0),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "collapse", attrs: { id: "iconCodes" } },
                [
                  _c(
                    "div",
                    { staticClass: "well well-sm" },
                    [
                      _c("p", { staticClass: "help-block" }, [
                        _vm._v(_vm._s(_vm.$t("icons.help")))
                      ]),
                      _vm._v(" "),
                      _vm._l(_vm.icons, function(icon) {
                        return _c("div", { staticClass: "media" }, [
                          _c(
                            "div",
                            { staticClass: "media-left media-middle" },
                            [
                              _c("img", {
                                staticClass: "media-object",
                                staticStyle: { width: "30px", height: "30px" },
                                attrs: {
                                  alt: "icon",
                                  src: _vm.getIconUrl(icon)
                                }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c("div", { staticClass: "media-body" }, [
                            _c("p", [_vm._v(_vm._s(_vm.getIconText(icon)))])
                          ])
                        ])
                      })
                    ],
                    2
                  )
                ]
              ),
              _vm._v(" "),
              _vm.activity.description
                ? _c("p", { staticClass: "sz-display-new-lines text-center" }, [
                    _vm._v(
                      "\n                    " +
                        _vm._s(_vm.activity.description) +
                        "\n                "
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _c("h4", [_vm._v(_vm._s(_vm.$t("number-of-questions")))]),
              _vm._v(" "),
              _c("p", [_vm._v(_vm._s(_vm.activity.questions.length))]),
              _vm._v(" "),
              _c("h4", [_vm._v(_vm._s(_vm.$t("playing-time")))]),
              _vm._v(" "),
              _c("p", [
                _vm._v(
                  "\n                    " +
                    _vm._s(_vm.activity.playing_time) +
                    " " +
                    _vm._s(_vm.$t("minutes")) +
                    "\n                "
                )
              ]),
              _vm._v(" "),
              _c("p", [
                _c("img", {
                  staticClass: "img-responsive center-block",
                  attrs: {
                    src: _vm.activity.featured_image,
                    alt: "featured-image"
                  }
                })
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-lg center-block sz-go-btn",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [_vm._v(_vm._s(_vm.$t("go")))]
              )
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "button",
      {
        staticClass: "btn btn-default btn-sm pull-right",
        attrs: {
          role: "button",
          "data-toggle": "collapse",
          "data-target": "#iconCodes",
          "aria-expanded": "false",
          "aria-controls": "iconCodes"
        }
      },
      [_c("i", { staticClass: "mdi mdi-information-outline" })]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMap.vue?vue&type=template&id=6b300b23&":
/*!******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameMap.vue?vue&type=template&id=6b300b23& ***!
  \******************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticStyle: { height: "100%", width: "100%" } },
    [
      _c("game-image-dialog", {
        ref: "correctImageDialog",
        attrs: {
          "base-url": _vm.baseUrl,
          image: "answer_correct.png",
          "in-animation-class": "bounceInUp",
          "out-animation-class": "bounceOut"
        }
      }),
      _vm._v(" "),
      _c("game-image-dialog", {
        ref: "incorrectImageDialog",
        attrs: {
          "base-url": _vm.baseUrl,
          image: "answer_incorrect.png",
          "in-animation-class": "bounceInDown",
          "out-animation-class": "bounceOutDown"
        }
      }),
      _vm._v(" "),
      _c("game-image-dialog", {
        ref: "submittedImageDialog",
        attrs: {
          "base-url": _vm.baseUrl,
          image: "answer_submitted.png",
          "in-animation-class": "bounceInRight",
          "out-animation-class": "bounceOutLeft"
        }
      }),
      _vm._v(" "),
      _vm.question
        ? _c("game-question-modal", {
            ref: "questionModal",
            attrs: {
              question: _vm.question,
              answer: _vm.answer,
              "game-id": _vm.game.id,
              "base-url": _vm.baseUrl
            }
          })
        : _vm._e(),
      _vm._v(" "),
      _vm.question
        ? _c("game-answering-time-modal", {
            ref: "answeringTimeModal",
            attrs: {
              question: _vm.question,
              "game-id": _vm.game.id,
              "base-url": _vm.baseUrl
            }
          })
        : _vm._e(),
      _vm._v(" "),
      _c("game-answering-time-is-up-modal", {
        ref: "answeringTimeIsUpModal",
        attrs: { question: _vm.question }
      }),
      _vm._v(" "),
      _c("game-access-code-modal", {
        ref: "accessCodeModal",
        attrs: { question: _vm.question }
      }),
      _vm._v(" "),
      _c("notification-modal", {
        ref: "notificationModal",
        attrs: {
          title: _vm.notificationTitle,
          message: _vm.notificationMessage
        }
      }),
      _vm._v(" "),
      _c("game-messages-list-modal", {
        ref: "gameMessagesListModal",
        attrs: { game_id: _vm.game.id, type: "play" }
      }),
      _vm._v(" "),
      _c("div", { attrs: { id: "map" } }),
      _vm._v(" "),
      _c("div", { attrs: { id: "messages-container" } })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=template&id=5266066c&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=template&id=5266066c&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog" },
      on: {
        click: function($event) {
          if ($event.target !== $event.currentTarget) {
            return null
          }
          return _vm.close()
        },
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.close()
        }
      }
    },
    [
      _c(
        "div",
        { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: {
                    type: "button",
                    "aria-label": "Close",
                    diabled: _vm.inAjaxCall
                  },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title" }, [
                _vm._v(_vm._s(_vm.$t("game-messages")))
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _c(
                "table",
                { staticClass: "messages-container table" },
                _vm._l(_vm.messages, function(message) {
                  return _c(
                    "tr",
                    { class: { message: _vm.isManager() === true } },
                    [
                      _vm.isManager() === false
                        ? _c("td", [
                            _c("div", { staticClass: "panel panel-default" }, [
                              _c("div", { staticClass: "panel-body" }, [
                                _c(
                                  "p",
                                  {
                                    staticStyle: { "white-space": "pre-line" }
                                  },
                                  [_vm._v(_vm._s(message.message))]
                                ),
                                _vm._v(" "),
                                _c("small", [
                                  _vm._v(_vm._s(message.created_at))
                                ])
                              ])
                            ])
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.isManager() === true
                        ? _c(
                            "td",
                            { staticStyle: { "white-space": "pre-line" } },
                            [_vm._v(_vm._s(message.message))]
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.isManager() === true
                        ? _c("td", [_vm._v(_vm._s(message.created_at))])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.isManager() === true
                        ? _c("td", [
                            _c(
                              "button",
                              {
                                staticClass: "pull-right btn btn-danger",
                                on: {
                                  click: function($event) {
                                    return _vm.deleteMessage(
                                      _vm.event,
                                      message.id
                                    )
                                  }
                                }
                              },
                              [
                                _vm._v(
                                  "\n                                " +
                                    _vm._s(_vm.$t("delete-message")) +
                                    "\n                            "
                                )
                              ]
                            )
                          ])
                        : _vm._e()
                    ]
                  )
                }),
                0
              ),
              _vm._v(" "),
              _vm.isManager() === true
                ? _c("div", { staticClass: "add-message-container" }, [
                    _c("textarea", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.newMessage,
                          expression: "newMessage"
                        }
                      ],
                      ref: "newMessageInput",
                      staticClass: "form-control",
                      domProps: { value: _vm.newMessage },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.newMessage = $event.target.value
                        }
                      }
                    }),
                    _vm._v(" "),
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-success",
                        attrs: { type: "button" },
                        on: { click: _vm.addNewMessage }
                      },
                      [
                        _vm._v(
                          "\n                        " +
                            _vm._s(_vm.$t("add-new-message")) +
                            "\n                    "
                        )
                      ]
                    )
                  ])
                : _vm._e()
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameQuestionModal.vue?vue&type=template&id=673a7024&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameQuestionModal.vue?vue&type=template&id=673a7024&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog" },
      on: {
        click: function($event) {
          if ($event.target !== $event.currentTarget) {
            return null
          }
          return _vm.close()
        },
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.close()
        }
      }
    },
    [
      _c(
        "div",
        {
          staticClass: "modal-dialog modal-lg sz-game-question",
          attrs: { role: "document" }
        },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: {
                    type: "button",
                    "aria-label": "Close",
                    diabled: _vm.inAjaxCall
                  },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title" }, [
                _vm._v(
                  "\n                    " +
                    _vm._s(_vm.title()) +
                    "\n                    "
                ),
                _vm.answeringTime != null
                  ? _c(
                      "span",
                      {
                        staticClass: "pull-right",
                        staticStyle: { "padding-right": "15px" }
                      },
                      [
                        _vm._v(
                          _vm._s(_vm.$t("remaining_time")) +
                            ": " +
                            _vm._s(_vm.answeringTime)
                        )
                      ]
                    )
                  : _vm._e()
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _vm.hasImage()
                ? _c("div", [
                    _c("img", {
                      staticClass: "img-responsive",
                      attrs: { src: "", alt: "image", src: _vm.image() }
                    })
                  ])
                : _vm._e(),
              _vm._v(" "),
              _c("p", { staticClass: "sz-display-new-lines" }, [
                _vm._v(_vm._s(_vm.description()))
              ]),
              _vm._v(" "),
              _vm.isOneCorrectAnswer()
                ? _c("div", [
                    _c(
                      "ul",
                      { staticClass: "media-list sz-one-correct-answer" },
                      _vm._l(_vm.options(), function(option, index) {
                        return _c(
                          "li",
                          {
                            staticClass: "media",
                            on: {
                              click: function($event) {
                                return _vm.triggerOptionClick(index)
                              }
                            }
                          },
                          [
                            option.image_url
                              ? _c("div", { staticClass: "media-left" }, [
                                  _c("img", {
                                    staticClass: "media-object",
                                    attrs: {
                                      src: option.image_url,
                                      alt: "option-image"
                                    }
                                  })
                                ])
                              : _vm._e(),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "media-body media-middle" },
                              [
                                _c(
                                  "h4",
                                  {
                                    staticClass: "media-heading",
                                    class: {
                                      selected:
                                        _vm.isAnswered() &&
                                        _vm.isSelectedOption(option.id)
                                    }
                                  },
                                  [_vm._v(_vm._s(option.option))]
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "media-right media-middle" },
                              [
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.selectedOptions,
                                      expression: "selectedOptions"
                                    }
                                  ],
                                  ref: "option",
                                  refInFor: true,
                                  staticClass: "form-control",
                                  attrs: { type: "radio", name: "option" },
                                  domProps: {
                                    value: option.id,
                                    checked: _vm._q(
                                      _vm.selectedOptions,
                                      option.id
                                    )
                                  },
                                  on: {
                                    change: function($event) {
                                      _vm.selectedOptions = option.id
                                    }
                                  }
                                }),
                                _vm._v(" "),
                                !_vm.isSelectedOption(option.id) &&
                                !_vm.isAnswered()
                                  ? _c("i", {
                                      staticClass: "mdi mdi-radiobox-blank"
                                    })
                                  : _vm._e(),
                                _vm._v(" "),
                                _vm.isSelectedOption(option.id) &&
                                !_vm.isAnswered()
                                  ? _c("i", {
                                      staticClass: "mdi mdi-radiobox-marked"
                                    })
                                  : _vm._e(),
                                _vm._v(" "),
                                _vm.isAnswered()
                                  ? _c("i", {
                                      staticClass: "mdi",
                                      class: _vm.optionIconClass(option),
                                      attrs: { "aria-hidden": "true" }
                                    })
                                  : _vm._e()
                              ]
                            )
                          ]
                        )
                      }),
                      0
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.isMultipleCorrectAnswers()
                ? _c("div", [
                    _c(
                      "ul",
                      { staticClass: "media-list sz-multiple-correct-answers" },
                      _vm._l(_vm.options(), function(option, index) {
                        return _c(
                          "li",
                          {
                            staticClass: "media",
                            on: {
                              click: function($event) {
                                return _vm.triggerOptionClick(index)
                              }
                            }
                          },
                          [
                            option.image_url
                              ? _c("div", { staticClass: "media-left" }, [
                                  _c("img", {
                                    staticClass: "media-object",
                                    attrs: {
                                      src: option.image_url,
                                      alt: "option-image"
                                    }
                                  })
                                ])
                              : _vm._e(),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "media-body media-middle" },
                              [
                                _c(
                                  "h4",
                                  {
                                    staticClass: "media-heading",
                                    class: {
                                      selected:
                                        _vm.isAnswered() &&
                                        _vm.isSelectedOption(option.id)
                                    }
                                  },
                                  [_vm._v(_vm._s(option.option))]
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              { staticClass: "media-right media-middle" },
                              [
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.selectedOptions,
                                      expression: "selectedOptions"
                                    }
                                  ],
                                  ref: "option",
                                  refInFor: true,
                                  staticClass: "form-control",
                                  attrs: {
                                    type: "checkbox",
                                    name: "options[]"
                                  },
                                  domProps: {
                                    value: option.id,
                                    checked: Array.isArray(_vm.selectedOptions)
                                      ? _vm._i(_vm.selectedOptions, option.id) >
                                        -1
                                      : _vm.selectedOptions
                                  },
                                  on: {
                                    change: function($event) {
                                      var $$a = _vm.selectedOptions,
                                        $$el = $event.target,
                                        $$c = $$el.checked ? true : false
                                      if (Array.isArray($$a)) {
                                        var $$v = option.id,
                                          $$i = _vm._i($$a, $$v)
                                        if ($$el.checked) {
                                          $$i < 0 &&
                                            (_vm.selectedOptions = $$a.concat([
                                              $$v
                                            ]))
                                        } else {
                                          $$i > -1 &&
                                            (_vm.selectedOptions = $$a
                                              .slice(0, $$i)
                                              .concat($$a.slice($$i + 1)))
                                        }
                                      } else {
                                        _vm.selectedOptions = $$c
                                      }
                                    }
                                  }
                                }),
                                _vm._v(" "),
                                !_vm.isSelectedOption(option.id) &&
                                !_vm.isAnswered()
                                  ? _c("i", {
                                      staticClass:
                                        "mdi mdi-checkbox-blank-outline"
                                    })
                                  : _vm._e(),
                                _vm._v(" "),
                                _vm.isSelectedOption(option.id) &&
                                !_vm.isAnswered()
                                  ? _c("i", {
                                      staticClass:
                                        "mdi mdi-checkbox-marked-outline"
                                    })
                                  : _vm._e(),
                                _vm._v(" "),
                                _vm.isAnswered()
                                  ? _c("i", {
                                      staticClass: "mdi",
                                      class: _vm.optionIconClass(option),
                                      attrs: { "aria-hidden": "true" }
                                    })
                                  : _vm._e()
                              ]
                            )
                          ]
                        )
                      }),
                      0
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.isFreeformAnswer()
                ? _c("div", [
                    _c("div", { staticClass: "form-group" }, [
                      !_vm.isAnswered()
                        ? _c("textarea", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.textualAnswer,
                                expression: "textualAnswer"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: {
                              placeholder: _vm.$t("textual-answer-placeholder")
                            },
                            domProps: { value: _vm.textualAnswer },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.textualAnswer = $event.target.value
                              }
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.isAnswered()
                        ? _c("textarea", {
                            staticClass: "form-control",
                            attrs: {
                              placeholder: _vm.$t("textual-answer-placeholder"),
                              readonly: "readonly"
                            },
                            domProps: { value: _vm.answer.answer.text }
                          })
                        : _vm._e()
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.isMatchPairs()
                ? _c("div", [
                    _c("div", { staticClass: "row sz-match-pairs" }, [
                      _c(
                        "div",
                        { staticClass: "col-xs-6" },
                        _vm._l(_vm.pairs(), function(pair) {
                          return _c("div", { staticClass: "row" }, [
                            _c("div", { staticClass: "col-xs-12" }, [
                              _c(
                                "div",
                                {
                                  ref: "matchable",
                                  refInFor: true,
                                  staticClass: "sz-matchable",
                                  class: {
                                    chosen: _vm.isOptionChosen(pair),
                                    matched: _vm.isMatchedPair(pair)
                                  },
                                  style: _vm.matchableStyles,
                                  on: {
                                    click: function($event) {
                                      return _vm.choosePair(pair)
                                    }
                                  }
                                },
                                [
                                  pair.image_url
                                    ? _c("img", {
                                        staticClass: "media-object",
                                        attrs: {
                                          src: pair.image_url,
                                          alt: "pair-image"
                                        }
                                      })
                                    : _vm._e(),
                                  _vm._v(" "),
                                  _c("div", [_vm._v(_vm._s(pair.option))])
                                ]
                              )
                            ])
                          ])
                        }),
                        0
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col-xs-6" },
                        _vm._l(_vm.pairs(true), function(pair) {
                          return _c("div", { staticClass: "row" }, [
                            _c("div", { staticClass: "col-xs-12" }, [
                              _c(
                                "div",
                                {
                                  ref: "matchable",
                                  refInFor: true,
                                  staticClass: "sz-matchable",
                                  class: {
                                    chosen: _vm.isOptionMatchChosen(pair),
                                    matched: _vm.isMatchedPair(pair)
                                  },
                                  style: _vm.matchableStyles,
                                  on: {
                                    click: function($event) {
                                      return _vm.choosePairMatch(pair)
                                    }
                                  }
                                },
                                [
                                  pair.image_match_url
                                    ? _c("img", {
                                        staticClass: "media-object",
                                        attrs: {
                                          src: pair.image_match_url,
                                          alt: "pair-image"
                                        }
                                      })
                                    : _vm._e(),
                                  _vm._v(" "),
                                  _c("div", [_vm._v(_vm._s(pair.option_match))])
                                ]
                              )
                            ])
                          ])
                        }),
                        0
                      )
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.isEmbeddedContent()
                ? _c("div", [
                    _c("div", {
                      staticClass: "embed-responsive embed-responsive-16by9",
                      domProps: { innerHTML: _vm._s(_vm.embeddedContent()) }
                    }),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group" }, [
                      !_vm.isAnswered()
                        ? _c("textarea", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.textualAnswer,
                                expression: "textualAnswer"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: {
                              placeholder: _vm.$t("textual-answer-placeholder")
                            },
                            domProps: { value: _vm.textualAnswer },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.textualAnswer = $event.target.value
                              }
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.isAnswered()
                        ? _c("textarea", {
                            staticClass: "form-control",
                            attrs: {
                              placeholder: _vm.$t("textual-answer-placeholder"),
                              readonly: "readonly"
                            },
                            domProps: { value: _vm.answer.answer.text }
                          })
                        : _vm._e()
                    ])
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.isPhoto() && !_vm.isAnswered()
                ? _c(
                    "div",
                    { staticClass: "sz-photo" },
                    [
                      _c(
                        "transition",
                        {
                          attrs: {
                            name: "fade-in-down-out-up",
                            "enter-active-class": "animated fadeInDown",
                            "leave-active-class": "animated fadeOutUp"
                          }
                        },
                        [
                          _c(
                            "div",
                            {
                              directives: [
                                {
                                  name: "show",
                                  rawName: "v-show",
                                  value: _vm.incorrectImageFormat,
                                  expression: "incorrectImageFormat"
                                }
                              ],
                              staticClass: "alert alert-danger text-center",
                              attrs: { role: "alert" }
                            },
                            [
                              _vm._v(
                                "\n                            " +
                                  _vm._s(_vm.$t("image-format-hint")) +
                                  "\n                        "
                              )
                            ]
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "row text-center" }, [
                        _c(
                          "a",
                          {
                            directives: [
                              {
                                name: "show",
                                rawName: "v-show",
                                value: !_vm.hasImageSelected,
                                expression: "!hasImageSelected"
                              }
                            ],
                            staticClass: "btn sz-take-image",
                            attrs: { href: "#", tabindex: "-1" },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                return _vm.triggerImageClick()
                              }
                            }
                          },
                          [
                            _c("i", {
                              staticClass: "mdi mdi-camera",
                              attrs: { "aria-hidden": "true" }
                            })
                          ]
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: _vm.hasImageSelected,
                              expression: "hasImageSelected"
                            }
                          ],
                          staticClass: "row"
                        },
                        [
                          _c(
                            "div",
                            { staticClass: "col-xs-10 col-xs-offset-1" },
                            [
                              _c("img", {
                                staticClass:
                                  "img-responsive center-block sz-image-taken",
                                attrs: {
                                  src: _vm.imageSrc,
                                  alt: "uploadable-image"
                                },
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    return _vm.triggerImageClick()
                                  }
                                }
                              })
                            ]
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c("input", {
                        ref: "image",
                        attrs: {
                          type: "file",
                          accept: "image/jpeg, image/png",
                          capture: "camera",
                          name: "image"
                        },
                        on: { change: _vm.imageSelected }
                      })
                    ],
                    1
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.isPhoto() && _vm.isAnswered()
                ? _c("div", { staticClass: "sz-photo" }, [
                    _vm.isAnswered()
                      ? _c("img", {
                          staticClass:
                            "img-responsive center-block sz-image-taken",
                          attrs: {
                            src: _vm.answer.image,
                            alt: "uploaded-image"
                          }
                        })
                      : _vm._e()
                  ])
                : _vm._e(),
              _vm._v(" "),
              _vm.isMissingWord()
                ? _c("div", { staticClass: "missing-word-container" }, [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      _vm._l(_vm.missingWords, function(word, index) {
                        return _c("span", [
                          word.type === "text"
                            ? _c("span", [_vm._v(_vm._s(word.text))])
                            : _vm._e(),
                          _vm._v(" "),
                          word.type === "input" && !_vm.isAnswered()
                            ? _c("input", {
                                attrs: { type: "text", "data-index": index },
                                on: { keyup: _vm.onMissingWordChange }
                              })
                            : _vm._e(),
                          _vm._v(" "),
                          word.type === "input" && _vm.isAnswered()
                            ? _c("span", [
                                word.isCorrect === false
                                  ? _c("span", { staticClass: "incorrect" }, [
                                      _vm._v(_vm._s(word.answer) + " "),
                                      _c("span", { staticClass: "correct" }, [
                                        _vm._v("(" + _vm._s(word.text) + ")")
                                      ])
                                    ])
                                  : _vm._e(),
                                _vm._v(" "),
                                word.isCorrect === true
                                  ? _c("span", { staticClass: "correct" }, [
                                      _vm._v(_vm._s(word.answer))
                                    ])
                                  : _vm._e()
                              ])
                            : _vm._e()
                        ])
                      }),
                      0
                    )
                  ])
                : _vm._e()
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _vm.hasReadMore()
                ? _c(
                    "a",
                    {
                      staticClass: "btn btn-default",
                      attrs: {
                        href: "",
                        href: _vm.readMore(),
                        target: "_blank"
                      }
                    },
                    [
                      _c("i", {
                        staticClass: "mdi mdi-open-in-new",
                        attrs: { "aria-hidden": "true" }
                      }),
                      _vm._v(
                        "\n                    " +
                          _vm._s(_vm.$t("read-more-about")) +
                          "\n                "
                      )
                    ]
                  )
                : _vm._e(),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-default",
                  attrs: {
                    type: "button",
                    disabled: _vm.inAjaxCall,
                    title: _vm.$t("close")
                  },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [_c("i", { staticClass: "mdi mdi-close" })]
              ),
              _vm._v(" "),
              !(_vm.isPreview || _vm.isAnswered())
                ? _c(
                    "button",
                    {
                      staticClass: "btn btn-primary",
                      attrs: {
                        type: "button",
                        disabled: !_vm.canSubmit() || _vm.inAjaxCall,
                        title: _vm.$t("submit")
                      },
                      on: {
                        click: function($event) {
                          return _vm.submit()
                        }
                      }
                    },
                    [_c("i", { staticClass: "mdi mdi-send" })]
                  )
                : _vm._e()
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameRatingModal.vue?vue&type=template&id=29229fd7&":
/*!**************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameRatingModal.vue?vue&type=template&id=29229fd7& ***!
  \**************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: {
        tabindex: "-1",
        role: "dialog",
        "data-backdrop": "static",
        "data-keyboard": "false"
      }
    },
    [
      _c(
        "div",
        {
          staticClass: "modal-dialog modal-lg sz-game-results",
          attrs: { role: "document" }
        },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: { type: "button", "aria-label": "Close" },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title" }, [
                _vm._v(_vm._s(_vm.$t("rating-heading")))
              ])
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "modal-body text-center" },
              _vm._l(_vm.stars, function(star) {
                return _c("a", {
                  staticClass: "mdi mdi-star-outline star",
                  attrs: { href: "#", "data-value": star },
                  on: {
                    click: function($event) {
                      return _vm.addRating(_vm.event, star)
                    },
                    mouseover: _vm.mouseOverStar
                  }
                })
              }),
              0
            ),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer text-center" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-primary",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [_vm._v(_vm._s(_vm.$t("show-results")))]
              )
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameResultsModal.vue?vue&type=template&id=725aa9c0&":
/*!***************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameResultsModal.vue?vue&type=template&id=725aa9c0& ***!
  \***************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: {
        tabindex: "-1",
        role: "dialog",
        "data-backdrop": "static",
        "data-keyboard": "false"
      }
    },
    [
      _c(
        "div",
        {
          staticClass: "modal-dialog modal-lg sz-game-results",
          attrs: { role: "document" }
        },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c("h4", { staticClass: "modal-title" }, [
                _vm._v(_vm._s(_vm.game.activity.title))
              ])
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "modal-body" },
              [
                _c("div", { staticClass: "text-center sz-quick-results" }, [
                  _c("div", { staticClass: "sz-results-count" }, [
                    _vm._v(
                      "\n                        " +
                        _vm._s(_vm.correctQuestionsCount) +
                        "/" +
                        _vm._s(_vm.totalQuestionsCount) +
                        "\n                    "
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "sz-complete-text" }, [
                    _vm._v(
                      "\n                        " +
                        _vm._s(_vm.$t("complete")) +
                        "\n                    "
                    )
                  ])
                ]),
                _vm._v(" "),
                _vm.gotVoucher()
                  ? _c("div", { staticClass: "sz-game-voucher" }, [
                      _c("h2", [_vm._v(_vm._s(_vm.$t("vouchers.heading")))]),
                      _vm._v(" "),
                      _c("p", [_vm._v(_vm._s(_vm.voucherTitle()))]),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          staticClass: "sz-voucher-image",
                          attrs: { href: _vm.getVoucherUrl(), target: "_blank" }
                        },
                        [
                          _c("img", {
                            staticClass: "img-responsive",
                            attrs: {
                              src: _vm.getVoucherImageUrl(),
                              alt: "voucher"
                            }
                          })
                        ]
                      ),
                      _vm._v(" "),
                      _c("p", [_vm._v(_vm._s(_vm.$t("vouchers.details")))]),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          staticClass: "btn btn-default",
                          attrs: { href: _vm.getVoucherUrl(), target: "_blank" }
                        },
                        [_vm._v(_vm._s(_vm.$t("vouchers.button")))]
                      )
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _c("h2", { staticClass: "text-center" }, [
                  _vm._v(_vm._s(_vm.$t("results-heading")))
                ]),
                _vm._v(" "),
                _vm._l(_vm.getResultQuestions, function(question, index) {
                  return _c("div", [
                    _c("h3", [
                      _vm._v(_vm._s(index + 1) + ". " + _vm._s(question.title))
                    ]),
                    _vm._v(" "),
                    _c("p", { staticClass: "sz-display-new-lines" }, [
                      _vm._v(_vm._s(question.description))
                    ]),
                    _vm._v(" "),
                    _vm.hasGrade(question) === false
                      ? _c("p", { staticClass: "alert alert-info" }, [
                          _vm._v(
                            _vm._s(_vm.$t("task-is-pending-an-evaluation"))
                          )
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.isOneCorrectAnswer(question) ||
                    _vm.isMultipleCorrectAnswers(question)
                      ? _c(
                          "div",
                          _vm._l(question.options, function(option) {
                            return _c(
                              "ul",
                              { staticClass: "media-list sz-options-list" },
                              [
                                _c("li", { staticClass: "media sz-option" }, [
                                  option.image_url
                                    ? _c("div", { staticClass: "media-left" }, [
                                        _c("img", {
                                          staticClass: "media-object",
                                          attrs: {
                                            src: option.image_url,
                                            alt: "option-image"
                                          }
                                        })
                                      ])
                                    : _vm._e(),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "media-body" }, [
                                    _c(
                                      "h4",
                                      {
                                        staticClass: "media-heading",
                                        class: {
                                          selected: _vm.choseOption(
                                            question,
                                            option
                                          )
                                        }
                                      },
                                      [_vm._v(_vm._s(option.option))]
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    { staticClass: "media-right media-middle" },
                                    [
                                      _c("i", {
                                        staticClass: "mdi",
                                        class: _vm.optionIconClass(
                                          question,
                                          option
                                        ),
                                        attrs: { "aria-hidden": "true" }
                                      })
                                    ]
                                  )
                                ])
                              ]
                            )
                          }),
                          0
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.isEmbeddedContent(question)
                      ? _c("div", [
                          _c("div", {
                            staticClass:
                              "embed-responsive embed-responsive-16by9",
                            domProps: {
                              innerHTML: _vm._s(question.embedded_content)
                            }
                          })
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.isFreeformAnswer(question) ||
                    _vm.isEmbeddedContent(question)
                      ? _c("div", [
                          _vm.hasText(question)
                            ? _c(
                                "div",
                                {
                                  staticClass:
                                    "well well-sm sz-display-new-lines"
                                },
                                [_vm._v(_vm._s(_vm.getText(question)))]
                              )
                            : _vm._e()
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.isMissingWord(question)
                      ? _c("div", [
                          _vm.hasText(question)
                            ? _c("div", {
                                staticClass:
                                  "well well-sm sz-display-new-lines missing-word-container",
                                domProps: {
                                  innerHTML: _vm._s(
                                    _vm.getMissingWordText(question)
                                  )
                                }
                              })
                            : _vm._e()
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.isMatchPairs(question)
                      ? _c(
                          "div",
                          { staticClass: "sz-pairs-list" },
                          _vm._l(question.pairs, function(pair) {
                            return _c("div", { staticClass: "row" }, [
                              _c("div", { staticClass: "col-xs-6" }, [
                                _c("div", { staticClass: "media sz-pair" }, [
                                  _c("div", { staticClass: "media-left" }, [
                                    pair.image_url
                                      ? _c("img", {
                                          staticClass: "media-object",
                                          attrs: {
                                            src: pair.image_url,
                                            alt: "pair-image"
                                          }
                                        })
                                      : _vm._e()
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "media-body" }, [
                                    _c("h4", { staticClass: "media-heading" }, [
                                      _vm._v(_vm._s(pair.option))
                                    ])
                                  ])
                                ])
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "col-xs-6" }, [
                                _c("div", { staticClass: "media sz-pair" }, [
                                  _c("div", { staticClass: "media-left" }, [
                                    pair.image_match_url
                                      ? _c("img", {
                                          staticClass: "media-object",
                                          attrs: {
                                            src: pair.image_match_url,
                                            alt: "pair-image"
                                          }
                                        })
                                      : _vm._e()
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "media-body" }, [
                                    _c("h4", { staticClass: "media-heading" }, [
                                      _vm._v(_vm._s(pair.option_match))
                                    ])
                                  ])
                                ])
                              ])
                            ])
                          }),
                          0
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.isPhoto(question)
                      ? _c("div", { staticClass: "sz-photo" }, [
                          _vm.hasImage(question)
                            ? _c("div", { staticClass: "well well-sm" }, [
                                _c("img", {
                                  staticClass: "img-responsive center-block",
                                  attrs: {
                                    alt: "uploaded-image",
                                    src: _vm.getImage(question)
                                  }
                                })
                              ])
                            : _vm._e()
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _c("div", [
                      question.read_more
                        ? _c(
                            "a",
                            {
                              staticClass: "btn btn-default btn-sm",
                              attrs: {
                                href: "",
                                href: question.read_more,
                                target: "_blank"
                              }
                            },
                            [
                              _c("i", {
                                staticClass: "mdi mdi-open-in-new",
                                attrs: { "aria-hidden": "true" }
                              }),
                              _vm._v(
                                "\n                            " +
                                  _vm._s(_vm.$t("read-more-about")) +
                                  "\n                        "
                              )
                            ]
                          )
                        : _vm._e()
                    ])
                  ])
                })
              ],
              2
            ),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-default",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      return _vm.exit()
                    }
                  }
                },
                [
                  _c("i", {
                    staticClass: "mdi mdi-exit-to-app",
                    attrs: { "aria-hidden": "true" }
                  })
                ]
              )
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameTutorialModal.vue?vue&type=template&id=deac8114&":
/*!****************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameTutorialModal.vue?vue&type=template&id=deac8114& ***!
  \****************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog" },
      on: {
        click: function($event) {
          if ($event.target !== $event.currentTarget) {
            return null
          }
          return _vm.close()
        },
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.close()
        }
      }
    },
    [
      _c(
        "div",
        {
          staticClass: "modal-dialog modal-lg sz-game-tips-dialog",
          attrs: { role: "document" }
        },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: { type: "button", "aria-label": "Close" },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title text-center" }, [
                _vm._v(_vm._s(_vm.$t("tips-text")))
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _c(
                "div",
                { ref: "tips", staticClass: "tips" },
                [
                  _c(
                    "transition",
                    {
                      attrs: {
                        name: "tip-side",
                        mode: "out-in",
                        "enter-active-class": _vm.enterActiveClass,
                        "leave-active-class": _vm.leaveActiveClass
                      }
                    },
                    [
                      _vm.currentItem === "gameplay_instructions"
                        ? _c(
                            "div",
                            {
                              key: "gameplay_instructions",
                              staticClass: "tip"
                            },
                            [
                              _c("div", { staticClass: "tip-image" }, [
                                _c("img", {
                                  staticClass: "img-responsive center-block",
                                  attrs: {
                                    alt: "image",
                                    src: _vm.getItemImageUrl(
                                      "gameplay_instructions",
                                      "png"
                                    )
                                  }
                                })
                              ]),
                              _vm._v(" "),
                              _c("h4", { staticClass: "text-center" }, [
                                _vm._v(
                                  _vm._s(
                                    _vm.$t("items.gameplay_instructions.title")
                                  )
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "text-center" }, [
                                _vm._v(
                                  _vm._s(
                                    _vm.$t(
                                      "items.gameplay_instructions.description"
                                    )
                                  )
                                )
                              ])
                            ]
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.currentItem === "look_closely"
                        ? _c(
                            "div",
                            { key: "look_closely", staticClass: "tip" },
                            [
                              _c("div", { staticClass: "tip-image" }, [
                                _c("img", {
                                  staticClass: "img-responsive center-block",
                                  attrs: {
                                    alt: "image",
                                    src: _vm.getItemImageUrl("look_closely")
                                  }
                                })
                              ]),
                              _vm._v(" "),
                              _c("h4", { staticClass: "text-center" }, [
                                _vm._v(
                                  _vm._s(_vm.$t("items.look_closely.title"))
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "text-center" }, [
                                _vm._v(
                                  _vm._s(
                                    _vm.$t("items.look_closely.description")
                                  )
                                )
                              ])
                            ]
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.currentItem === "look_out"
                        ? _c("div", { key: "look_out", staticClass: "tip" }, [
                            _c("div", { staticClass: "tip-image" }, [
                              _c("img", {
                                staticClass: "img-responsive center-block",
                                attrs: {
                                  alt: "image",
                                  src: _vm.getItemImageUrl("look_out")
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("h4", { staticClass: "text-center" }, [
                              _vm._v(_vm._s(_vm.$t("items.look_out.title")))
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "text-center" }, [
                              _vm._v(
                                _vm._s(_vm.$t("items.look_out.description"))
                              )
                            ])
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.currentItem === "do_not_disturb"
                        ? _c(
                            "div",
                            { key: "do_not_disturb", staticClass: "tip" },
                            [
                              _c("div", { staticClass: "tip-image" }, [
                                _c("img", {
                                  staticClass: "img-responsive center-block",
                                  attrs: {
                                    alt: "image",
                                    src: _vm.getItemImageUrl("do_not_disturb")
                                  }
                                })
                              ]),
                              _vm._v(" "),
                              _c("h4", { staticClass: "text-center" }, [
                                _vm._v(
                                  _vm._s(_vm.$t("items.do_not_disturb.title"))
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "text-center" }, [
                                _vm._v(
                                  _vm._s(
                                    _vm.$t("items.do_not_disturb.description")
                                  )
                                )
                              ])
                            ]
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.currentItem === "help_others"
                        ? _c(
                            "div",
                            { key: "help_others", staticClass: "tip" },
                            [
                              _c("div", { staticClass: "tip-image" }, [
                                _c("img", {
                                  staticClass: "img-responsive center-block",
                                  attrs: {
                                    alt: "image",
                                    src: _vm.getItemImageUrl("help_others")
                                  }
                                })
                              ]),
                              _vm._v(" "),
                              _c("h4", { staticClass: "text-center" }, [
                                _vm._v(
                                  _vm._s(_vm.$t("items.help_others.title"))
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "text-center" }, [
                                _vm._v(
                                  _vm._s(
                                    _vm.$t("items.help_others.description")
                                  )
                                )
                              ])
                            ]
                          )
                        : _vm._e()
                    ]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "ul",
                { staticClass: "text-center slides" },
                _vm._l(_vm.items, function(item) {
                  return _c("li", [
                    _c(
                      "span",
                      {
                        class: {
                          badge: true,
                          current: item === _vm.currentItem
                        }
                      },
                      [_vm._v(" ")]
                    )
                  ])
                }),
                0
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              !_vm.isFirstItem()
                ? _c(
                    "button",
                    {
                      staticClass: "btn btn-default btn-lg pull-left",
                      attrs: { type: "button", disabled: !_vm.currentItem },
                      on: {
                        click: function($event) {
                          return _vm.previousItem()
                        }
                      }
                    },
                    [_vm._v(_vm._s(_vm.$t("back")))]
                  )
                : _vm._e(),
              _vm._v(" "),
              !_vm.isLastItem()
                ? _c(
                    "button",
                    {
                      staticClass: "btn btn-success btn-lg pull-right",
                      attrs: { type: "button", disabled: !_vm.currentItem },
                      on: {
                        click: function($event) {
                          return _vm.nextItem()
                        }
                      }
                    },
                    [_vm._v(_vm._s(_vm.$t("next")))]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.isLastItem()
                ? _c(
                    "button",
                    {
                      staticClass: "btn btn-success btn-lg pull-right",
                      attrs: { type: "button", disabled: !_vm.currentItem },
                      on: {
                        click: function($event) {
                          return _vm.close()
                        }
                      }
                    },
                    [_vm._v(_vm._s(_vm.$t("got-it")))]
                  )
                : _vm._e()
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/NotificationModal.vue?vue&type=template&id=11b58b4a&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/NotificationModal.vue?vue&type=template&id=11b58b4a&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      ref: "modal",
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog" },
      on: {
        click: function($event) {
          if ($event.target !== $event.currentTarget) {
            return null
          }
          return _vm.close()
        },
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.close()
        }
      }
    },
    [
      _c(
        "div",
        { staticClass: "modal-dialog modal-sm", attrs: { role: "document" } },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: {
                    type: "button",
                    "aria-label": "Close",
                    diabled: _vm.inAjaxCall
                  },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [
                  _c("span", { attrs: { "aria-hidden": "true" } }, [
                    _vm._v("×")
                  ])
                ]
              ),
              _vm._v(" "),
              _c("h4", { staticClass: "modal-title" }, [
                _vm._v(_vm._s(_vm.title))
              ])
            ]),
            _vm._v(" "),
            _c("div", {
              staticClass: "modal-body",
              domProps: { innerHTML: _vm._s(_vm.message) }
            }),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-sm btn-success center-block",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      return _vm.close()
                    }
                  }
                },
                [_vm._v("\n                    OK\n                ")]
              )
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameMap.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css& */ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css& */ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameRatingModal.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader/dist/cjs.js??ref--6-1!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameResultsModal.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/lib/addStyles.js":
/*!****************************************************!*\
  !*** ./node_modules/style-loader/lib/addStyles.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/

var stylesInDom = {};

var	memoize = function (fn) {
	var memo;

	return function () {
		if (typeof memo === "undefined") memo = fn.apply(this, arguments);
		return memo;
	};
};

var isOldIE = memoize(function () {
	// Test for IE <= 9 as proposed by Browserhacks
	// @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
	// Tests for existence of standard globals is to allow style-loader
	// to operate correctly into non-standard environments
	// @see https://github.com/webpack-contrib/style-loader/issues/177
	return window && document && document.all && !window.atob;
});

var getTarget = function (target, parent) {
  if (parent){
    return parent.querySelector(target);
  }
  return document.querySelector(target);
};

var getElement = (function (fn) {
	var memo = {};

	return function(target, parent) {
                // If passing function in options, then use it for resolve "head" element.
                // Useful for Shadow Root style i.e
                // {
                //   insertInto: function () { return document.querySelector("#foo").shadowRoot }
                // }
                if (typeof target === 'function') {
                        return target();
                }
                if (typeof memo[target] === "undefined") {
			var styleTarget = getTarget.call(this, target, parent);
			// Special case to return head of iframe instead of iframe itself
			if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
				try {
					// This will throw an exception if access to iframe is blocked
					// due to cross-origin restrictions
					styleTarget = styleTarget.contentDocument.head;
				} catch(e) {
					styleTarget = null;
				}
			}
			memo[target] = styleTarget;
		}
		return memo[target]
	};
})();

var singleton = null;
var	singletonCounter = 0;
var	stylesInsertedAtTop = [];

var	fixUrls = __webpack_require__(/*! ./urls */ "./node_modules/style-loader/lib/urls.js");

module.exports = function(list, options) {
	if (typeof DEBUG !== "undefined" && DEBUG) {
		if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};

	options.attrs = typeof options.attrs === "object" ? options.attrs : {};

	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (!options.singleton && typeof options.singleton !== "boolean") options.singleton = isOldIE();

	// By default, add <style> tags to the <head> element
        if (!options.insertInto) options.insertInto = "head";

	// By default, add <style> tags to the bottom of the target
	if (!options.insertAt) options.insertAt = "bottom";

	var styles = listToStyles(list, options);

	addStylesToDom(styles, options);

	return function update (newList) {
		var mayRemove = [];

		for (var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];

			domStyle.refs--;
			mayRemove.push(domStyle);
		}

		if(newList) {
			var newStyles = listToStyles(newList, options);
			addStylesToDom(newStyles, options);
		}

		for (var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];

			if(domStyle.refs === 0) {
				for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();

				delete stylesInDom[domStyle.id];
			}
		}
	};
};

function addStylesToDom (styles, options) {
	for (var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];

		if(domStyle) {
			domStyle.refs++;

			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}

			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];

			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}

			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles (list, options) {
	var styles = [];
	var newStyles = {};

	for (var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = options.base ? item[0] + options.base : item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};

		if(!newStyles[id]) styles.push(newStyles[id] = {id: id, parts: [part]});
		else newStyles[id].parts.push(part);
	}

	return styles;
}

function insertStyleElement (options, style) {
	var target = getElement(options.insertInto)

	if (!target) {
		throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
	}

	var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];

	if (options.insertAt === "top") {
		if (!lastStyleElementInsertedAtTop) {
			target.insertBefore(style, target.firstChild);
		} else if (lastStyleElementInsertedAtTop.nextSibling) {
			target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			target.appendChild(style);
		}
		stylesInsertedAtTop.push(style);
	} else if (options.insertAt === "bottom") {
		target.appendChild(style);
	} else if (typeof options.insertAt === "object" && options.insertAt.before) {
		var nextSibling = getElement(options.insertAt.before, target);
		target.insertBefore(style, nextSibling);
	} else {
		throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");
	}
}

function removeStyleElement (style) {
	if (style.parentNode === null) return false;
	style.parentNode.removeChild(style);

	var idx = stylesInsertedAtTop.indexOf(style);
	if(idx >= 0) {
		stylesInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement (options) {
	var style = document.createElement("style");

	if(options.attrs.type === undefined) {
		options.attrs.type = "text/css";
	}

	if(options.attrs.nonce === undefined) {
		var nonce = getNonce();
		if (nonce) {
			options.attrs.nonce = nonce;
		}
	}

	addAttrs(style, options.attrs);
	insertStyleElement(options, style);

	return style;
}

function createLinkElement (options) {
	var link = document.createElement("link");

	if(options.attrs.type === undefined) {
		options.attrs.type = "text/css";
	}
	options.attrs.rel = "stylesheet";

	addAttrs(link, options.attrs);
	insertStyleElement(options, link);

	return link;
}

function addAttrs (el, attrs) {
	Object.keys(attrs).forEach(function (key) {
		el.setAttribute(key, attrs[key]);
	});
}

function getNonce() {
	if (false) {}

	return __webpack_require__.nc;
}

function addStyle (obj, options) {
	var style, update, remove, result;

	// If a transform function was defined, run it on the css
	if (options.transform && obj.css) {
	    result = typeof options.transform === 'function'
		 ? options.transform(obj.css) 
		 : options.transform.default(obj.css);

	    if (result) {
	    	// If transform returns a value, use that instead of the original css.
	    	// This allows running runtime transformations on the css.
	    	obj.css = result;
	    } else {
	    	// If the transform function returns a falsy value, don't add this css.
	    	// This allows conditional loading of css
	    	return function() {
	    		// noop
	    	};
	    }
	}

	if (options.singleton) {
		var styleIndex = singletonCounter++;

		style = singleton || (singleton = createStyleElement(options));

		update = applyToSingletonTag.bind(null, style, styleIndex, false);
		remove = applyToSingletonTag.bind(null, style, styleIndex, true);

	} else if (
		obj.sourceMap &&
		typeof URL === "function" &&
		typeof URL.createObjectURL === "function" &&
		typeof URL.revokeObjectURL === "function" &&
		typeof Blob === "function" &&
		typeof btoa === "function"
	) {
		style = createLinkElement(options);
		update = updateLink.bind(null, style, options);
		remove = function () {
			removeStyleElement(style);

			if(style.href) URL.revokeObjectURL(style.href);
		};
	} else {
		style = createStyleElement(options);
		update = applyToTag.bind(null, style);
		remove = function () {
			removeStyleElement(style);
		};
	}

	update(obj);

	return function updateStyle (newObj) {
		if (newObj) {
			if (
				newObj.css === obj.css &&
				newObj.media === obj.media &&
				newObj.sourceMap === obj.sourceMap
			) {
				return;
			}

			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;

		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag (style, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (style.styleSheet) {
		style.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = style.childNodes;

		if (childNodes[index]) style.removeChild(childNodes[index]);

		if (childNodes.length) {
			style.insertBefore(cssNode, childNodes[index]);
		} else {
			style.appendChild(cssNode);
		}
	}
}

function applyToTag (style, obj) {
	var css = obj.css;
	var media = obj.media;

	if(media) {
		style.setAttribute("media", media)
	}

	if(style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		while(style.firstChild) {
			style.removeChild(style.firstChild);
		}

		style.appendChild(document.createTextNode(css));
	}
}

function updateLink (link, options, obj) {
	var css = obj.css;
	var sourceMap = obj.sourceMap;

	/*
		If convertToAbsoluteUrls isn't defined, but sourcemaps are enabled
		and there is no publicPath defined then lets turn convertToAbsoluteUrls
		on by default.  Otherwise default to the convertToAbsoluteUrls option
		directly
	*/
	var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;

	if (options.convertToAbsoluteUrls || autoFixUrls) {
		css = fixUrls(css);
	}

	if (sourceMap) {
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	var blob = new Blob([css], { type: "text/css" });

	var oldSrc = link.href;

	link.href = URL.createObjectURL(blob);

	if(oldSrc) URL.revokeObjectURL(oldSrc);
}


/***/ }),

/***/ "./node_modules/style-loader/lib/urls.js":
/*!***********************************************!*\
  !*** ./node_modules/style-loader/lib/urls.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {


/**
 * When source maps are enabled, `style-loader` uses a link element with a data-uri to
 * embed the css on the page. This breaks all relative urls because now they are relative to a
 * bundle instead of the current page.
 *
 * One solution is to only use full urls, but that may be impossible.
 *
 * Instead, this function "fixes" the relative urls to be absolute according to the current page location.
 *
 * A rudimentary test suite is located at `test/fixUrls.js` and can be run via the `npm test` command.
 *
 */

module.exports = function (css) {
  // get current location
  var location = typeof window !== "undefined" && window.location;

  if (!location) {
    throw new Error("fixUrls requires window.location");
  }

	// blank or null?
	if (!css || typeof css !== "string") {
	  return css;
  }

  var baseUrl = location.protocol + "//" + location.host;
  var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");

	// convert each url(...)
	/*
	This regular expression is just a way to recursively match brackets within
	a string.

	 /url\s*\(  = Match on the word "url" with any whitespace after it and then a parens
	   (  = Start a capturing group
	     (?:  = Start a non-capturing group
	         [^)(]  = Match anything that isn't a parentheses
	         |  = OR
	         \(  = Match a start parentheses
	             (?:  = Start another non-capturing groups
	                 [^)(]+  = Match anything that isn't a parentheses
	                 |  = OR
	                 \(  = Match a start parentheses
	                     [^)(]*  = Match anything that isn't a parentheses
	                 \)  = Match a end parentheses
	             )  = End Group
              *\) = Match anything and then a close parens
          )  = Close non-capturing group
          *  = Match anything
       )  = Close capturing group
	 \)  = Match a close parens

	 /gi  = Get all matches, not the first.  Be case insensitive.
	 */
	var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
		// strip quotes (if they exist)
		var unquotedOrigUrl = origUrl
			.trim()
			.replace(/^"(.*)"$/, function(o, $1){ return $1; })
			.replace(/^'(.*)'$/, function(o, $1){ return $1; });

		// already a full url? no change
		if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(unquotedOrigUrl)) {
		  return fullMatch;
		}

		// convert the url to a full url
		var newUrl;

		if (unquotedOrigUrl.indexOf("//") === 0) {
		  	//TODO: should we add protocol?
			newUrl = unquotedOrigUrl;
		} else if (unquotedOrigUrl.indexOf("/") === 0) {
			// path should be relative to the base url
			newUrl = baseUrl + unquotedOrigUrl; // already starts with '/'
		} else {
			// path should be relative to current directory
			newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, ""); // Strip leading './'
		}

		// send back the fixed url(...)
		return "url(" + JSON.stringify(newUrl) + ")";
	});

	// send back the fixed css
	return fixedCss;
};


/***/ }),

/***/ "./node_modules/vue-i18n/dist/vue-i18n.common.js":
/*!*******************************************************!*\
  !*** ./node_modules/vue-i18n/dist/vue-i18n.common.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/*!
 * vue-i18n v5.0.3 
 * (c) 2017 kazuya kawaguchi
 * Released under the MIT License.
 */


/**
 * warn
 *
 * @param {String} msg
 * @param {Error} [err]
 *
 */

function warn (msg, err) {
  if (window.console) {
    console.warn('[vue-i18n] ' + msg);
    if (err) {
      console.warn(err.stack);
    }
  }
}

var Asset = function (Vue, langVM) {
  /**
   * Register or retrieve a global locale definition.
   *
   * @param {String} id
   * @param {Object | Function | Promise} definition
   * @param {Function} cb
   */

  Vue.locale = function (id, definition, cb) {
    if (definition === undefined) { // getter
      return langVM.locales[id]
    } else { // setter
      if (definition === null) {
        langVM.locales[id] = undefined;
        delete langVM.locales[id];
      } else {
        setLocale(id, definition, function (locale) {
          if (locale) {
            langVM.$set(langVM.locales, id, locale);
          } else {
            warn('failed set `' + id + '` locale');
          }
          cb && cb();
        });
      }
    }
  };
};


function setLocale (id, definition, cb) {
  if (typeof definition === 'object') { // sync
    cb(definition);
  } else {
    var future = definition.call(this);
    if (typeof future === 'function') {
      if (future.resolved) {
        // cached
        cb(future.resolved);
      } else if (future.requested) {
        // pool callbacks
        future.pendingCallbacks.push(cb);
      } else {
        future.requested = true;
        var cbs = future.pendingCallbacks = [cb];
        future(function (locale) { // resolve
          future.resolved = locale;
          for (var i = 0, l = cbs.length; i < l; i++) {
            cbs[i](locale);
          }
        }, function () { // reject
          cb();
        });
      }
    } else if (isPromise(future)) { // promise
      future.then(function (locale) { // resolve
        cb(locale);
      }, function () { // reject
        cb();
      }).catch(function (err) {
        console.error(err);
        cb();
      });
    }
  }
}

/**
 * Forgiving check for a promise
 *
 * @param {Object} p
 * @return {Boolean}
 */

function isPromise (p) {
  return p && typeof p.then === 'function'
}

var Override = function (Vue, langVM) {
  // override _init
  var init = Vue.prototype._init;
  Vue.prototype._init = function (options) {
    var this$1 = this;

    init.call(this, options);

    if (!this.$parent) { // root
      this._$lang = langVM;
      this._langUnwatch = this._$lang.$watch('$data', function (val, old) {
        this$1.$forceUpdate();
      }, { deep: true });
    }
  };

  // override _destroy
  var destroy = Vue.prototype._destroy;
  Vue.prototype._destroy = function () {
    if (!this.$parent && this._langUnwatch) {
      this._langUnwatch();
      this._langUnwatch = null;
      this._$lang = null;
    }

    destroy.apply(this, arguments);
  };
};

/**
 * Observer
 */

var Watcher;
/**
 * getWatcher
 *
 * @param {Vue} vm
 * @return {Watcher}
 */

function getWatcher (vm) {
  if (!Watcher) {
    var unwatch = vm.$watch('__watcher__', function (a) {});
    Watcher = vm._watchers[0].constructor;
    unwatch();
  }
  return Watcher
}

var Dep;
/**
 * getDep
 *
 * @param {Vue} vm
 * @return {Dep}
 */

function getDep (vm) {
  if (!Dep && vm && vm._data && vm._data.__ob__ && vm._data.__ob__.dep) {
    Dep = vm._data.__ob__.dep.constructor;
  }
  return Dep
}

/**
 * utilites
 */

/**
 * isNil
 *
 * @param {*} val
 * @return Boolean
 */
function isNil (val) {
  return val === null || val === undefined
}

/**
 * Simple bind, faster than native
 *
 * @param {Function} fn
 * @param {Object} ctx
 * @return Function
 */
function bind (fn, ctx) {
  function boundFn (a) {
    var l = arguments.length;
    return l
      ? l > 1
        ? fn.apply(ctx, arguments)
        : fn.call(ctx, a)
      : fn.call(ctx)
  }
  // record original fn length
  boundFn._length = fn.length;
  return boundFn
}

/**
 * Quick object check - this is primarily used to tell
 * Objects from primitive values when we know the value
 * is a JSON-compliant type.
 *
 * @param {Object} obj
 * @return Boolean
 */
function isObject (obj) {
  return obj !== null && typeof obj === 'object'
}

/**
 * Strict object type check. Only returns true
 * for plain JavaScript objects.
 *
 * @param {Object} obj
 * @return Boolean
 */
var toString = Object.prototype.toString;
var OBJECT_STRING = '[object Object]';
function isPlainObject (obj) {
  return toString.call(obj) === OBJECT_STRING
}

/**
 * Check whether the object has the property.
 *
 * @param {Object} obj
 * @param {String} key
 * @return Boolean
 */
var hasOwnProperty = Object.prototype.hasOwnProperty;
function hasOwn (obj, key) {
  return hasOwnProperty.call(obj, key)
}

var fallback; // fallback lang
var missingHandler = null; // missing handler
var i18nFormatter = null; // custom formatter

var Config = function (Vue, langVM, lang) {
  var Watcher = getWatcher(langVM);
  var Dep = getDep(langVM);

  function makeComputedGetter (getter, owner) {
    var watcher = new Watcher(owner, getter, null, {
      lazy: true
    });

    return function computedGetter () {
      watcher.dirty && watcher.evaluate();
      Dep && Dep.target && watcher.depend();
      return watcher.value
    }
  }

  // define Vue.config.lang configration
  Object.defineProperty(Vue.config, 'lang', {
    enumerable: true,
    configurable: true,
    get: makeComputedGetter(function () { return langVM.lang }, langVM),
    set: bind(function (val) { langVM.lang = val; }, langVM)
  });

  // define Vue.config.fallbackLang configration
  fallback = lang;
  Object.defineProperty(Vue.config, 'fallbackLang', {
    enumerable: true,
    configurable: true,
    get: function () { return fallback },
    set: function (val) { fallback = val; }
  });

  // define Vue.config.missingHandler configration
  Object.defineProperty(Vue.config, 'missingHandler', {
    enumerable: true,
    configurable: true,
    get: function () { return missingHandler },
    set: function (val) { missingHandler = val; }
  });

  // define Vue.config.i18Formatter configration
  Object.defineProperty(Vue.config, 'i18nFormatter', {
    enumerable: true,
    configurable: true,
    get: function () { return i18nFormatter },
    set: function (val) { i18nFormatter = val; }
  });
};

/**
 *  String format template
 *  - Inspired:
 *    https://github.com/Matt-Esch/string-template/index.js
 */

var RE_NARGS = /(%|)\{([0-9a-zA-Z_]+)\}/g;


var Format = function (Vue) {
  /**
   * template
   *
   * @param {String} string
   * @param {Array} ...args
   * @return {String}
   */

  function template (string) {
    var args = [], len = arguments.length - 1;
    while ( len-- > 0 ) args[ len ] = arguments[ len + 1 ];

    if (args.length === 1 && typeof args[0] === 'object') {
      args = args[0];
    } else {
      args = {};
    }

    if (!args || !args.hasOwnProperty) {
      args = {};
    }

    return string.replace(RE_NARGS, function (match, prefix, i, index) {
      var result;

      if (string[index - 1] === '{' &&
        string[index + match.length] === '}') {
        return i
      } else {
        result = hasOwn(args, i) ? args[i] : match;
        if (isNil(result)) {
          return ''
        }

        return result
      }
    })
  }

  return template
};

/**
 *  Path paerser
 *  - Inspired:
 *    Vue.js Path parser
 */

// cache
var pathCache = Object.create(null);

// actions
var APPEND = 0;
var PUSH = 1;
var INC_SUB_PATH_DEPTH = 2;
var PUSH_SUB_PATH = 3;

// states
var BEFORE_PATH = 0;
var IN_PATH = 1;
var BEFORE_IDENT = 2;
var IN_IDENT = 3;
var IN_SUB_PATH = 4;
var IN_SINGLE_QUOTE = 5;
var IN_DOUBLE_QUOTE = 6;
var AFTER_PATH = 7;
var ERROR = 8;

var pathStateMachine = [];

pathStateMachine[BEFORE_PATH] = {
  'ws': [BEFORE_PATH],
  'ident': [IN_IDENT, APPEND],
  '[': [IN_SUB_PATH],
  'eof': [AFTER_PATH]
};

pathStateMachine[IN_PATH] = {
  'ws': [IN_PATH],
  '.': [BEFORE_IDENT],
  '[': [IN_SUB_PATH],
  'eof': [AFTER_PATH]
};

pathStateMachine[BEFORE_IDENT] = {
  'ws': [BEFORE_IDENT],
  'ident': [IN_IDENT, APPEND],
  '0': [IN_IDENT, APPEND],
  'number': [IN_IDENT, APPEND]
};

pathStateMachine[IN_IDENT] = {
  'ident': [IN_IDENT, APPEND],
  '0': [IN_IDENT, APPEND],
  'number': [IN_IDENT, APPEND],
  'ws': [IN_PATH, PUSH],
  '.': [BEFORE_IDENT, PUSH],
  '[': [IN_SUB_PATH, PUSH],
  'eof': [AFTER_PATH, PUSH]
};

pathStateMachine[IN_SUB_PATH] = {
  "'": [IN_SINGLE_QUOTE, APPEND],
  '"': [IN_DOUBLE_QUOTE, APPEND],
  '[': [IN_SUB_PATH, INC_SUB_PATH_DEPTH],
  ']': [IN_PATH, PUSH_SUB_PATH],
  'eof': ERROR,
  'else': [IN_SUB_PATH, APPEND]
};

pathStateMachine[IN_SINGLE_QUOTE] = {
  "'": [IN_SUB_PATH, APPEND],
  'eof': ERROR,
  'else': [IN_SINGLE_QUOTE, APPEND]
};

pathStateMachine[IN_DOUBLE_QUOTE] = {
  '"': [IN_SUB_PATH, APPEND],
  'eof': ERROR,
  'else': [IN_DOUBLE_QUOTE, APPEND]
};

/**
 * Check if an expression is a literal value.
 *
 * @param {String} exp
 * @return {Boolean}
 */

var literalValueRE = /^\s?(true|false|-?[\d.]+|'[^']*'|"[^"]*")\s?$/;
function isLiteral (exp) {
  return literalValueRE.test(exp)
}

/**
 * Strip quotes from a string
 *
 * @param {String} str
 * @return {String | false}
 */

function stripQuotes (str) {
  var a = str.charCodeAt(0);
  var b = str.charCodeAt(str.length - 1);
  return a === b && (a === 0x22 || a === 0x27)
    ? str.slice(1, -1)
    : str
}

/**
 * Determine the type of a character in a keypath.
 *
 * @param {Char} ch
 * @return {String} type
 */

function getPathCharType (ch) {
  if (ch === undefined) { return 'eof' }

  var code = ch.charCodeAt(0);

  switch (code) {
    case 0x5B: // [
    case 0x5D: // ]
    case 0x2E: // .
    case 0x22: // "
    case 0x27: // '
    case 0x30: // 0
      return ch

    case 0x5F: // _
    case 0x24: // $
    case 0x2D: // -
      return 'ident'

    case 0x20: // Space
    case 0x09: // Tab
    case 0x0A: // Newline
    case 0x0D: // Return
    case 0xA0:  // No-break space
    case 0xFEFF:  // Byte Order Mark
    case 0x2028:  // Line Separator
    case 0x2029:  // Paragraph Separator
      return 'ws'
  }

  // a-z, A-Z
  if ((code >= 0x61 && code <= 0x7A) || (code >= 0x41 && code <= 0x5A)) {
    return 'ident'
  }

  // 1-9
  if (code >= 0x31 && code <= 0x39) { return 'number' }

  return 'else'
}

/**
 * Format a subPath, return its plain form if it is
 * a literal string or number. Otherwise prepend the
 * dynamic indicator (*).
 *
 * @param {String} path
 * @return {String}
 */

function formatSubPath (path) {
  var trimmed = path.trim();
  // invalid leading 0
  if (path.charAt(0) === '0' && isNaN(path)) { return false }

  return isLiteral(trimmed) ? stripQuotes(trimmed) : '*' + trimmed
}

/**
 * Parse a string path into an array of segments
 *
 * @param {String} path
 * @return {Array|undefined}
 */

function parse (path) {
  var keys = [];
  var index = -1;
  var mode = BEFORE_PATH;
  var subPathDepth = 0;
  var c, newChar, key, type, transition, action, typeMap;

  var actions = [];

  actions[PUSH] = function () {
    if (key !== undefined) {
      keys.push(key);
      key = undefined;
    }
  };

  actions[APPEND] = function () {
    if (key === undefined) {
      key = newChar;
    } else {
      key += newChar;
    }
  };

  actions[INC_SUB_PATH_DEPTH] = function () {
    actions[APPEND]();
    subPathDepth++;
  };

  actions[PUSH_SUB_PATH] = function () {
    if (subPathDepth > 0) {
      subPathDepth--;
      mode = IN_SUB_PATH;
      actions[APPEND]();
    } else {
      subPathDepth = 0;
      key = formatSubPath(key);
      if (key === false) {
        return false
      } else {
        actions[PUSH]();
      }
    }
  };

  function maybeUnescapeQuote () {
    var nextChar = path[index + 1];
    if ((mode === IN_SINGLE_QUOTE && nextChar === "'") ||
      (mode === IN_DOUBLE_QUOTE && nextChar === '"')) {
      index++;
      newChar = '\\' + nextChar;
      actions[APPEND]();
      return true
    }
  }

  while (mode != null) {
    index++;
    c = path[index];

    if (c === '\\' && maybeUnescapeQuote()) {
      continue
    }

    type = getPathCharType(c);
    typeMap = pathStateMachine[mode];
    transition = typeMap[type] || typeMap['else'] || ERROR;

    if (transition === ERROR) {
      return // parse error
    }

    mode = transition[0];
    action = actions[transition[1]];
    if (action) {
      newChar = transition[2];
      newChar = newChar === undefined
        ? c
        : newChar;
      if (action() === false) {
        return
      }
    }

    if (mode === AFTER_PATH) {
      keys.raw = path;
      return keys
    }
  }
}

/**
 * External parse that check for a cache hit first
 *
 * @param {String} path
 * @return {Array|undefined}
 */

function parsePath (path) {
  var hit = pathCache[path];
  if (!hit) {
    hit = parse(path);
    if (hit) {
      pathCache[path] = hit;
    }
  }
  return hit
}

var Path = function (Vue) {
  function empty (target) {
    if (target === null || target === undefined) { return true }

    if (Array.isArray(target)) {
      if (target.length > 0) { return false }
      if (target.length === 0) { return true }
    } else if (isPlainObject(target)) {
      /* eslint-disable prefer-const */
      for (var key in target) {
        if (hasOwn(target, key)) { return false }
      }
      /* eslint-enable prefer-const */
    }

    return true
  }

  /**
   * Get value from path string
   *
   * @param {Object} obj
   * @param {String} path
   * @return value
   */

  function getValue (obj, path) {
    if (!isObject(obj)) { return null }

    var paths = parsePath(path);
    if (empty(paths)) { return null }

    var length = paths.length;
    var ret = null;
    var last = obj;
    var i = 0;
    while (i < length) {
      var value = last[paths[i]];
      if (value === undefined) {
        last = null;
        break
      }
      last = value;
      i++;
    }

    ret = last;
    return ret
  }

  return getValue
};

/**
 * extend
 *
 * @param {Vue} Vue
 * @return {Vue}
 */

var Extend = function (Vue) {
  var format = Format(Vue);
  var getValue = Path(Vue);

  function parseArgs () {
    var args = [], len = arguments.length;
    while ( len-- ) args[ len ] = arguments[ len ];

    var lang = Vue.config.lang;
    var fallback = Vue.config.fallbackLang;

    if (args.length === 1) {
      if (isObject(args[0]) || Array.isArray(args[0])) {
        args = args[0];
      } else if (typeof args[0] === 'string') {
        lang = args[0];
      }
    } else if (args.length === 2) {
      if (typeof args[0] === 'string') {
        lang = args[0];
      }
      if (isObject(args[1]) || Array.isArray(args[1])) {
        args = args[1];
      }
    }

    return { lang: lang, fallback: fallback, params: args }
  }

  function exist (locale, key) {
    if (!locale || !key) { return false }
    return !isNil(getValue(locale, key))
  }

  function interpolate (locale, key, args) {
    if (!locale) { return null }

    var val = getValue(locale, key);
    if (Array.isArray(val)) { return val }
    if (isNil(val)) { val = locale[key]; }
    if (isNil(val)) { return null }
    if (typeof val !== 'string') { warn("Value of key '" + key + "' is not a string!"); return null }

    // Check for the existance of links within the translated string
    if (val.indexOf('@:') >= 0) {
      // Match all the links within the local
      // We are going to replace each of
      // them with its translation
      var matches = val.match(/(@:[\w|.]+)/g);
      for (var idx in matches) {
        var link = matches[idx];
        // Remove the leading @:
        var linkPlaceholder = link.substr(2);
        // Translate the link
        var translatedstring = interpolate(locale, linkPlaceholder, args);
        // Replace the link with the translated string
        val = val.replace(link, translatedstring);
      }
    }

    return !args
      ? val
      : Vue.config.i18nFormatter
        ? Vue.config.i18nFormatter.apply(null, [val].concat(args))
        : format(val, args)
  }

  function translate (getter, lang, fallback, key, params) {
    var res = null;
    res = interpolate(getter(lang), key, params);
    if (!isNil(res)) { return res }

    res = interpolate(getter(fallback), key, params);
    if (!isNil(res)) {
      if (true) {
        warn('Fall back to translate the keypath "' + key + '" with "' +
          fallback + '" language.');
      }
      return res
    } else {
      return null
    }
  }


  function warnDefault (lang, key, vm, result) {
    if (!isNil(result)) { return result }
    if (Vue.config.missingHandler) {
      Vue.config.missingHandler.apply(null, [lang, key, vm]);
    } else {
      if (true) {
        warn('Cannot translate the value of keypath "' + key + '". ' +
          'Use the value of keypath as default');
      }
    }
    return key
  }

  function getAssetLocale (lang) {
    return Vue.locale(lang)
  }

  function getComponentLocale (lang) {
    return this.$options.locales[lang]
  }

  function getOldChoiceIndexFixed (choice) {
    return choice ? choice > 1 ? 1 : 0 : 1
  }

  function getChoiceIndex (choice, choicesLength) {
    choice = Math.abs(choice);

    if (choicesLength === 2) { return getOldChoiceIndexFixed(choice) }

    return choice ? Math.min(choice, 2) : 0
  }

  function fetchChoice (locale, choice) {
    if (!locale && typeof locale !== 'string') { return null }
    var choices = locale.split('|');

    choice = getChoiceIndex(choice, choices.length);
    if (!choices[choice]) { return locale }
    return choices[choice].trim()
  }

  /**
   * Vue.t
   *
   * @param {String} key
   * @param {Array} ...args
   * @return {String}
   */

  Vue.t = function (key) {
    var args = [], len = arguments.length - 1;
    while ( len-- > 0 ) args[ len ] = arguments[ len + 1 ];

    if (!key) { return '' }
    var ref = parseArgs.apply(void 0, args);
    var lang = ref.lang;
    var fallback = ref.fallback;
    var params = ref.params;
    return warnDefault(lang, key, null, translate(getAssetLocale, lang, fallback, key, params))
  };

  /**
   * Vue.tc
   *
   * @param {String} key
   * @param {number|undefined} choice
   * @param {Array} ...args
   * @return {String}
   */

  Vue.tc = function (key, choice) {
    var args = [], len = arguments.length - 2;
    while ( len-- > 0 ) args[ len ] = arguments[ len + 2 ];

    return fetchChoice(Vue.t.apply(Vue, [ key ].concat( args )), choice)
  };

  /**
   * Vue.te
   *
   * @param {String} key
   * @param {Array} ...args
   * @return {Boolean}
   */

  Vue.te = function (key) {
    var args = [], len = arguments.length - 1;
    while ( len-- > 0 ) args[ len ] = arguments[ len + 1 ];

    var ref = parseArgs.apply(void 0, args);
    var lang = ref.lang;
    return exist(getAssetLocale(lang), key)
  };

  /**
   * $t
   *
   * @param {String} key
   * @param {Array} ...args
   * @return {String}
   */

  Vue.prototype.$t = function (key) {
    var args = [], len = arguments.length - 1;
    while ( len-- > 0 ) args[ len ] = arguments[ len + 1 ];

    if (!key) { return '' }
    var ref = parseArgs.apply(void 0, args);
    var lang = ref.lang;
    var fallback = ref.fallback;
    var params = ref.params;
    var res = null;
    if (this.$options.locales) {
      res = translate(
        bind(getComponentLocale, this), lang, fallback, key, params
      );
      if (res) { return res }
    }
    return warnDefault(lang, key, this, translate(getAssetLocale, lang, fallback, key, params))
  };

  /**
   * $tc
   *
   * @param {String} key
   * @param {number|undefined} choice
   * @param {Array} ...args
   * @return {String}
   */

  Vue.prototype.$tc = function (key, choice) {
    var args = [], len = arguments.length - 2;
    while ( len-- > 0 ) args[ len ] = arguments[ len + 2 ];

    if (typeof choice !== 'number' && typeof choice !== 'undefined') {
      return key
    }
    return fetchChoice((ref = this).$t.apply(ref, [ key ].concat( args )), choice)
    var ref;
  };

  /**
   * $te
   *
   * @param {String} key
   * @param {Array} ...args
   * @return {Boolean}
   *
   */

  Vue.prototype.$te = function (key) {
    var args = [], len = arguments.length - 1;
    while ( len-- > 0 ) args[ len ] = arguments[ len + 1 ];

    var ref = parseArgs.apply(void 0, args);
    var lang = ref.lang;
    var found = false;
    if (this.$options.locales) { // exist component locale
      found = exist(bind(getComponentLocale)(lang), key);
    }
    if (!found) {
      found = exist(getAssetLocale(lang), key);
    }
    return found
  };

  Vue.mixin({
    computed: {
      $lang: function $lang () {
        return Vue.config.lang
      }
    }
  });

  return Vue
};

var langVM; // singleton


/**
 * plugin
 *
 * @param {Object} Vue
 * @param {Object} opts
 */

function plugin (Vue, opts) {
  if ( opts === void 0 ) opts = {};

  var version = (Vue.version && Number(Vue.version.split('.')[0])) || -1;

  if ( true && plugin.installed) {
    warn('already installed.');
    return
  }

  if ( true && version < 2) {
    warn(("vue-i18n (" + (plugin.version) + ") need to use Vue 2.0 or later (Vue: " + (Vue.version) + ")."));
    return
  }

  var lang = 'en';
  setupLangVM(Vue, lang);

  Asset(Vue, langVM);
  Override(Vue, langVM);
  Config(Vue, langVM, lang);
  Extend(Vue);
}

function setupLangVM (Vue, lang) {
  var silent = Vue.config.silent;
  Vue.config.silent = true;
  if (!langVM) {
    langVM = new Vue({ data: { lang: lang, locales: {} } });
  }
  Vue.config.silent = silent;
}

plugin.version = '__VERSION__';

if (typeof window !== 'undefined' && window.Vue) {
  window.Vue.use(plugin);
}

module.exports = plugin;


/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/assets/js/components/GameAccessCodeModal.vue":
/*!****************************************************************!*\
  !*** ./resources/assets/js/components/GameAccessCodeModal.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameAccessCodeModal_vue_vue_type_template_id_04d3a9fa___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameAccessCodeModal.vue?vue&type=template&id=04d3a9fa& */ "./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=template&id=04d3a9fa&");
/* harmony import */ var _GameAccessCodeModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameAccessCodeModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GameAccessCodeModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameAccessCodeModal_vue_vue_type_template_id_04d3a9fa___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameAccessCodeModal_vue_vue_type_template_id_04d3a9fa___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameAccessCodeModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAccessCodeModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameAccessCodeModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAccessCodeModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=template&id=04d3a9fa&":
/*!***********************************************************************************************!*\
  !*** ./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=template&id=04d3a9fa& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAccessCodeModal_vue_vue_type_template_id_04d3a9fa___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameAccessCodeModal.vue?vue&type=template&id=04d3a9fa& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAccessCodeModal.vue?vue&type=template&id=04d3a9fa&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAccessCodeModal_vue_vue_type_template_id_04d3a9fa___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAccessCodeModal_vue_vue_type_template_id_04d3a9fa___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue":
/*!***********************************************************************!*\
  !*** ./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameAnsweringTimeIsUpModal_vue_vue_type_template_id_5ec52480___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameAnsweringTimeIsUpModal.vue?vue&type=template&id=5ec52480& */ "./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=template&id=5ec52480&");
/* harmony import */ var _GameAnsweringTimeIsUpModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameAnsweringTimeIsUpModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GameAnsweringTimeIsUpModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameAnsweringTimeIsUpModal_vue_vue_type_template_id_5ec52480___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameAnsweringTimeIsUpModal_vue_vue_type_template_id_5ec52480___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameAnsweringTimeIsUpModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeIsUpModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameAnsweringTimeIsUpModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeIsUpModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=template&id=5ec52480&":
/*!******************************************************************************************************!*\
  !*** ./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=template&id=5ec52480& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeIsUpModal_vue_vue_type_template_id_5ec52480___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameAnsweringTimeIsUpModal.vue?vue&type=template&id=5ec52480& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAnsweringTimeIsUpModal.vue?vue&type=template&id=5ec52480&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeIsUpModal_vue_vue_type_template_id_5ec52480___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeIsUpModal_vue_vue_type_template_id_5ec52480___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameAnsweringTimeModal.vue":
/*!*******************************************************************!*\
  !*** ./resources/assets/js/components/GameAnsweringTimeModal.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameAnsweringTimeModal_vue_vue_type_template_id_6d65ef36___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameAnsweringTimeModal.vue?vue&type=template&id=6d65ef36& */ "./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=template&id=6d65ef36&");
/* harmony import */ var _GameAnsweringTimeModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameAnsweringTimeModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GameAnsweringTimeModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameAnsweringTimeModal_vue_vue_type_template_id_6d65ef36___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameAnsweringTimeModal_vue_vue_type_template_id_6d65ef36___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameAnsweringTimeModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameAnsweringTimeModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=template&id=6d65ef36&":
/*!**************************************************************************************************!*\
  !*** ./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=template&id=6d65ef36& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeModal_vue_vue_type_template_id_6d65ef36___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameAnsweringTimeModal.vue?vue&type=template&id=6d65ef36& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameAnsweringTimeModal.vue?vue&type=template&id=6d65ef36&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeModal_vue_vue_type_template_id_6d65ef36___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameAnsweringTimeModal_vue_vue_type_template_id_6d65ef36___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameImageDialog.vue":
/*!************************************************************!*\
  !*** ./resources/assets/js/components/GameImageDialog.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameImageDialog_vue_vue_type_template_id_799abdca___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameImageDialog.vue?vue&type=template&id=799abdca& */ "./resources/assets/js/components/GameImageDialog.vue?vue&type=template&id=799abdca&");
/* harmony import */ var _GameImageDialog_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameImageDialog.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameImageDialog.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GameImageDialog_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameImageDialog_vue_vue_type_template_id_799abdca___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameImageDialog_vue_vue_type_template_id_799abdca___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameImageDialog.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameImageDialog.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/assets/js/components/GameImageDialog.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameImageDialog_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameImageDialog.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameImageDialog.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameImageDialog_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameImageDialog.vue?vue&type=template&id=799abdca&":
/*!*******************************************************************************************!*\
  !*** ./resources/assets/js/components/GameImageDialog.vue?vue&type=template&id=799abdca& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameImageDialog_vue_vue_type_template_id_799abdca___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameImageDialog.vue?vue&type=template&id=799abdca& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameImageDialog.vue?vue&type=template&id=799abdca&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameImageDialog_vue_vue_type_template_id_799abdca___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameImageDialog_vue_vue_type_template_id_799abdca___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameInformationModal.vue":
/*!*****************************************************************!*\
  !*** ./resources/assets/js/components/GameInformationModal.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameInformationModal_vue_vue_type_template_id_2a6a2e2a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameInformationModal.vue?vue&type=template&id=2a6a2e2a& */ "./resources/assets/js/components/GameInformationModal.vue?vue&type=template&id=2a6a2e2a&");
/* harmony import */ var _GameInformationModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameInformationModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameInformationModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GameInformationModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameInformationModal_vue_vue_type_template_id_2a6a2e2a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameInformationModal_vue_vue_type_template_id_2a6a2e2a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameInformationModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameInformationModal.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/assets/js/components/GameInformationModal.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameInformationModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameInformationModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameInformationModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameInformationModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameInformationModal.vue?vue&type=template&id=2a6a2e2a&":
/*!************************************************************************************************!*\
  !*** ./resources/assets/js/components/GameInformationModal.vue?vue&type=template&id=2a6a2e2a& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameInformationModal_vue_vue_type_template_id_2a6a2e2a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameInformationModal.vue?vue&type=template&id=2a6a2e2a& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameInformationModal.vue?vue&type=template&id=2a6a2e2a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameInformationModal_vue_vue_type_template_id_2a6a2e2a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameInformationModal_vue_vue_type_template_id_2a6a2e2a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameMap.vue":
/*!****************************************************!*\
  !*** ./resources/assets/js/components/GameMap.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameMap_vue_vue_type_template_id_6b300b23___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameMap.vue?vue&type=template&id=6b300b23& */ "./resources/assets/js/components/GameMap.vue?vue&type=template&id=6b300b23&");
/* harmony import */ var _GameMap_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameMap.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameMap.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _GameMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GameMap.vue?vue&type=style&index=0&lang=css& */ "./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _GameMap_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameMap_vue_vue_type_template_id_6b300b23___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameMap_vue_vue_type_template_id_6b300b23___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameMap.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameMap.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/assets/js/components/GameMap.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameMap.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMap.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css&":
/*!*************************************************************************************!*\
  !*** ./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css& ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameMap.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMap.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/assets/js/components/GameMap.vue?vue&type=template&id=6b300b23&":
/*!***********************************************************************************!*\
  !*** ./resources/assets/js/components/GameMap.vue?vue&type=template&id=6b300b23& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_template_id_6b300b23___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameMap.vue?vue&type=template&id=6b300b23& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMap.vue?vue&type=template&id=6b300b23&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_template_id_6b300b23___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMap_vue_vue_type_template_id_6b300b23___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameMessagesListModal.vue":
/*!******************************************************************!*\
  !*** ./resources/assets/js/components/GameMessagesListModal.vue ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameMessagesListModal_vue_vue_type_template_id_5266066c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameMessagesListModal.vue?vue&type=template&id=5266066c&scoped=true& */ "./resources/assets/js/components/GameMessagesListModal.vue?vue&type=template&id=5266066c&scoped=true&");
/* harmony import */ var _GameMessagesListModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameMessagesListModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameMessagesListModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _GameMessagesListModal_vue_vue_type_style_index_0_id_5266066c_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css& */ "./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _GameMessagesListModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameMessagesListModal_vue_vue_type_template_id_5266066c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameMessagesListModal_vue_vue_type_template_id_5266066c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5266066c",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameMessagesListModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameMessagesListModal.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************!*\
  !*** ./resources/assets/js/components/GameMessagesListModal.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameMessagesListModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css&":
/*!***************************************************************************************************************************!*\
  !*** ./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css& ***!
  \***************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_style_index_0_id_5266066c_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=style&index=0&id=5266066c&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_style_index_0_id_5266066c_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_style_index_0_id_5266066c_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_style_index_0_id_5266066c_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_style_index_0_id_5266066c_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_style_index_0_id_5266066c_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/assets/js/components/GameMessagesListModal.vue?vue&type=template&id=5266066c&scoped=true&":
/*!*************************************************************************************************************!*\
  !*** ./resources/assets/js/components/GameMessagesListModal.vue?vue&type=template&id=5266066c&scoped=true& ***!
  \*************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_template_id_5266066c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameMessagesListModal.vue?vue&type=template&id=5266066c&scoped=true& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameMessagesListModal.vue?vue&type=template&id=5266066c&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_template_id_5266066c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameMessagesListModal_vue_vue_type_template_id_5266066c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameQuestionModal.vue":
/*!**************************************************************!*\
  !*** ./resources/assets/js/components/GameQuestionModal.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameQuestionModal_vue_vue_type_template_id_673a7024_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameQuestionModal.vue?vue&type=template&id=673a7024&scoped=true& */ "./resources/assets/js/components/GameQuestionModal.vue?vue&type=template&id=673a7024&scoped=true&");
/* harmony import */ var _GameQuestionModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameQuestionModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameQuestionModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _GameQuestionModal_vue_vue_type_style_index_0_id_673a7024_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css& */ "./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _GameQuestionModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameQuestionModal_vue_vue_type_template_id_673a7024_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameQuestionModal_vue_vue_type_template_id_673a7024_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "673a7024",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameQuestionModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameQuestionModal.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/assets/js/components/GameQuestionModal.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameQuestionModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameQuestionModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css&":
/*!***********************************************************************************************************************!*\
  !*** ./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css& ***!
  \***********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_style_index_0_id_673a7024_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameQuestionModal.vue?vue&type=style&index=0&id=673a7024&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_style_index_0_id_673a7024_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_style_index_0_id_673a7024_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_style_index_0_id_673a7024_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_style_index_0_id_673a7024_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_style_index_0_id_673a7024_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/assets/js/components/GameQuestionModal.vue?vue&type=template&id=673a7024&scoped=true&":
/*!*********************************************************************************************************!*\
  !*** ./resources/assets/js/components/GameQuestionModal.vue?vue&type=template&id=673a7024&scoped=true& ***!
  \*********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_template_id_673a7024_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameQuestionModal.vue?vue&type=template&id=673a7024&scoped=true& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameQuestionModal.vue?vue&type=template&id=673a7024&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_template_id_673a7024_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameQuestionModal_vue_vue_type_template_id_673a7024_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameRatingModal.vue":
/*!************************************************************!*\
  !*** ./resources/assets/js/components/GameRatingModal.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameRatingModal_vue_vue_type_template_id_29229fd7___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameRatingModal.vue?vue&type=template&id=29229fd7& */ "./resources/assets/js/components/GameRatingModal.vue?vue&type=template&id=29229fd7&");
/* harmony import */ var _GameRatingModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameRatingModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameRatingModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _GameRatingModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GameRatingModal.vue?vue&type=style&index=0&lang=css& */ "./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _GameRatingModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameRatingModal_vue_vue_type_template_id_29229fd7___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameRatingModal_vue_vue_type_template_id_29229fd7___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameRatingModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameRatingModal.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/assets/js/components/GameRatingModal.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameRatingModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameRatingModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css&":
/*!*********************************************************************************************!*\
  !*** ./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css& ***!
  \*********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameRatingModal.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameRatingModal.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/assets/js/components/GameRatingModal.vue?vue&type=template&id=29229fd7&":
/*!*******************************************************************************************!*\
  !*** ./resources/assets/js/components/GameRatingModal.vue?vue&type=template&id=29229fd7& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_template_id_29229fd7___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameRatingModal.vue?vue&type=template&id=29229fd7& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameRatingModal.vue?vue&type=template&id=29229fd7&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_template_id_29229fd7___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameRatingModal_vue_vue_type_template_id_29229fd7___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameResultsModal.vue":
/*!*************************************************************!*\
  !*** ./resources/assets/js/components/GameResultsModal.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameResultsModal_vue_vue_type_template_id_725aa9c0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameResultsModal.vue?vue&type=template&id=725aa9c0& */ "./resources/assets/js/components/GameResultsModal.vue?vue&type=template&id=725aa9c0&");
/* harmony import */ var _GameResultsModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameResultsModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameResultsModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _GameResultsModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GameResultsModal.vue?vue&type=style&index=0&lang=css& */ "./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _GameResultsModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameResultsModal_vue_vue_type_template_id_725aa9c0___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameResultsModal_vue_vue_type_template_id_725aa9c0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameResultsModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameResultsModal.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/assets/js/components/GameResultsModal.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameResultsModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameResultsModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************!*\
  !*** ./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader/dist/cjs.js??ref--6-1!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameResultsModal.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js?!./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameResultsModal.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_ref_6_1_node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/assets/js/components/GameResultsModal.vue?vue&type=template&id=725aa9c0&":
/*!********************************************************************************************!*\
  !*** ./resources/assets/js/components/GameResultsModal.vue?vue&type=template&id=725aa9c0& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_template_id_725aa9c0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameResultsModal.vue?vue&type=template&id=725aa9c0& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameResultsModal.vue?vue&type=template&id=725aa9c0&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_template_id_725aa9c0___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameResultsModal_vue_vue_type_template_id_725aa9c0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/GameTutorialModal.vue":
/*!**************************************************************!*\
  !*** ./resources/assets/js/components/GameTutorialModal.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GameTutorialModal_vue_vue_type_template_id_deac8114___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GameTutorialModal.vue?vue&type=template&id=deac8114& */ "./resources/assets/js/components/GameTutorialModal.vue?vue&type=template&id=deac8114&");
/* harmony import */ var _GameTutorialModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GameTutorialModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/GameTutorialModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GameTutorialModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GameTutorialModal_vue_vue_type_template_id_deac8114___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GameTutorialModal_vue_vue_type_template_id_deac8114___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/GameTutorialModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/GameTutorialModal.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/assets/js/components/GameTutorialModal.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameTutorialModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameTutorialModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameTutorialModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GameTutorialModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/GameTutorialModal.vue?vue&type=template&id=deac8114&":
/*!*********************************************************************************************!*\
  !*** ./resources/assets/js/components/GameTutorialModal.vue?vue&type=template&id=deac8114& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameTutorialModal_vue_vue_type_template_id_deac8114___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GameTutorialModal.vue?vue&type=template&id=deac8114& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/GameTutorialModal.vue?vue&type=template&id=deac8114&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameTutorialModal_vue_vue_type_template_id_deac8114___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GameTutorialModal_vue_vue_type_template_id_deac8114___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/NotificationModal.vue":
/*!**************************************************************!*\
  !*** ./resources/assets/js/components/NotificationModal.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _NotificationModal_vue_vue_type_template_id_11b58b4a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NotificationModal.vue?vue&type=template&id=11b58b4a&scoped=true& */ "./resources/assets/js/components/NotificationModal.vue?vue&type=template&id=11b58b4a&scoped=true&");
/* harmony import */ var _NotificationModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./NotificationModal.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/NotificationModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _NotificationModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _NotificationModal_vue_vue_type_template_id_11b58b4a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _NotificationModal_vue_vue_type_template_id_11b58b4a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "11b58b4a",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/NotificationModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/NotificationModal.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/assets/js/components/NotificationModal.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./NotificationModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/NotificationModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/components/NotificationModal.vue?vue&type=template&id=11b58b4a&scoped=true&":
/*!*********************************************************************************************************!*\
  !*** ./resources/assets/js/components/NotificationModal.vue?vue&type=template&id=11b58b4a&scoped=true& ***!
  \*********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationModal_vue_vue_type_template_id_11b58b4a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./NotificationModal.vue?vue&type=template&id=11b58b4a&scoped=true& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/components/NotificationModal.vue?vue&type=template&id=11b58b4a&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationModal_vue_vue_type_template_id_11b58b4a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NotificationModal_vue_vue_type_template_id_11b58b4a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/assets/js/components/classes/MissingWord.js":
/*!***************************************************************!*\
  !*** ./resources/assets/js/components/classes/MissingWord.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

module.exports = function MissingWord(data) {
  _classCallCheck(this, MissingWord);

  this.type = data.type;
  this.text = data.text;
  this.answer = data.answer;
  this.isCorrect = data.isCorrect;
};

/***/ }),

/***/ "./resources/assets/js/debounce.js":
/*!*****************************************!*\
  !*** ./resources/assets/js/debounce.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = function debounce(fn, delay) {
  var timeoutID = null;
  return function () {
    clearTimeout(timeoutID);
    var args = arguments;
    var that = this;
    timeoutID = setTimeout(function () {
      fn.apply(that, args);
    }, delay);
  };
};

/***/ }),

/***/ "./resources/assets/js/mixins/Image.js":
/*!*********************************************!*\
  !*** ./resources/assets/js/mixins/Image.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  methods: {
    isValidImageFormat: function isValidImageFormat(file) {
      return file.type === 'image/jpg' || file.type === 'image/jpeg' || file.type == 'image/png';
    }
  }
});

/***/ }),

/***/ "./resources/assets/js/mixins/MarkerIcon.js":
/*!**************************************************!*\
  !*** ./resources/assets/js/mixins/MarkerIcon.js ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  methods: {
    getIconsBaseUrl: function getIconsBaseUrl() {
      return this.baseUrl + '/img/map/icons/';
    },
    getIconUrl: function getIconUrl(state, type, hasAccessCode) {
      return this.getIconsBaseUrl() + (type && type === 1 ? 'info_' : '') + (state !== 'active' ? state : 'default') + (hasAccessCode === true && state === 'inactive' ? '_access' : '') + '.svg';
    }
  }
});

/***/ }),

/***/ "./resources/assets/js/mixins/MissingWord.js":
/*!***************************************************!*\
  !*** ./resources/assets/js/mixins/MissingWord.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_classes_MissingWord_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./../components/classes/MissingWord.js */ "./resources/assets/js/components/classes/MissingWord.js");
/* harmony import */ var _components_classes_MissingWord_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_components_classes_MissingWord_js__WEBPACK_IMPORTED_MODULE_0__);

/* harmony default export */ __webpack_exports__["default"] = ({
  methods: {
    missingWordsToArray: function missingWordsToArray(words) {
      var wordsArray = [];

      if (typeof words === 'undefined' || words.length <= 0) {
        return wordsArray;
      }

      var startParts = words.split('{');
      wordsArray.push(new _components_classes_MissingWord_js__WEBPACK_IMPORTED_MODULE_0___default.a({
        type: 'text',
        text: startParts.shift(),
        answer: '',
        isCorrect: false
      }));
      var startPartsLength = startParts.length;

      for (var i = 0; i < startPartsLength; i++) {
        var str = startParts[i];
        var endParts = str.split('}');

        if (endParts.length === 2) {
          wordsArray.push(new _components_classes_MissingWord_js__WEBPACK_IMPORTED_MODULE_0___default.a({
            type: 'input',
            text: endParts.shift(),
            answer: '',
            isCorrect: false
          }));
          wordsArray.push(new _components_classes_MissingWord_js__WEBPACK_IMPORTED_MODULE_0___default.a({
            type: 'text',
            text: endParts.shift(),
            answer: '',
            isCorrect: false
          }));
        }
      }

      return wordsArray;
    },
    missingWordsToString: function missingWordsToString(wordsArray) {
      var length = wordsArray.length;
      var text = '';

      for (var i = 0; i < length; i++) {
        var word = wordsArray[i];

        if (word.type === 'input') {
          text += '{' + word.answer + '}';
        } else {
          text += word.text;
        }
      }

      return text;
    }
  }
});

/***/ }),

/***/ "./resources/assets/js/play.js":
/*!*************************************!*\
  !*** ./resources/assets/js/play.js ***!
  \*************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var hammerjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! hammerjs */ "./node_modules/hammerjs/hammer.js");
/* harmony import */ var hammerjs__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(hammerjs__WEBPACK_IMPORTED_MODULE_0__);
//"use strict";
var VueI18n = __webpack_require__(/*! vue-i18n */ "./node_modules/vue-i18n/dist/vue-i18n.common.js");


Vue.use(VueI18n);
Vue.config.lang = window.RADA.config.locale;
Vue.locale(window.RADA.config.locale, _.cloneDeep(window.RADA.data.translations));
Vue.component('game-map', __webpack_require__(/*! ./components/GameMap.vue */ "./resources/assets/js/components/GameMap.vue")["default"]);
Vue.component('game-tutorial-modal', __webpack_require__(/*! ./components/GameTutorialModal.vue */ "./resources/assets/js/components/GameTutorialModal.vue")["default"]);
Vue.component('game-information-modal', __webpack_require__(/*! ./components/GameInformationModal.vue */ "./resources/assets/js/components/GameInformationModal.vue")["default"]);
Vue.component('game-results-modal', __webpack_require__(/*! ./components/GameResultsModal.vue */ "./resources/assets/js/components/GameResultsModal.vue")["default"]);
Vue.component('game-rating-modal', __webpack_require__(/*! ./components/GameRatingModal.vue */ "./resources/assets/js/components/GameRatingModal.vue")["default"]);
Vue.component('game-image-dialog', __webpack_require__(/*! ./components/GameImageDialog.vue */ "./resources/assets/js/components/GameImageDialog.vue")["default"]);
var playGameApp = new Vue({
  el: '#sz-play-app',
  created: function created() {
    var vm = this;
    vm.baseUrl = window.RADA.config.base_url;
    vm.exitUrl = window.RADA.config.exit_url;
    vm.isLoggedIn = window.Laravel.isLoggedIn;
    vm.userName = window.Laravel.userName;
    vm.game = window.RADA.data.game;
    window.addEventListener('beforeunload', vm.leaving);
    vm.$on('dialog:tutorial:close', function () {
      vm.setHasSeenTotorial();
    });

    if (!vm.isGameComplete()) {
      window.initMap = function () {
        vm.mapInitialised = true;
      };

      vm.getGeoLocation(function (position) {
        vm.latitude = position.coords.latitude;
        vm.longitude = position.coords.longitude;
      }, false, function (error) {
        vm.geoLocationErrorMessage = error.message;
      });
      var script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = '//maps.googleapis.com/maps/api/js?key=' + window.RADA.config.map.key + '&callback=initMap&libraries=geometry';
      document.body.appendChild(script);
    }
  },
  mounted: function mounted() {
    var _this = this;

    if (!this.isGameComplete()) {
      if (!this.hasSeenTutorial()) {
        this.$refs.tutorialModal.open();
      } else {
        this.$refs.informationModal.open();
      }

      this.$watch('game.complete', function () {
        if (_this.isGameComplete()) {
          _this.$refs.imageDialog.open();

          _this.$refs.imageDialog.$once('hidden:image:dialog', function () {
            if (_this.game.rating === null) {
              _this.$refs.ratingModal.open(function () {
                _this.$refs.resultsModal.open();
              });
            } else {
              _this.$refs.resultsModal.open();
            }
          });
        }
      });
    } else {
      if (this.game.rating === null) {
        this.$refs.ratingModal.open(function () {
          _this.$refs.resultsModal.open();
        });
      } else {
        this.$refs.resultsModal.open();
      }
    }
  },
  data: function data() {
    return {
      baseUrl: '',
      exitUrl: '',
      mapInitialised: false,
      latitude: undefined,
      longitude: undefined,
      geoLocationErrorMessage: null,
      checkUnload: true,
      game: null,
      isLoggedIn: false,
      userName: ''
    };
  },
  methods: {
    isLoading: function isLoading() {
      return !(this.mapInitialised && this.latitude && this.longitude);
    },
    isGameComplete: function isGameComplete() {
      return this.game && this.game.complete;
    },
    getGeoLocation: function getGeoLocation(callback, watch, handleError) {
      if (typeof handleError !== 'function') {
        handleError = function handleError(error) {
          if (window.console && window.console.error && typeof window.console.error === 'function') {
            window.console.error('Geolocation error', error); // TODO Consider making traslatable
          }
        };
      }

      if (window.navigator.geolocation) {
        var geolocationOptions = {
          enableHighAccuracy: true
        };

        if (watch === true) {
          window.navigator.geolocation.watchPosition(callback, handleError, geolocationOptions);
        } else {
          window.navigator.geolocation.getCurrentPosition(callback, handleError, geolocationOptions);
        }
      } else {
        throw 'Geolocation is unavailable!'; // TODO Consider making translatable
      }
    },
    hasGeoLocationError: function hasGeoLocationError() {
      return !!this.geoLocationErrorMessage;
    },
    leaving: function leaving(event) {
      if (!this.checkUnload) return false;
      var message = this.$t('exit-confirmation');
      event.returnValue = message;
      return message;
    },
    exit: function exit() {
      var confirmation = confirm(this.$t('exit-confirmation'));

      if (confirmation) {
        // Prevent unload check from being applied
        this.checkUnload = false;
        window.location = this.exitUrl;
      }
    },
    hasSeenTutorial: function hasSeenTutorial() {
      if (!window.sessionStorage) return false;
      return window.sessionStorage.getItem('seen:game:tutorial') === 'true';
    },
    setHasSeenTotorial: function setHasSeenTotorial() {
      if (window.sessionStorage) {
        try {
          window.sessionStorage.setItem('seen:game:tutorial', 'true');
        } catch (err) {// Handles the QuotaExceededError in some versions of Safari on iOS
        }
      }
    }
  }
});

/***/ }),

/***/ 4:
/*!*******************************************!*\
  !*** multi ./resources/assets/js/play.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/assets/js/play.js */"./resources/assets/js/play.js");


/***/ })

/******/ });