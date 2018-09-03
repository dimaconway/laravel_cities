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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
/******/ })
/************************************************************************/
/******/ ({

/***/ 37:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(38);


/***/ }),

/***/ 38:
/***/ (function(module, exports) {

(function (window) {
    var marker = void 0;
    var map = void 0;
    var geocoder = void 0;

    var defaultOptions = {
        zoom: 4,
        center: { lat: 50, lng: 10 }
    };
    var cityOptions = {
        zoom: 10
    };

    window.init = function () {
        var options = void 0;

        var strLatitude = $('#latitude').val();
        var latitude = Number(strLatitude);
        var strLongitude = $('#longitude').val();
        var longitude = Number(strLongitude);

        var isLocationSet = strLatitude !== '' && !isNaN(latitude) && strLatitude !== '' && !isNaN(longitude);

        if (isLocationSet) {
            cityOptions.center = { lat: latitude, lng: longitude };
            options = cityOptions;
        } else {
            options = defaultOptions;
        }

        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('map'), options);

        if (isLocationSet) {
            marker = new google.maps.Marker({
                map: map,
                position: options.center
            });
        } else {
            marker = new google.maps.Marker();
        }
    };

    $(function () {
        $('#search-for-address').click(function (e) {
            e.preventDefault();

            var address = $('#address').val();

            geocoder.geocode({ 'address': address }, function (results, status) {
                marker.setMap(null);

                if (results.length > 0) {
                    cityOptions.center = results[0].geometry.location;
                    map.setOptions(cityOptions);

                    marker = new google.maps.Marker({
                        map: map,
                        position: cityOptions.center
                    });

                    $('#latitude').val(cityOptions.center.lat);
                    $('#longitude').val(cityOptions.center.lng);

                    $('#submit-button').prop("disabled", false);
                } else {
                    map.setOptions(defaultOptions);

                    $('#latitude').val('');
                    $('#longitude').val('');

                    $('#submit-button').prop("disabled", true);
                }
            });
        });
    });
})(window);

/***/ })

/******/ });