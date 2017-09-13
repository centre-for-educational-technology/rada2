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

eval("$(function () {\n    var formElement = $('form[name=\"search-form\"]');\n\n    formElement\n        .find('input[name=\"difficulty-level\"]')\n        .parent().find('button')\n        .on('click', function() {\n            var buttonElement = $(this);\n            buttonElement.parents('.input-group').find('button').removeClass('active');\n            buttonElement.addClass('active');\n            formElement.find('input[name=\"difficulty-level\"]').val(buttonElement.data('value'));\n        });\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3NlYXJjaF9hY3Rpdml0aWVzLmpzP2Q5NjgiXSwic291cmNlc0NvbnRlbnQiOlsiJChmdW5jdGlvbiAoKSB7XG4gICAgdmFyIGZvcm1FbGVtZW50ID0gJCgnZm9ybVtuYW1lPVwic2VhcmNoLWZvcm1cIl0nKTtcblxuICAgIGZvcm1FbGVtZW50XG4gICAgICAgIC5maW5kKCdpbnB1dFtuYW1lPVwiZGlmZmljdWx0eS1sZXZlbFwiXScpXG4gICAgICAgIC5wYXJlbnQoKS5maW5kKCdidXR0b24nKVxuICAgICAgICAub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICB2YXIgYnV0dG9uRWxlbWVudCA9ICQodGhpcyk7XG4gICAgICAgICAgICBidXR0b25FbGVtZW50LnBhcmVudHMoJy5pbnB1dC1ncm91cCcpLmZpbmQoJ2J1dHRvbicpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgICAgIGJ1dHRvbkVsZW1lbnQuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAgICAgZm9ybUVsZW1lbnQuZmluZCgnaW5wdXRbbmFtZT1cImRpZmZpY3VsdHktbGV2ZWxcIl0nKS52YWwoYnV0dG9uRWxlbWVudC5kYXRhKCd2YWx1ZScpKTtcbiAgICAgICAgfSk7XG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL3NlYXJjaF9hY3Rpdml0aWVzLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);