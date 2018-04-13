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

eval("$(function () {\n    $('.mdi-close-circle-outline').on('click', function() {\n        var _this = $(this);\n        var confirmation = confirm(_this.data('confirm'));\n\n        if ( confirmation ) {\n            var user = _this.data('user-id'),\n                role = _this.data('role-id');\n\n            $.ajax({\n                cache: false,\n                method: 'DELETE',\n                url: '{{ url(\"/api/manage/users\") }}/' + user + '/roles/' + role,\n                success: function(data, textStatus, jqXHR) {\n                    _this.parent().fadeOut('medium', function() {\n                        $(this).remove();\n                    });\n                    $('#user-' + user).find('button').data('user-roles', data.roles);\n                },\n                error: function(jqXHR, textStatus, errorThrown) {\n                    _this.parent().addClass('animated shake');\n                    setTimeout(function() {\n                        _this.parent().removeClass('animated shake');\n                    }, 1000);\n                }\n            });\n        }\n    });\n\n    $('#rolesModal').on('show.bs.modal', function(e) {\n        var form = $(this).find('form'),\n            button = $(e.relatedTarget),\n            userId = button.data('user-id'),\n            userName = button.data('user-name'),\n            userRoles = button.data('user-roles');\n            form.attr('action', form.data('action-base') + '/' + userId);\n            $(this).find('h4.modal-title > strong').text(userName);\n            if ( userRoles ) {\n                _.each(userRoles, function(role) {\n                    form.find('input[type=\"checkbox\"][name=\"roles[]\"][value=\"' + role.id + '\"]').prop('checked', true);\n                    if ( role.zoo ) {\n                        form.find('select[name=\"role_' + role.id + '_zoo\"]').val(role.zoo);\n                    }\n                });\n            }\n\n    });\n    $('#rolesModal').on('hidden.bs.modal', function(e) {\n        var form = $(this).find('form');\n\n        form.trigger('reset');\n        form.attr('action', '');\n        $(this).find('h4.modal-title > strong').text('');\n    });\n\n    // Delete button comnfirmation and consequent POST\n    $('button[data-toggle=\"action\"]').on('click', function(e) {\n        e.preventDefault();\n        var _this = $(this);\n\n        if ( confirm( _this.data('confirm') ) ) {\n            var form = $('<form>', {\n                method: 'POST',\n                action: _this.data('action')\n            });\n\n            form.append($('<input>', {\n                type: 'hidden',\n                name: '_method',\n                value: _this.data('method').toUpperCase()\n            }));\n            form.append($('<input>', {\n                type: 'hidden',\n                name: '_token',\n                value: window.Laravel.csrfToken\n            }));\n\n            form.appendTo('body');\n            form.submit();\n        } else {\n            _this.trigger('blur');\n        }\n    });\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL21hbmFnZV91c2Vycy5qcz82YjQ1Il0sInNvdXJjZXNDb250ZW50IjpbIiQoZnVuY3Rpb24gKCkge1xuICAgICQoJy5tZGktY2xvc2UtY2lyY2xlLW91dGxpbmUnKS5vbignY2xpY2snLCBmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyIF90aGlzID0gJCh0aGlzKTtcbiAgICAgICAgdmFyIGNvbmZpcm1hdGlvbiA9IGNvbmZpcm0oX3RoaXMuZGF0YSgnY29uZmlybScpKTtcblxuICAgICAgICBpZiAoIGNvbmZpcm1hdGlvbiApIHtcbiAgICAgICAgICAgIHZhciB1c2VyID0gX3RoaXMuZGF0YSgndXNlci1pZCcpLFxuICAgICAgICAgICAgICAgIHJvbGUgPSBfdGhpcy5kYXRhKCdyb2xlLWlkJyk7XG5cbiAgICAgICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICAgICAgY2FjaGU6IGZhbHNlLFxuICAgICAgICAgICAgICAgIG1ldGhvZDogJ0RFTEVURScsXG4gICAgICAgICAgICAgICAgdXJsOiAne3sgdXJsKFwiL2FwaS9tYW5hZ2UvdXNlcnNcIikgfX0vJyArIHVzZXIgKyAnL3JvbGVzLycgKyByb2xlLFxuICAgICAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKGRhdGEsIHRleHRTdGF0dXMsIGpxWEhSKSB7XG4gICAgICAgICAgICAgICAgICAgIF90aGlzLnBhcmVudCgpLmZhZGVPdXQoJ21lZGl1bScsIGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5yZW1vdmUoKTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgICAgICQoJyN1c2VyLScgKyB1c2VyKS5maW5kKCdidXR0b24nKS5kYXRhKCd1c2VyLXJvbGVzJywgZGF0YS5yb2xlcyk7XG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICBlcnJvcjogZnVuY3Rpb24oanFYSFIsIHRleHRTdGF0dXMsIGVycm9yVGhyb3duKSB7XG4gICAgICAgICAgICAgICAgICAgIF90aGlzLnBhcmVudCgpLmFkZENsYXNzKCdhbmltYXRlZCBzaGFrZScpO1xuICAgICAgICAgICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgX3RoaXMucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ2FuaW1hdGVkIHNoYWtlJyk7XG4gICAgICAgICAgICAgICAgICAgIH0sIDEwMDApO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfSk7XG5cbiAgICAkKCcjcm9sZXNNb2RhbCcpLm9uKCdzaG93LmJzLm1vZGFsJywgZnVuY3Rpb24oZSkge1xuICAgICAgICB2YXIgZm9ybSA9ICQodGhpcykuZmluZCgnZm9ybScpLFxuICAgICAgICAgICAgYnV0dG9uID0gJChlLnJlbGF0ZWRUYXJnZXQpLFxuICAgICAgICAgICAgdXNlcklkID0gYnV0dG9uLmRhdGEoJ3VzZXItaWQnKSxcbiAgICAgICAgICAgIHVzZXJOYW1lID0gYnV0dG9uLmRhdGEoJ3VzZXItbmFtZScpLFxuICAgICAgICAgICAgdXNlclJvbGVzID0gYnV0dG9uLmRhdGEoJ3VzZXItcm9sZXMnKTtcbiAgICAgICAgICAgIGZvcm0uYXR0cignYWN0aW9uJywgZm9ybS5kYXRhKCdhY3Rpb24tYmFzZScpICsgJy8nICsgdXNlcklkKTtcbiAgICAgICAgICAgICQodGhpcykuZmluZCgnaDQubW9kYWwtdGl0bGUgPiBzdHJvbmcnKS50ZXh0KHVzZXJOYW1lKTtcbiAgICAgICAgICAgIGlmICggdXNlclJvbGVzICkge1xuICAgICAgICAgICAgICAgIF8uZWFjaCh1c2VyUm9sZXMsIGZ1bmN0aW9uKHJvbGUpIHtcbiAgICAgICAgICAgICAgICAgICAgZm9ybS5maW5kKCdpbnB1dFt0eXBlPVwiY2hlY2tib3hcIl1bbmFtZT1cInJvbGVzW11cIl1bdmFsdWU9XCInICsgcm9sZS5pZCArICdcIl0nKS5wcm9wKCdjaGVja2VkJywgdHJ1ZSk7XG4gICAgICAgICAgICAgICAgICAgIGlmICggcm9sZS56b28gKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBmb3JtLmZpbmQoJ3NlbGVjdFtuYW1lPVwicm9sZV8nICsgcm9sZS5pZCArICdfem9vXCJdJykudmFsKHJvbGUuem9vKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuXG4gICAgfSk7XG4gICAgJCgnI3JvbGVzTW9kYWwnKS5vbignaGlkZGVuLmJzLm1vZGFsJywgZnVuY3Rpb24oZSkge1xuICAgICAgICB2YXIgZm9ybSA9ICQodGhpcykuZmluZCgnZm9ybScpO1xuXG4gICAgICAgIGZvcm0udHJpZ2dlcigncmVzZXQnKTtcbiAgICAgICAgZm9ybS5hdHRyKCdhY3Rpb24nLCAnJyk7XG4gICAgICAgICQodGhpcykuZmluZCgnaDQubW9kYWwtdGl0bGUgPiBzdHJvbmcnKS50ZXh0KCcnKTtcbiAgICB9KTtcblxuICAgIC8vIERlbGV0ZSBidXR0b24gY29tbmZpcm1hdGlvbiBhbmQgY29uc2VxdWVudCBQT1NUXG4gICAgJCgnYnV0dG9uW2RhdGEtdG9nZ2xlPVwiYWN0aW9uXCJdJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIHZhciBfdGhpcyA9ICQodGhpcyk7XG5cbiAgICAgICAgaWYgKCBjb25maXJtKCBfdGhpcy5kYXRhKCdjb25maXJtJykgKSApIHtcbiAgICAgICAgICAgIHZhciBmb3JtID0gJCgnPGZvcm0+Jywge1xuICAgICAgICAgICAgICAgIG1ldGhvZDogJ1BPU1QnLFxuICAgICAgICAgICAgICAgIGFjdGlvbjogX3RoaXMuZGF0YSgnYWN0aW9uJylcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICBmb3JtLmFwcGVuZCgkKCc8aW5wdXQ+Jywge1xuICAgICAgICAgICAgICAgIHR5cGU6ICdoaWRkZW4nLFxuICAgICAgICAgICAgICAgIG5hbWU6ICdfbWV0aG9kJyxcbiAgICAgICAgICAgICAgICB2YWx1ZTogX3RoaXMuZGF0YSgnbWV0aG9kJykudG9VcHBlckNhc2UoKVxuICAgICAgICAgICAgfSkpO1xuICAgICAgICAgICAgZm9ybS5hcHBlbmQoJCgnPGlucHV0PicsIHtcbiAgICAgICAgICAgICAgICB0eXBlOiAnaGlkZGVuJyxcbiAgICAgICAgICAgICAgICBuYW1lOiAnX3Rva2VuJyxcbiAgICAgICAgICAgICAgICB2YWx1ZTogd2luZG93LkxhcmF2ZWwuY3NyZlRva2VuXG4gICAgICAgICAgICB9KSk7XG5cbiAgICAgICAgICAgIGZvcm0uYXBwZW5kVG8oJ2JvZHknKTtcbiAgICAgICAgICAgIGZvcm0uc3VibWl0KCk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBfdGhpcy50cmlnZ2VyKCdibHVyJyk7XG4gICAgICAgIH1cbiAgICB9KTtcbn0pO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvbWFuYWdlX3VzZXJzLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);