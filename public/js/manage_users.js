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

eval("$(function () {\n    var apiUrl = Laravel.apiUrl;\n\n    $('.mdi-close-circle-outline').on('click', function() {\n        var _this = $(this);\n        var confirmation = confirm(_this.data('confirm'));\n\n        if ( confirmation ) {\n            var user = _this.data('user-id'),\n                role = _this.data('role-id');\n\n            $.ajax({\n                cache: false,\n                method: 'DELETE',\n                url: apiUrl + '/manage/users/' + user + '/roles/' + role,\n                success: function(data, textStatus, jqXHR) {\n                    _this.parent().fadeOut('medium', function() {\n                        $(this).remove();\n                    });\n                    $('#user-' + user).find('button').data('user-roles', data.roles);\n                },\n                error: function(jqXHR, textStatus, errorThrown) {\n                    _this.parent().addClass('animated shake');\n                    setTimeout(function() {\n                        _this.parent().removeClass('animated shake');\n                    }, 1000);\n                }\n            });\n        }\n    });\n\n    $('#rolesModal').on('show.bs.modal', function(e) {\n        var form = $(this).find('form'),\n            button = $(e.relatedTarget),\n            userId = button.data('user-id'),\n            userName = button.data('user-name'),\n            userRoles = button.data('user-roles');\n            form.attr('action', form.data('action-base') + '/' + userId);\n            $(this).find('h4.modal-title > strong').text(userName);\n            if ( userRoles ) {\n                _.each(userRoles, function(role) {\n                    form.find('input[type=\"checkbox\"][name=\"roles[]\"][value=\"' + role.id + '\"]').prop('checked', true);\n                    if ( role.zoo ) {\n                        form.find('select[name=\"role_' + role.id + '_zoo\"]').val(role.zoo);\n                    }\n                });\n            }\n\n    });\n    $('#rolesModal').on('hidden.bs.modal', function(e) {\n        var form = $(this).find('form');\n\n        form.trigger('reset');\n        form.attr('action', '');\n        $(this).find('h4.modal-title > strong').text('');\n    });\n\n    // Delete button comnfirmation and consequent POST\n    $('button[data-toggle=\"action\"]').on('click', function(e) {\n        e.preventDefault();\n        var _this = $(this);\n\n        if ( confirm( _this.data('confirm') ) ) {\n            var form = $('<form>', {\n                method: 'POST',\n                action: _this.data('action')\n            });\n\n            form.append($('<input>', {\n                type: 'hidden',\n                name: '_method',\n                value: _this.data('method').toUpperCase()\n            }));\n            form.append($('<input>', {\n                type: 'hidden',\n                name: '_token',\n                value: window.Laravel.csrfToken\n            }));\n\n            form.appendTo('body');\n            form.submit();\n        } else {\n            _this.trigger('blur');\n        }\n    });\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL21hbmFnZV91c2Vycy5qcz82YjQ1Il0sInNvdXJjZXNDb250ZW50IjpbIiQoZnVuY3Rpb24gKCkge1xuICAgIGNvbnN0IGFwaVVybCA9IExhcmF2ZWwuYXBpVXJsO1xuXG4gICAgJCgnLm1kaS1jbG9zZS1jaXJjbGUtb3V0bGluZScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuICAgICAgICB2YXIgX3RoaXMgPSAkKHRoaXMpO1xuICAgICAgICB2YXIgY29uZmlybWF0aW9uID0gY29uZmlybShfdGhpcy5kYXRhKCdjb25maXJtJykpO1xuXG4gICAgICAgIGlmICggY29uZmlybWF0aW9uICkge1xuICAgICAgICAgICAgdmFyIHVzZXIgPSBfdGhpcy5kYXRhKCd1c2VyLWlkJyksXG4gICAgICAgICAgICAgICAgcm9sZSA9IF90aGlzLmRhdGEoJ3JvbGUtaWQnKTtcblxuICAgICAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgICAgICBjYWNoZTogZmFsc2UsXG4gICAgICAgICAgICAgICAgbWV0aG9kOiAnREVMRVRFJyxcbiAgICAgICAgICAgICAgICB1cmw6IGFwaVVybCArICcvbWFuYWdlL3VzZXJzLycgKyB1c2VyICsgJy9yb2xlcy8nICsgcm9sZSxcbiAgICAgICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhLCB0ZXh0U3RhdHVzLCBqcVhIUikge1xuICAgICAgICAgICAgICAgICAgICBfdGhpcy5wYXJlbnQoKS5mYWRlT3V0KCdtZWRpdW0nLCBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICQodGhpcykucmVtb3ZlKCk7XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAkKCcjdXNlci0nICsgdXNlcikuZmluZCgnYnV0dG9uJykuZGF0YSgndXNlci1yb2xlcycsIGRhdGEucm9sZXMpO1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgZXJyb3I6IGZ1bmN0aW9uKGpxWEhSLCB0ZXh0U3RhdHVzLCBlcnJvclRocm93bikge1xuICAgICAgICAgICAgICAgICAgICBfdGhpcy5wYXJlbnQoKS5hZGRDbGFzcygnYW5pbWF0ZWQgc2hha2UnKTtcbiAgICAgICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIF90aGlzLnBhcmVudCgpLnJlbW92ZUNsYXNzKCdhbmltYXRlZCBzaGFrZScpO1xuICAgICAgICAgICAgICAgICAgICB9LCAxMDAwKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgIH0pO1xuXG4gICAgJCgnI3JvbGVzTW9kYWwnKS5vbignc2hvdy5icy5tb2RhbCcsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgdmFyIGZvcm0gPSAkKHRoaXMpLmZpbmQoJ2Zvcm0nKSxcbiAgICAgICAgICAgIGJ1dHRvbiA9ICQoZS5yZWxhdGVkVGFyZ2V0KSxcbiAgICAgICAgICAgIHVzZXJJZCA9IGJ1dHRvbi5kYXRhKCd1c2VyLWlkJyksXG4gICAgICAgICAgICB1c2VyTmFtZSA9IGJ1dHRvbi5kYXRhKCd1c2VyLW5hbWUnKSxcbiAgICAgICAgICAgIHVzZXJSb2xlcyA9IGJ1dHRvbi5kYXRhKCd1c2VyLXJvbGVzJyk7XG4gICAgICAgICAgICBmb3JtLmF0dHIoJ2FjdGlvbicsIGZvcm0uZGF0YSgnYWN0aW9uLWJhc2UnKSArICcvJyArIHVzZXJJZCk7XG4gICAgICAgICAgICAkKHRoaXMpLmZpbmQoJ2g0Lm1vZGFsLXRpdGxlID4gc3Ryb25nJykudGV4dCh1c2VyTmFtZSk7XG4gICAgICAgICAgICBpZiAoIHVzZXJSb2xlcyApIHtcbiAgICAgICAgICAgICAgICBfLmVhY2godXNlclJvbGVzLCBmdW5jdGlvbihyb2xlKSB7XG4gICAgICAgICAgICAgICAgICAgIGZvcm0uZmluZCgnaW5wdXRbdHlwZT1cImNoZWNrYm94XCJdW25hbWU9XCJyb2xlc1tdXCJdW3ZhbHVlPVwiJyArIHJvbGUuaWQgKyAnXCJdJykucHJvcCgnY2hlY2tlZCcsIHRydWUpO1xuICAgICAgICAgICAgICAgICAgICBpZiAoIHJvbGUuem9vICkge1xuICAgICAgICAgICAgICAgICAgICAgICAgZm9ybS5maW5kKCdzZWxlY3RbbmFtZT1cInJvbGVfJyArIHJvbGUuaWQgKyAnX3pvb1wiXScpLnZhbChyb2xlLnpvbyk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cblxuICAgIH0pO1xuICAgICQoJyNyb2xlc01vZGFsJykub24oJ2hpZGRlbi5icy5tb2RhbCcsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgdmFyIGZvcm0gPSAkKHRoaXMpLmZpbmQoJ2Zvcm0nKTtcblxuICAgICAgICBmb3JtLnRyaWdnZXIoJ3Jlc2V0Jyk7XG4gICAgICAgIGZvcm0uYXR0cignYWN0aW9uJywgJycpO1xuICAgICAgICAkKHRoaXMpLmZpbmQoJ2g0Lm1vZGFsLXRpdGxlID4gc3Ryb25nJykudGV4dCgnJyk7XG4gICAgfSk7XG5cbiAgICAvLyBEZWxldGUgYnV0dG9uIGNvbW5maXJtYXRpb24gYW5kIGNvbnNlcXVlbnQgUE9TVFxuICAgICQoJ2J1dHRvbltkYXRhLXRvZ2dsZT1cImFjdGlvblwiXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICB2YXIgX3RoaXMgPSAkKHRoaXMpO1xuXG4gICAgICAgIGlmICggY29uZmlybSggX3RoaXMuZGF0YSgnY29uZmlybScpICkgKSB7XG4gICAgICAgICAgICB2YXIgZm9ybSA9ICQoJzxmb3JtPicsIHtcbiAgICAgICAgICAgICAgICBtZXRob2Q6ICdQT1NUJyxcbiAgICAgICAgICAgICAgICBhY3Rpb246IF90aGlzLmRhdGEoJ2FjdGlvbicpXG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgZm9ybS5hcHBlbmQoJCgnPGlucHV0PicsIHtcbiAgICAgICAgICAgICAgICB0eXBlOiAnaGlkZGVuJyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnX21ldGhvZCcsXG4gICAgICAgICAgICAgICAgdmFsdWU6IF90aGlzLmRhdGEoJ21ldGhvZCcpLnRvVXBwZXJDYXNlKClcbiAgICAgICAgICAgIH0pKTtcbiAgICAgICAgICAgIGZvcm0uYXBwZW5kKCQoJzxpbnB1dD4nLCB7XG4gICAgICAgICAgICAgICAgdHlwZTogJ2hpZGRlbicsXG4gICAgICAgICAgICAgICAgbmFtZTogJ190b2tlbicsXG4gICAgICAgICAgICAgICAgdmFsdWU6IHdpbmRvdy5MYXJhdmVsLmNzcmZUb2tlblxuICAgICAgICAgICAgfSkpO1xuXG4gICAgICAgICAgICBmb3JtLmFwcGVuZFRvKCdib2R5Jyk7XG4gICAgICAgICAgICBmb3JtLnN1Ym1pdCgpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgX3RoaXMudHJpZ2dlcignYmx1cicpO1xuICAgICAgICB9XG4gICAgfSk7XG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL21hbmFnZV91c2Vycy5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);