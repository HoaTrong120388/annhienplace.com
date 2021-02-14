/*!
	WLC - Bootstrap Mega Menu (https://wlcunited.com) Copyright 2016 - 2019 WLC United. All Rights Reserved.
	Licensed under Regular License (http://codecanyon.net/licenses/regular) or Extended License (http://codecanyon.net/licenses/extended)
	We will take legal action against those who copy our HTML content, CSS style sheets and JavaScript functions without a license.
*/

(function($) {
	'use strict';

	// Match Height
	if ($.isFunction($.fn['matchHeight'])) {

		$('.match-height').matchHeight();
	}
}).apply(this, [jQuery]);

(function($) {
	'use strict';
	
	// Animate
	if ($.isFunction($.fn['bmmPluginAnimate'])) {
		$(function() {
			$('[data-appear-animation]').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = bmm.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.bmmPluginAnimate(opts);
			});
		});
	}
}).apply(this, [jQuery]);

// Match Height
(function($) {
	'use strict';

	if ($.isFunction($.fn['bmmPluginMatchHeight'])) {
		$(function() {
			$('[data-plugin-match-height]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = bmm.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.bmmPluginMatchHeight(opts);
			});
		});
	}
}).apply(this, [jQuery]);

// Scrollable
(function($) {
	'use strict';

	if ( $.isFunction($.fn[ 'nanoScroller' ]) ) {
		$(function() {
			$('[data-plugin-scrollable]').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions) {
					opts = pluginOptions;
				}

				$this.bmmPluginScrollable(opts);
			});
		});
	}
}).apply(this, [jQuery]);

// Sticky
(function($) {
	'use strict';

	if ($.isFunction($.fn['bmmPluginSticky'])) {
		$(function() {
			$('[data-plugin-sticky]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = bmm.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.bmmPluginSticky(opts);
			});
		});
	}
}).apply(this, [jQuery]);

// Toggle
(function($) {
	'use strict';

	if ($.isFunction($.fn['bmmPluginToggle'])) {
		$(function() {
			$('[data-plugin-toggle]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = bmm.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.bmmPluginToggle(opts);
			});
		});
	}
}).apply(this, [jQuery]);

(function($) {
	'use strict';

	// Sticky Header
	if (typeof bmm.StickyHeader !== 'undefined') {
		bmm.StickyHeader.initialize();
	}

	// Nav Menu
	if (typeof bmm.Nav !== 'undefined') {
		bmm.Nav.initialize();
	}

	// Account
	if (typeof bmm.Account !== 'undefined') {
		bmm.Account.initialize();
	}
}).apply(this, [jQuery]);