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
/******/ 	return __webpack_require__(__webpack_require__.s = 14);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/manage_users.js":
/*!*********************************************!*\
  !*** ./resources/assets/js/manage_users.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var apiUrl = Laravel.apiUrl;
  $('.mdi-close-circle-outline').on('click', function () {
    var _this = $(this);

    var confirmation = confirm(_this.data('confirm'));

    if (confirmation) {
      var user = _this.data('user-id'),
          role = _this.data('role-id');

      $.ajax({
        cache: false,
        method: 'DELETE',
        url: apiUrl + '/manage/users/' + user + '/roles/' + role,
        success: function success(data, textStatus, jqXHR) {
          _this.parent().fadeOut('medium', function () {
            $(this).remove();
          });

          $('#user-' + user).find('button').data('user-roles', data.roles);
        },
        error: function error(jqXHR, textStatus, errorThrown) {
          _this.parent().addClass('animated shake');

          setTimeout(function () {
            _this.parent().removeClass('animated shake');
          }, 1000);
        }
      });
    }
  });
  $('#rolesModal').on('show.bs.modal', function (e) {
    var form = $(this).find('form'),
        button = $(e.relatedTarget),
        userId = button.data('user-id'),
        userName = button.data('user-name'),
        userRoles = button.data('user-roles');
    form.attr('action', form.data('action-base') + '/' + userId);
    $(this).find('h4.modal-title > strong').text(userName);

    if (userRoles) {
      _.each(userRoles, function (role) {
        form.find('input[type="checkbox"][name="roles[]"][value="' + role.id + '"]').prop('checked', true);

        if (role.zoo) {
          form.find('select[name="role_' + role.id + '_zoo"]').val(role.zoo);
        }
      });
    }
  });
  $('#rolesModal').on('hidden.bs.modal', function (e) {
    var form = $(this).find('form');
    form.trigger('reset');
    form.attr('action', '');
    $(this).find('h4.modal-title > strong').text('');
  }); // Delete button comnfirmation and consequent POST

  $('button[data-toggle="action"]').on('click', function (e) {
    e.preventDefault();

    var _this = $(this);

    if (confirm(_this.data('confirm'))) {
      var form = $('<form>', {
        method: 'POST',
        action: _this.data('action')
      });
      form.append($('<input>', {
        type: 'hidden',
        name: '_method',
        value: _this.data('method').toUpperCase()
      }));
      form.append($('<input>', {
        type: 'hidden',
        name: '_token',
        value: window.Laravel.csrfToken
      }));
      form.appendTo('body');
      form.submit();
    } else {
      _this.trigger('blur');
    }
  });
});

/***/ }),

/***/ 14:
/*!***************************************************!*\
  !*** multi ./resources/assets/js/manage_users.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/assets/js/manage_users.js */"./resources/assets/js/manage_users.js");


/***/ })

/******/ });