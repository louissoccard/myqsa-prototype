var ProgressBar = require('progressbar.js');

function createProgressCircle(id, color) {
    if (document.querySelector(id) === null) { return null; }
    let bar = new ProgressBar.Circle(id, {
        color: color,
        strokeWidth: 6,
        easing: 'easeInOut',
        trailColor: 'currentColor',
        trailWidth: 2,
        text: {
            value: 0,
            style: {
                // Text color.
                // Default: same as stroke color (options.color)
                color: 'unset',
                'font-weight': '700',
                position: 'absolute',
                left: '50%',
                top: '50%',
                padding: 0,
                margin: 0,
                // You can specify styles which will be browser prefixed
                transform: {
                    prefix: true,
                    value: 'translate(-50%, -50%)'
                }
            },
        },

        duration: 1200,
        step: function (state, circle) {
            if (circle.text !== null) {
                circle.text.innerHTML = Math.floor(circle.value() * 100) + '%';
            }
        }
    });

    const text = document.querySelector(id + ' .progressbar-text');
    text.classList.add('text-grey-80');
    text.classList.add('dark:text-grey-5');
    text.classList.add('md:text-lg');

    const svg = document.querySelector(id + ' svg');
    svg.classList.add('text-grey-20');
    svg.classList.add('dark:text-grey-60');

    bar.animate(0.009);

    const barElement = document.querySelector(id);

    if (barElement.dataset.percentage !== undefined) {
        bar.animate(barElement.dataset.percentage / 100);
    }

    return bar;
}

window.addEventListener('DOMContentLoaded', () => {
    createProgressCircle('#membership-progress', '#003982');
    createProgressCircle('#nights-away-progress', '#00a794');
    createProgressCircle('#icv-progress', '#ffb4e5');
    createProgressCircle('#dofe-progress', '#ffe627');
});
