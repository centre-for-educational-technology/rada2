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

eval("$(document).ready(function() {\n    // Instanciate slider\n    $('#difficulty_level').ionRangeSlider({\n        onChange: function(data) {\n            $('input[name=\"difficulty_level_start\"]').val(data.from);\n            $('input[name=\"difficulty_level_end\"]').val(data.to);\n        }\n    });\n\n    // Instanciate popovers\n    // TODO Enable popovers, these have issues after cloning\n    //$('[data-toggle=\"popover\"]').popover();\n\n    // Instanciate lists with dragging and sorting functionality\n    var sortableSource = Sortable.create(document.getElementById('activity-items'), {\n        group: {\n            name: 'activity-items',\n            pull: 'clone',\n            put: false\n        },\n        sort: false\n    });\n    var sortableTarget = Sortable.create(document.getElementById('attached-activity-items'), {\n        group: {\n            name: 'activity-items',\n            pull: false,\n            put: true\n        },\n        sort: true,\n        onAdd: function(evt) {\n            var input = $(evt.item).find('input')[0];\n            input.name = input.name.replace(/tmp_/, \"\");\n            $(evt.item).find('.row > div:first').append('<i class=\"mdi mdi-close-circle-outline\" aria-hidden=\"true\" onclick=\"$(this).parent().parent().parent().remove();\"></i>');\n        }\n    });\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2NyZWF0ZV9lZGl0X2FjdGl2aXR5LmpzP2Q0NTMiXSwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgLy8gSW5zdGFuY2lhdGUgc2xpZGVyXG4gICAgJCgnI2RpZmZpY3VsdHlfbGV2ZWwnKS5pb25SYW5nZVNsaWRlcih7XG4gICAgICAgIG9uQ2hhbmdlOiBmdW5jdGlvbihkYXRhKSB7XG4gICAgICAgICAgICAkKCdpbnB1dFtuYW1lPVwiZGlmZmljdWx0eV9sZXZlbF9zdGFydFwiXScpLnZhbChkYXRhLmZyb20pO1xuICAgICAgICAgICAgJCgnaW5wdXRbbmFtZT1cImRpZmZpY3VsdHlfbGV2ZWxfZW5kXCJdJykudmFsKGRhdGEudG8pO1xuICAgICAgICB9XG4gICAgfSk7XG5cbiAgICAvLyBJbnN0YW5jaWF0ZSBwb3BvdmVyc1xuICAgIC8vIFRPRE8gRW5hYmxlIHBvcG92ZXJzLCB0aGVzZSBoYXZlIGlzc3VlcyBhZnRlciBjbG9uaW5nXG4gICAgLy8kKCdbZGF0YS10b2dnbGU9XCJwb3BvdmVyXCJdJykucG9wb3ZlcigpO1xuXG4gICAgLy8gSW5zdGFuY2lhdGUgbGlzdHMgd2l0aCBkcmFnZ2luZyBhbmQgc29ydGluZyBmdW5jdGlvbmFsaXR5XG4gICAgdmFyIHNvcnRhYmxlU291cmNlID0gU29ydGFibGUuY3JlYXRlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdhY3Rpdml0eS1pdGVtcycpLCB7XG4gICAgICAgIGdyb3VwOiB7XG4gICAgICAgICAgICBuYW1lOiAnYWN0aXZpdHktaXRlbXMnLFxuICAgICAgICAgICAgcHVsbDogJ2Nsb25lJyxcbiAgICAgICAgICAgIHB1dDogZmFsc2VcbiAgICAgICAgfSxcbiAgICAgICAgc29ydDogZmFsc2VcbiAgICB9KTtcbiAgICB2YXIgc29ydGFibGVUYXJnZXQgPSBTb3J0YWJsZS5jcmVhdGUoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2F0dGFjaGVkLWFjdGl2aXR5LWl0ZW1zJyksIHtcbiAgICAgICAgZ3JvdXA6IHtcbiAgICAgICAgICAgIG5hbWU6ICdhY3Rpdml0eS1pdGVtcycsXG4gICAgICAgICAgICBwdWxsOiBmYWxzZSxcbiAgICAgICAgICAgIHB1dDogdHJ1ZVxuICAgICAgICB9LFxuICAgICAgICBzb3J0OiB0cnVlLFxuICAgICAgICBvbkFkZDogZnVuY3Rpb24oZXZ0KSB7XG4gICAgICAgICAgICB2YXIgaW5wdXQgPSAkKGV2dC5pdGVtKS5maW5kKCdpbnB1dCcpWzBdO1xuICAgICAgICAgICAgaW5wdXQubmFtZSA9IGlucHV0Lm5hbWUucmVwbGFjZSgvdG1wXy8sIFwiXCIpO1xuICAgICAgICAgICAgJChldnQuaXRlbSkuZmluZCgnLnJvdyA+IGRpdjpmaXJzdCcpLmFwcGVuZCgnPGkgY2xhc3M9XCJtZGkgbWRpLWNsb3NlLWNpcmNsZS1vdXRsaW5lXCIgYXJpYS1oaWRkZW49XCJ0cnVlXCIgb25jbGljaz1cIiQodGhpcykucGFyZW50KCkucGFyZW50KCkucGFyZW50KCkucmVtb3ZlKCk7XCI+PC9pPicpO1xuICAgICAgICB9XG4gICAgfSk7XG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2NyZWF0ZV9lZGl0X2FjdGl2aXR5LmpzIl0sIm1hcHBpbmdzIjoiQUFBQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7Ozs7O0FBTUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);