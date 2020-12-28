/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/darkMode.js":
/*!**********************************!*\
  !*** ./resources/js/darkMode.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, exports) => {

//  Mirror the current state of the OS
exports.refresh = function () {
  if (exports.listen.matches) {
    exports.set(true);
  } else {
    exports.set(false);
  }
};

exports.update = function (value) {
  if (value === 'light') {
    exports.autoOff();
    exports.off();
  } else if (value === 'dark') {
    exports.autoOff();
    exports.on();
  } else {
    exports.refresh();
    exports.autoOn();
  }
}; // Returns whether the OS has dark mode enabled or not


exports.listen = window.matchMedia('(prefers-color-scheme: dark)'); // Enable listening to the OS (will change when the OS changes)

exports.autoOn = function () {
  exports.listen.addListener(exports.refresh);
}; // Disable listening


exports.autoOff = function () {
  exports.listen.removeListener(exports.refresh);
};

exports.set = function (enableDarkMode) {
  if (enableDarkMode) {
    document.querySelector('html').classList.add('dark');
  } else {
    document.querySelector('html').classList.remove('dark');
  }
};

exports.get = function () {
  return document.querySelector('html').classList.contains('dark');
};

exports.on = function () {
  exports.set(true);
};

exports.off = function () {
  exports.set(false);
};

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
(() => {
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
window.darkMode = __webpack_require__(/*! ./darkMode */ "./resources/js/darkMode.js");
})();

/******/ })()
;