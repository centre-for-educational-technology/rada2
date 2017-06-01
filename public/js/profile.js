/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("$(function () {\n    var apiUrl = window.Laravel.apiUrl;\n    var hasAnalytics = !!window.ga;\n\n    $('[data-toggle=\"popover\"]').popover();\n\n    $('button#send-to-backpack').on('click', function() {\n        if ( hasAnalytics ) {\n            ga('send', 'event', 'Badges', 'click', 'User initialized sending badges to Backpack');\n        }\n        $.getJSON(apiUrl + '/badges/mine', function(data) {\n            if ( _.size(data) > 0 ) {\n                var assertions = _.map(data, function(single) {\n                    return single.assertion;\n                });\n                OpenBadges.issue(assertions, function(errors, successes) {\n                    if ( hasAnalytics ) {\n                        ga('send', 'event', 'Badges', 'issue', 'User sent badges to Backpack');\n                    }\n                    if ( successes.length > 0 ) {\n                        if ( hasAnalytics ) {\n                            ga('send', 'event', 'Badges', 'issueSuccesses', 'Number of badges successfully issued', successes.length, { nonInteraction: true });\n                        }\n                        var badges = [];\n                        _.each(data, function(single) {\n                            if ( _.indexOf(successes, single.assertion) !== -1 ) {\n                                badges.push(single.badge);\n                            }\n                        });\n                        $.post(apiUrl + '/badges/mine', { badges: badges }, null);\n                    }\n                });\n            }\n        });\n    });\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3Byb2ZpbGUuanM/MGYxMSJdLCJzb3VyY2VzQ29udGVudCI6WyIkKGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgYXBpVXJsID0gd2luZG93LkxhcmF2ZWwuYXBpVXJsO1xuICAgIHZhciBoYXNBbmFseXRpY3MgPSAhIXdpbmRvdy5nYTtcblxuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInBvcG92ZXJcIl0nKS5wb3BvdmVyKCk7XG5cbiAgICAkKCdidXR0b24jc2VuZC10by1iYWNrcGFjaycpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuICAgICAgICBpZiAoIGhhc0FuYWx5dGljcyApIHtcbiAgICAgICAgICAgIGdhKCdzZW5kJywgJ2V2ZW50JywgJ0JhZGdlcycsICdjbGljaycsICdVc2VyIGluaXRpYWxpemVkIHNlbmRpbmcgYmFkZ2VzIHRvIEJhY2twYWNrJyk7XG4gICAgICAgIH1cbiAgICAgICAgJC5nZXRKU09OKGFwaVVybCArICcvYmFkZ2VzL21pbmUnLCBmdW5jdGlvbihkYXRhKSB7XG4gICAgICAgICAgICBpZiAoIF8uc2l6ZShkYXRhKSA+IDAgKSB7XG4gICAgICAgICAgICAgICAgdmFyIGFzc2VydGlvbnMgPSBfLm1hcChkYXRhLCBmdW5jdGlvbihzaW5nbGUpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHNpbmdsZS5hc3NlcnRpb247XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgT3BlbkJhZGdlcy5pc3N1ZShhc3NlcnRpb25zLCBmdW5jdGlvbihlcnJvcnMsIHN1Y2Nlc3Nlcykge1xuICAgICAgICAgICAgICAgICAgICBpZiAoIGhhc0FuYWx5dGljcyApIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGdhKCdzZW5kJywgJ2V2ZW50JywgJ0JhZGdlcycsICdpc3N1ZScsICdVc2VyIHNlbnQgYmFkZ2VzIHRvIEJhY2twYWNrJyk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgaWYgKCBzdWNjZXNzZXMubGVuZ3RoID4gMCApIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmICggaGFzQW5hbHl0aWNzICkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGdhKCdzZW5kJywgJ2V2ZW50JywgJ0JhZGdlcycsICdpc3N1ZVN1Y2Nlc3NlcycsICdOdW1iZXIgb2YgYmFkZ2VzIHN1Y2Nlc3NmdWxseSBpc3N1ZWQnLCBzdWNjZXNzZXMubGVuZ3RoLCB7IG5vbkludGVyYWN0aW9uOiB0cnVlIH0pO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgdmFyIGJhZGdlcyA9IFtdO1xuICAgICAgICAgICAgICAgICAgICAgICAgXy5lYWNoKGRhdGEsIGZ1bmN0aW9uKHNpbmdsZSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmICggXy5pbmRleE9mKHN1Y2Nlc3Nlcywgc2luZ2xlLmFzc2VydGlvbikgIT09IC0xICkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBiYWRnZXMucHVzaChzaW5nbGUuYmFkZ2UpO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAgICAgJC5wb3N0KGFwaVVybCArICcvYmFkZ2VzL21pbmUnLCB7IGJhZGdlczogYmFkZ2VzIH0sIG51bGwpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH0pO1xufSk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9wcm9maWxlLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);