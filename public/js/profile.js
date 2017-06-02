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

eval("$(function () {\n    var apiUrl = window.Laravel.apiUrl;\n    var hasAnalytics = !!window.ga;\n\n    function handleGa() {\n        if ( hasAnalytics ) {\n            ga.apply(this, arguments);\n        }\n    }\n\n    $('[data-toggle=\"popover\"]').popover();\n    $('[data-toggle=\"tooltip\"]').tooltip();\n\n    $('button#send-to-backpack').on('click', function() {\n        handleGa('send', 'event', 'Badges', 'click', 'User initialized sending badges to Backpack');\n\n        $.getJSON(apiUrl + '/badges/mine', function(data) {\n            if ( _.size(data) > 0 ) {\n                var assertions = _.map(data, function(single) {\n                    return single.assertion;\n                });\n                OpenBadges.issue(assertions, function(errors, successes) {\n                    handleGa('send', 'event', 'Badges', 'issue', 'User sent badges to Backpack', assertions.length, { nonInteraction: true });\n\n                    if ( successes.length > 0 ) {\n                        handleGa('send', 'event', 'Badges', 'issueSuccesses', 'Number of badges successfully issued', successes.length, { nonInteraction: true });\n                        var badges = [];\n                        _.each(data, function(single) {\n                            if ( _.indexOf(successes, single.assertion) !== -1 ) {\n                                badges.push(single.badge);\n                            }\n                        });\n                        $.post(apiUrl + '/badges/mine', { badges: badges }, null);\n                    }\n                });\n            }\n        });\n    });\n\n    $('button.openbadge-download').on('click', function() {\n        var url = 'http://backpack.openbadges.org/baker?assertion=' + window.encodeURIComponent($(this).data('assertion-url'));\n        window.open(url, '_blank', '', false);\n    });\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3Byb2ZpbGUuanM/MGYxMSJdLCJzb3VyY2VzQ29udGVudCI6WyIkKGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgYXBpVXJsID0gd2luZG93LkxhcmF2ZWwuYXBpVXJsO1xuICAgIHZhciBoYXNBbmFseXRpY3MgPSAhIXdpbmRvdy5nYTtcblxuICAgIGZ1bmN0aW9uIGhhbmRsZUdhKCkge1xuICAgICAgICBpZiAoIGhhc0FuYWx5dGljcyApIHtcbiAgICAgICAgICAgIGdhLmFwcGx5KHRoaXMsIGFyZ3VtZW50cyk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICAkKCdbZGF0YS10b2dnbGU9XCJwb3BvdmVyXCJdJykucG9wb3ZlcigpO1xuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInRvb2x0aXBcIl0nKS50b29sdGlwKCk7XG5cbiAgICAkKCdidXR0b24jc2VuZC10by1iYWNrcGFjaycpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuICAgICAgICBoYW5kbGVHYSgnc2VuZCcsICdldmVudCcsICdCYWRnZXMnLCAnY2xpY2snLCAnVXNlciBpbml0aWFsaXplZCBzZW5kaW5nIGJhZGdlcyB0byBCYWNrcGFjaycpO1xuXG4gICAgICAgICQuZ2V0SlNPTihhcGlVcmwgKyAnL2JhZGdlcy9taW5lJywgZnVuY3Rpb24oZGF0YSkge1xuICAgICAgICAgICAgaWYgKCBfLnNpemUoZGF0YSkgPiAwICkge1xuICAgICAgICAgICAgICAgIHZhciBhc3NlcnRpb25zID0gXy5tYXAoZGF0YSwgZnVuY3Rpb24oc2luZ2xlKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBzaW5nbGUuYXNzZXJ0aW9uO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIE9wZW5CYWRnZXMuaXNzdWUoYXNzZXJ0aW9ucywgZnVuY3Rpb24oZXJyb3JzLCBzdWNjZXNzZXMpIHtcbiAgICAgICAgICAgICAgICAgICAgaGFuZGxlR2EoJ3NlbmQnLCAnZXZlbnQnLCAnQmFkZ2VzJywgJ2lzc3VlJywgJ1VzZXIgc2VudCBiYWRnZXMgdG8gQmFja3BhY2snLCBhc3NlcnRpb25zLmxlbmd0aCwgeyBub25JbnRlcmFjdGlvbjogdHJ1ZSB9KTtcblxuICAgICAgICAgICAgICAgICAgICBpZiAoIHN1Y2Nlc3Nlcy5sZW5ndGggPiAwICkge1xuICAgICAgICAgICAgICAgICAgICAgICAgaGFuZGxlR2EoJ3NlbmQnLCAnZXZlbnQnLCAnQmFkZ2VzJywgJ2lzc3VlU3VjY2Vzc2VzJywgJ051bWJlciBvZiBiYWRnZXMgc3VjY2Vzc2Z1bGx5IGlzc3VlZCcsIHN1Y2Nlc3Nlcy5sZW5ndGgsIHsgbm9uSW50ZXJhY3Rpb246IHRydWUgfSk7XG4gICAgICAgICAgICAgICAgICAgICAgICB2YXIgYmFkZ2VzID0gW107XG4gICAgICAgICAgICAgICAgICAgICAgICBfLmVhY2goZGF0YSwgZnVuY3Rpb24oc2luZ2xlKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCBfLmluZGV4T2Yoc3VjY2Vzc2VzLCBzaW5nbGUuYXNzZXJ0aW9uKSAhPT0gLTEgKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGJhZGdlcy5wdXNoKHNpbmdsZS5iYWRnZSk7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgICAgICAgICAkLnBvc3QoYXBpVXJsICsgJy9iYWRnZXMvbWluZScsIHsgYmFkZ2VzOiBiYWRnZXMgfSwgbnVsbCk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSk7XG5cbiAgICAkKCdidXR0b24ub3BlbmJhZGdlLWRvd25sb2FkJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICAgIHZhciB1cmwgPSAnaHR0cDovL2JhY2twYWNrLm9wZW5iYWRnZXMub3JnL2Jha2VyP2Fzc2VydGlvbj0nICsgd2luZG93LmVuY29kZVVSSUNvbXBvbmVudCgkKHRoaXMpLmRhdGEoJ2Fzc2VydGlvbi11cmwnKSk7XG4gICAgICAgIHdpbmRvdy5vcGVuKHVybCwgJ19ibGFuaycsICcnLCBmYWxzZSk7XG4gICAgfSk7XG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL3Byb2ZpbGUuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);