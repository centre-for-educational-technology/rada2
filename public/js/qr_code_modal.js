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

eval("$(function () {\n    var qrCodeModal = $('#qr-code-modal');\n\n    qrCodeModal.on('show.bs.modal', function (event) {\n        var element = $(event.relatedTarget);\n        var modalBody = $(this).find('.modal-body');\n        var downloadQrCode = function() {\n            window.open(element.data('download-url'), '_blank');\n        };\n\n        $(this).find('.modal-title').text(element.data('title'));\n        $.get(element.data('api-url'), function(data, textStatus, jqXHR) {\n            modalBody.html(data.qrcode);\n            modalBody.find('svg').on('click', downloadQrCode);\n        });\n        $(this).find('.modal-footer > button').on('click', downloadQrCode);\n    });\n\n    qrCodeModal.on('hidden.bs.modal', function() {\n        $(this).find('.modal-title').html('');\n        $(this).find('.modal-body').html('');\n        $(this).find('.modal-footer > button').off('click');\n    });\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3FyX2NvZGVfbW9kYWwuanM/ZDA0YyJdLCJzb3VyY2VzQ29udGVudCI6WyIkKGZ1bmN0aW9uICgpIHtcbiAgICBjb25zdCBxckNvZGVNb2RhbCA9ICQoJyNxci1jb2RlLW1vZGFsJyk7XG5cbiAgICBxckNvZGVNb2RhbC5vbignc2hvdy5icy5tb2RhbCcsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gJChldmVudC5yZWxhdGVkVGFyZ2V0KTtcbiAgICAgICAgY29uc3QgbW9kYWxCb2R5ID0gJCh0aGlzKS5maW5kKCcubW9kYWwtYm9keScpO1xuICAgICAgICBjb25zdCBkb3dubG9hZFFyQ29kZSA9IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgd2luZG93Lm9wZW4oZWxlbWVudC5kYXRhKCdkb3dubG9hZC11cmwnKSwgJ19ibGFuaycpO1xuICAgICAgICB9O1xuXG4gICAgICAgICQodGhpcykuZmluZCgnLm1vZGFsLXRpdGxlJykudGV4dChlbGVtZW50LmRhdGEoJ3RpdGxlJykpO1xuICAgICAgICAkLmdldChlbGVtZW50LmRhdGEoJ2FwaS11cmwnKSwgZnVuY3Rpb24oZGF0YSwgdGV4dFN0YXR1cywganFYSFIpIHtcbiAgICAgICAgICAgIG1vZGFsQm9keS5odG1sKGRhdGEucXJjb2RlKTtcbiAgICAgICAgICAgIG1vZGFsQm9keS5maW5kKCdzdmcnKS5vbignY2xpY2snLCBkb3dubG9hZFFyQ29kZSk7XG4gICAgICAgIH0pO1xuICAgICAgICAkKHRoaXMpLmZpbmQoJy5tb2RhbC1mb290ZXIgPiBidXR0b24nKS5vbignY2xpY2snLCBkb3dubG9hZFFyQ29kZSk7XG4gICAgfSk7XG5cbiAgICBxckNvZGVNb2RhbC5vbignaGlkZGVuLmJzLm1vZGFsJywgZnVuY3Rpb24oKSB7XG4gICAgICAgICQodGhpcykuZmluZCgnLm1vZGFsLXRpdGxlJykuaHRtbCgnJyk7XG4gICAgICAgICQodGhpcykuZmluZCgnLm1vZGFsLWJvZHknKS5odG1sKCcnKTtcbiAgICAgICAgJCh0aGlzKS5maW5kKCcubW9kYWwtZm9vdGVyID4gYnV0dG9uJykub2ZmKCdjbGljaycpO1xuICAgIH0pO1xufSk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9xcl9jb2RlX21vZGFsLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);