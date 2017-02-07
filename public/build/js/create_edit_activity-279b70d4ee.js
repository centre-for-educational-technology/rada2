/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("$(document).ready(function() {\n    // Instanciate slider\n    $('#difficulty_level').ionRangeSlider({\n        onChange: function(data) {\n            $('input[name=\"difficulty_level_start\"]').val(data.from);\n            $('input[name=\"difficulty_level_end\"]').val(data.to);\n        }\n    });\n\n    // Instanciate popovers\n    $('[data-toggle=\"popover\"]').popover();\n\n    // Instanciate lists with dragging and sorting functionality\n    var sortableSource = Sortable.create(document.getElementById('activity-items'), {\n        group: {\n            name: 'activity-items',\n            pull: 'clone',\n            put: false\n        },\n        sort: false,\n        handle: '.sz-handle'\n    });\n    var sortableTarget = Sortable.create(document.getElementById('attached-activity-items'), {\n        group: {\n            name: 'activity-items',\n            pull: false,\n            put: true\n        },\n        sort: true,\n        handle: '.sz-handle',\n        onAdd: function(evt) {\n            var input = $(evt.item).find('input')[0];\n            input.name = input.name.replace(/tmp_/, \"\");\n            $(evt.item).find('i.sz-handle').after('<i class=\"mdi mdi-close-circle-outline pull-right\" aria-hidden=\"true\" onclick=\"$(this).parent().popover(\\'destroy\\');$(this).parent().remove();\"></i>');\n        }\n    });\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2NyZWF0ZV9lZGl0X2FjdGl2aXR5LmpzP2Q0NTMiXSwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgLy8gSW5zdGFuY2lhdGUgc2xpZGVyXG4gICAgJCgnI2RpZmZpY3VsdHlfbGV2ZWwnKS5pb25SYW5nZVNsaWRlcih7XG4gICAgICAgIG9uQ2hhbmdlOiBmdW5jdGlvbihkYXRhKSB7XG4gICAgICAgICAgICAkKCdpbnB1dFtuYW1lPVwiZGlmZmljdWx0eV9sZXZlbF9zdGFydFwiXScpLnZhbChkYXRhLmZyb20pO1xuICAgICAgICAgICAgJCgnaW5wdXRbbmFtZT1cImRpZmZpY3VsdHlfbGV2ZWxfZW5kXCJdJykudmFsKGRhdGEudG8pO1xuICAgICAgICB9XG4gICAgfSk7XG5cbiAgICAvLyBJbnN0YW5jaWF0ZSBwb3BvdmVyc1xuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInBvcG92ZXJcIl0nKS5wb3BvdmVyKCk7XG5cbiAgICAvLyBJbnN0YW5jaWF0ZSBsaXN0cyB3aXRoIGRyYWdnaW5nIGFuZCBzb3J0aW5nIGZ1bmN0aW9uYWxpdHlcbiAgICB2YXIgc29ydGFibGVTb3VyY2UgPSBTb3J0YWJsZS5jcmVhdGUoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2FjdGl2aXR5LWl0ZW1zJyksIHtcbiAgICAgICAgZ3JvdXA6IHtcbiAgICAgICAgICAgIG5hbWU6ICdhY3Rpdml0eS1pdGVtcycsXG4gICAgICAgICAgICBwdWxsOiAnY2xvbmUnLFxuICAgICAgICAgICAgcHV0OiBmYWxzZVxuICAgICAgICB9LFxuICAgICAgICBzb3J0OiBmYWxzZSxcbiAgICAgICAgaGFuZGxlOiAnLnN6LWhhbmRsZSdcbiAgICB9KTtcbiAgICB2YXIgc29ydGFibGVUYXJnZXQgPSBTb3J0YWJsZS5jcmVhdGUoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2F0dGFjaGVkLWFjdGl2aXR5LWl0ZW1zJyksIHtcbiAgICAgICAgZ3JvdXA6IHtcbiAgICAgICAgICAgIG5hbWU6ICdhY3Rpdml0eS1pdGVtcycsXG4gICAgICAgICAgICBwdWxsOiBmYWxzZSxcbiAgICAgICAgICAgIHB1dDogdHJ1ZVxuICAgICAgICB9LFxuICAgICAgICBzb3J0OiB0cnVlLFxuICAgICAgICBoYW5kbGU6ICcuc3otaGFuZGxlJyxcbiAgICAgICAgb25BZGQ6IGZ1bmN0aW9uKGV2dCkge1xuICAgICAgICAgICAgdmFyIGlucHV0ID0gJChldnQuaXRlbSkuZmluZCgnaW5wdXQnKVswXTtcbiAgICAgICAgICAgIGlucHV0Lm5hbWUgPSBpbnB1dC5uYW1lLnJlcGxhY2UoL3RtcF8vLCBcIlwiKTtcbiAgICAgICAgICAgICQoZXZ0Lml0ZW0pLmZpbmQoJ2kuc3otaGFuZGxlJykuYWZ0ZXIoJzxpIGNsYXNzPVwibWRpIG1kaS1jbG9zZS1jaXJjbGUtb3V0bGluZSBwdWxsLXJpZ2h0XCIgYXJpYS1oaWRkZW49XCJ0cnVlXCIgb25jbGljaz1cIiQodGhpcykucGFyZW50KCkucG9wb3ZlcihcXCdkZXN0cm95XFwnKTskKHRoaXMpLnBhcmVudCgpLnJlbW92ZSgpO1wiPjwvaT4nKTtcbiAgICAgICAgfVxuICAgIH0pO1xufSk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9jcmVhdGVfZWRpdF9hY3Rpdml0eS5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);