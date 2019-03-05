// Images, svgs and fonts.
function requireAll(r) {
	r.keys().forEach(r);
}
requireAll(require.context('../images/', true, /\.(png|jpg|gif)$/));
requireAll(require.context('../svgs/', true, /\.(svg)$/));
requireAll(require.context('../fonts/', true, /\.(woff(2)?|ttf|eot)$/));

// JS
import userAgentClasses from './modules/user-agent-classes.js';

// Run
userAgentClasses();

// Map jQuery to $.
window.jQuery = window.$ = jQuery;

// Modules.
import {
	deBounce,
	isHighDensity,
	isRetina,
	compareRetina,
	compareBreakpoint,
} from './modules/utils.js';
import trackFocus from './modules/track-focus.js';
import skipLink from './modules/skip-link.js';
import styleGuide from './modules/style-guide.js';
import initResponsiveBackgroundImages from './modules/rwd-bg-images.js';

// Ready.
window.addEventListener('DOMContentLoaded', function() {
	trackFocus(document.body);
	skipLink();
	styleGuide();
	initResponsiveBackgroundImages($);
});

// Load.
window.addEventListener('load', function() {
	responsiveBackgroundImages('.js-bg-img');
});

// Resize
window.addEventListener(
	'resize',
	deBounce(() => {
		responsiveBackgroundImages('.js-bg-img');
	}, 100),
);
