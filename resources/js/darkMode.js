//  Mirror the current state of the OS
exports.refresh = function() {
    if (exports.listen.matches) {
        exports.set(true);
    } else {
        exports.set(false);
    }
}

// Returns whether the OS has dark mode enabled or not
exports.listen = window.matchMedia('(prefers-color-scheme: dark)');

// Enable listening to the OS (will change when the OS changes)
exports.autoOn = function() {
    exports.listen.addListener(exports.refresh);
}

// Disable listening
exports.autoOff = function() {
    exports.listen.removeListener(exports.refresh);
}

exports.set = function(enableDarkMode) {
    if (enableDarkMode) {
        document.querySelector('html').classList.add('dark');
    } else {
        document.querySelector('html').classList.remove('dark');
    }
};

exports.get = function() {
    return document.querySelector('html').classList.contains('dark');
}

exports.on = function() {
    exports.set(true);
}

exports.off = function() {
    exports.set(false);
}
