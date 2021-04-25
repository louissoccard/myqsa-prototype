window.darkMode = require('./darkMode');
require('./progressBars');
// window.data = require('./uiBoot');

document.onkeydown = function (event) {
    if ((event.ctrlKey || event.metaKey) && event.shiftKey && event.code === 'KeyD') {
        event.preventDefault();

        localStorage.removeItem('darkMode');
        window.darkMode.update();
    } else if ((event.ctrlKey || event.metaKey) && event.code === 'KeyD') {
        event.preventDefault();

        let darkModeValue = localStorage.getItem('darkMode');

        if (darkModeValue === null) {
            localStorage.setItem('darkMode', !window.darkMode.get());
            window.darkMode.toggle();
        } else {
            let parsed = JSON.parse(darkModeValue);
            localStorage.setItem('darkMode', !parsed);
            window.darkMode.update(!parsed ? 'dark' : 'light');
        }
    }
};
