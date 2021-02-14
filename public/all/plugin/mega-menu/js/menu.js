/*!
	WLC - Bootstrap Mega Menu (https://wlcunited.com) Copyright 2016 - 2019 WLC United. All Rights Reserved.
	Licensed under Regular License (http://codecanyon.net/licenses/regular) or Extended License (http://codecanyon.net/licenses/extended)
	We will take legal action against those who copy our HTML content, CSS style sheets and JavaScript functions without a license.
*/

// WLC Menu
window.bmm = {};

// Functions
window.bmm.fn = {
	getOptions: function(opts) {
		if (typeof(opts) == 'object') {
			return opts;
		}
		
		else if (typeof(opts) == 'string') {
			try {
				return JSON.parse(opts.replace(/'/g,'"').replace(';',''));
			} catch(e) {
				return {};
			}
		}
		
		else {
			return {};
		}
	}
};

// Animate
(function(bmm, $) {
	bmm = bmm || {};
	var instanceName = '__animate';
	var PluginAnimate = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginAnimate.defaults = {
		accX: 0,
		accY: -80,
		delay: 100,
		duration: '750ms'
	};

	PluginAnimate.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) {
				return this;
			}
			
			this.$el = $el;
			this
				.setData()
				.setOptions(opts)
				.build();
				
			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);
			
			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginAnimate.defaults, opts, {
				wrapper: this.$el
			});
			
			return this;
		},

		build: function() {
			var self = this,
			
			$el = this.options.wrapper,
			delay = 0,
			duration = this.options.duration,
			elTopDistance = $el.offset().top,
			windowTopDistance = $(window).scrollTop();

			$el.addClass('appear-animation animated');

			if (!$('html').hasClass('no-csstransitions') && $(window).width() > 767 && elTopDistance > windowTopDistance) {
				$el.appear(function() {
					$el.one('animation:show', function(ev) {
						delay = ($el.attr('data-appear-animation-delay') ? $el.attr('data-appear-animation-delay') : self.options.delay);
						duration = ($el.attr('data-appear-animation-duration') ? $el.attr('data-appear-animation-duration') : self.options.duration);
						
						if (duration != '750ms') {
							$el.css('animation-duration', duration);
						}
						
						$el.css('animation-delay', delay + 'ms');
						$el.addClass($el.attr('data-appear-animation') + ' appear-animation-visible');
					});
					
					$el.trigger('animation:show');
				}, {
					accX: self.options.accX,
					accY: self.options.accY
				});
			}
			
			else {
				$el.addClass('appear-animation-visible');
			}
			
			return this;
		}
	};

	$.extend(bmm, {
		PluginAnimate: PluginAnimate
	});

	$.fn.bmmPluginAnimate = function(opts) {
		return this.map(function() {
			var $this = $(this);

			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			}
			
			else {
				return new PluginAnimate($this, opts);
			}
		});
	};
}).apply(this, [window.bmm, jQuery]);

// Match Height
(function(bmm, $) {
	bmm = bmm || {};
	var instanceName = '__matchHeight';
	var PluginMatchHeight = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginMatchHeight.defaults = {
		byRow: true,
		property: 'height',
		target: null,
		remove: false
	};

	PluginMatchHeight.prototype = {
		initialize: function($el, opts) {
			if ($el.data(instanceName)) {
				return this;
			}
			
			this.$el = $el;
			this
				.setData()
				.setOptions(opts)
				.build();
				
			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);
			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginMatchHeight.defaults, opts, {
				wrapper: this.$el
			});
			
			return this;
		},

		build: function() {
			if (!($.isFunction($.fn.matchHeight))) {
				return this;
			}
			
			var self = this;
			self.options.wrapper.matchHeight(self.options);
			return this;
		}
	};

	$.extend(bmm, {
		PluginMatchHeight: PluginMatchHeight
	});

	$.fn.bmmPluginMatchHeight = function(opts) {
		return this.map(function() {
			var $this = $(this);
			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			}
			
			else {
				return new PluginMatchHeight($this, opts);
			}
		});
	}
}).apply(this, [window.bmm, jQuery]);

// Scrollable
(function(bmm, $) {
	bmm = bmm || {};
	var instanceName = '__scrollable';
	var PluginScrollable = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginScrollable.defaults = {
		contentClass: 'scrollable-content',
		paneClass: 'scrollable-pane',
		sliderClass: 'scrollable-slider',
		alwaysVisible: true,
		preventPageScrolling: true
	};

	PluginScrollable.prototype = {
		initialize: function($el, opts) {
			if ( $el.data( instanceName ) ) {
				return this;
			}
			
			this.$el = $el;
			this
				.setData()
				.setOptions(opts)
				.build();
				
			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);
			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginScrollable.defaults, opts, {
				wrapper: this.$el
			});
			
			return this;
		},

		build: function() {
			this.options.wrapper.nanoScroller(this.options);
			return this;
		}
	};

	$.extend(bmm, {
		PluginScrollable: PluginScrollable
	});

	$.fn.bmmPluginScrollable = function(opts) {
		return this.each(function() {
			var $this = $(this);
			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			}
			
			else {
				return new PluginScrollable($this, opts);
			}
		});
	};
}).apply(this, [window.bmm, jQuery]);

// Sticky
(function(bmm, $) {
	bmm = bmm || {};
	
	var instanceName = '__sticky';
	var PluginSticky = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginSticky.defaults = {
		minWidth: 991,
		activeClass: 'sticky-active'
	};

	PluginSticky.prototype = {
		initialize: function($el, opts) {
			if ( $el.data( instanceName ) ) {
				return this;
			}
			
			this.$el = $el;
			this
				.setData()
				.setOptions(opts)
				.build()
				.events();
				
			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);
			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend(true, {}, PluginSticky.defaults, opts, {
				wrapper: this.$el
			});
			
			return this;
		},

		build: function() {
			if (!($.isFunction($.fn.pin))) {
				return this;
			}
			
			var self = this,
				$window = $(window);
				
			self.options.wrapper.pin(self.options);
			
			if( self.options.wrapper.hasClass('sticky-container-transparent') ) {
				self.options.wrapper.parent().addClass('position-absolute w-100');
			}

			$window.afterResize(function() {
				self.options.wrapper.removeAttr('style').removeData('pin');
				self.options.wrapper.pin(self.options);
				$window.trigger('scroll');
			});

			if( self.options.wrapper.find('img').attr('data-change-src') ) {
				var $logo      = self.options.wrapper.find('img'),
					logoSrc    = $logo.attr('src'),
					logoNewSrc = $logo.attr('data-change-src');

				self.changeLogoSrc = function(activate) {
					if(activate) {
						$logo.attr('src', logoNewSrc);
					}
					
					else {
						$logo.attr('src', logoSrc);
					}
				}
			}
			return this;
		},

		events: function() {
			var self = this,
				$window = $(window),
				$logo = self.options.wrapper.find('img'),
				sticky_activate_flag = true,
				sticky_deactivate_flag = false,
				class_to_check = ( self.options.wrapper.hasClass('sticky-container-effect-1') ) ? 'sticky-effect-active' : 'sticky-active';

			$window.on('scroll sticky.effect.active', function(){
				if( self.options.wrapper.hasClass( class_to_check ) ) {		
					if( sticky_activate_flag ) {			
						if( $logo.attr('data-change-src') ) {
							self.changeLogoSrc(true);
						}
						
						sticky_activate_flag = false;
						sticky_deactivate_flag = true;
					}
				}
				
				else {	
					if( sticky_deactivate_flag ) {				
						if( $logo.attr('data-change-src') ) {
							self.changeLogoSrc(false);
						}
						
						sticky_deactivate_flag = false;
						sticky_activate_flag = true;
					}
				}
			});

			var is_backing = false;
			if( self.options.stickyStartEffectAt ) {
				if( self.options.stickyStartEffectAt < $window.scrollTop() ) {
					self.options.wrapper.addClass('sticky-effect-active');
					$window.trigger('sticky.effect.active');
				}

				$window.on('scroll', function(){
					if( self.options.stickyStartEffectAt < $window.scrollTop() ) {	
						self.options.wrapper.addClass('sticky-effect-active');
						is_backing = true;
						$window.trigger('sticky.effect.active');
					}
					
					else {	
						if( is_backing ) {
							self.options.wrapper.find('.sticky-body').addClass('position-fixed');
							is_backing = false;
						}
						
						if( $window.scrollTop() == 0 ) {
							self.options.wrapper.find('.sticky-body').removeClass('position-fixed');
						}
						
						self.options.wrapper.removeClass('sticky-effect-active');
					}
				});
			}
		}
	};

	$.extend(bmm, {
		PluginSticky: PluginSticky
	});

	$.fn.bmmPluginSticky = function(opts) {
		return this.map(function() {
			var $this = $(this);
			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			}
			
			else {
				return new PluginSticky($this, opts);
			}
		});
	}
}).apply(this, [ window.bmm, jQuery ]);

// Sign in / Sign up
(function(bmm, $) {
	bmm = bmm || {};
	var initialized = false;
	$.extend(bmm, {
		Account: {
			defaults: {
				wrapper: $('#headerAccount')
			},

			initialize: function($wrapper, opts) {
				if (initialized) {
					return this;
				}
				
				initialized = true;
				
				this.$wrapper = ($wrapper || this.defaults.wrapper);
				this
					.setOptions(opts)
					.events();
					
				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts, bmm.fn.getOptions(this.$wrapper.data('plugin-options')));
				return this;
			},

			events: function() {
				var self = this;
				
				$(window).on('load', function(){
					$(document).ready(function(){
						setTimeout(function(){
							self.$wrapper.find('input').on('focus', function() {
								self.$wrapper.addClass('open');
								
								$(document).mouseup(function(e) {
									if (!self.$wrapper.is(e.target) && self.$wrapper.has(e.target).length === 0) {
										self.$wrapper.removeClass('open');
									}
								});
							});
						}, 1500);
					});
				});

				$('#headerSignUp').on('click', function(e) {
					e.preventDefault();
					self.$wrapper.addClass('signup').removeClass('signin').removeClass('recover');
					self.$wrapper.find('.signup-form input:first').focus();
				});

				$('#headerSignIn').on('click', function(e) {
					e.preventDefault();
					self.$wrapper.addClass('signin').removeClass('signup').removeClass('recover');
					self.$wrapper.find('.signin-form input:first').focus();
				});

				$('#headerRecover').on('click', function(e) {
					e.preventDefault();
					self.$wrapper.addClass('recover').removeClass('signup').removeClass('signin');
					self.$wrapper.find('.recover-form input:first').focus();
				});

				$('#headerRecoverCancel').on('click', function(e) {
					e.preventDefault();
					self.$wrapper.addClass('signin').removeClass('signup').removeClass('recover');
					self.$wrapper.find('.signin-form input:first').focus();
				});
			}
		}
	});
}).apply(this, [window.bmm, jQuery]);

// Navigation nav
(function(bmm, $) {
	bmm = bmm || {};

	var initialized = false;

	$.extend(bmm, {
		Nav: {
			defaults: {
				wrapper: $('#headerNavPrimary'),
				scrollDelay: 600,
				scrollAnimation: 'easeOutQuad'
			},

			initialize: function($wrapper, opts) {
				if (initialized) {
					return this;
				}

				initialized = true;
				this.$wrapper = ($wrapper || this.defaults.wrapper);
				this
					.setOptions(opts)
					.build()
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts, bmm.fn.getOptions(this.$wrapper.data('plugin-options')));
				return this;
			},

			build: function() {
				var self = this,
					$html = $('html'),
					$header = $('#header'),
					$headerNavMain = $('#header .header-nav-primary'),
					dropdownImagePreview;

				// Dropdown images
				self.$wrapper.find('a[data-dropdown-img]').each(function() {
					dropdownImagePreview = $('<span />').addClass('dropdown-img dropdown-img-preview')
						.append($('<span />').addClass('dropdown-img-container')
						.append($('<span />').addClass('dropdown-img-image').css('background-image', 'url(' + $(this).data('dropdown-img') + ')')
					));

					$(this).append(dropdownImagePreview);
				});

				// Sidebar (Reverse Dropdown)
				if($html.hasClass('sidebar') || $html.hasClass('sidebar-hamburger')) {
					
					// Sidebar Right
					if($html.hasClass('sidebar-right') || $html.hasClass('sidebar-hamburger-right')) {
						if(!$html.hasClass('sidebar-right-no-reverse')) {
							$header.find('.dropdown-submenu').addClass('dropdown-reverse');
						}
					}
				}
				
				else {
					
					// Reverse
					self.checkReverse = function() {
						self.$wrapper.find('.dropdown, .dropdown-submenu').removeClass('dropdown-reverse');

						self.$wrapper.find('.dropdown:not(.manual):not(.dropdown-full), .dropdown-submenu:not(.manual)').each(function() {
							if(!$(this).find('.dropdown-menu').visible( false, true, 'horizontal' )  ) {
								$(this).addClass('dropdown-reverse');
							}
						});
					}

					self.checkReverse();

	 				$(window).on('resize', function() {
						self.checkReverse();
	 				});
				}

				// Clone Items
				if($headerNavMain.hasClass('header-nav-primary-clone-items')) {

			    $headerNavMain.find('nav > ul > li > a').each(function(){
				   	var parent = $(this).parent(),
				   	
				   	clone  = $(this).clone(),
				   	clone2 = $(this).clone(),
				   	wrapper = $('<span class="wrapper-items-cloned"></span>');

				    $(this).addClass('item-original');
				    clone2.addClass('item-two');

				    parent.prepend(wrapper);
				    wrapper.append(clone).append(clone2);
				  });
				}

				// Floating
				if($('#header.header-floating-icons').get(0) && $(window).width() > 991) {

					var menuFloatingAnim = {
						$menuFloating: $('#header.header-floating-icons .header-container > .header-row'),

						build: function() {
							var self = this;

							self.init();
						},
						
						init: function(){
							var self  = this,
							
							divisor = 0;

							$(window).scroll(function() {
							  var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height()),
							  
							  st = $(this).scrollTop();

								divisor = $(document).height() / $(window).height();

							  self.$menuFloating.find('.header-column > .header-row').css({
							  	transform : 'translateY( calc('+ scrollPercent +'vh - '+ st / divisor +'px) )' 
							  });
							});
						}
					}

					menuFloatingAnim.build();
				}

				// Slide
				if($('.header-nav-links-vertical-slide').get(0)) {
					var slideNavigation = {
						$headerNavPrimary: $('#headerNavPrimary'),
						$headerNavPrimaryItem: $('#headerNavPrimary li'),

						build: function(){
							var self = this;

							self.menuNav();
						},
						
						menuNav: function(){
							var self = this;

							self.$headerNavPrimaryItem.on('click', function(e){
								var currentMenuItem 	= $(this),
									currentMenu = $(this).parent(),
									nextMenu = $(this).find('ul').first(),
									prevMenu = $(this).closest('.next-menu'),
									isSubMenu = currentMenuItem.hasClass('dropdown') || currentMenuItem.hasClass('dropdown-submenu'),
									isBack = currentMenuItem.hasClass('btn-back'),
									nextMenuHeightDiff = ( ( nextMenu.find('> li').length * nextMenu.find('> li').outerHeight() ) - nextMenu.outerHeight() ),
									prevMenuHeightDiff = ( ( prevMenu.find('> li').length * prevMenu.find('> li').outerHeight() ) - prevMenu.outerHeight() );

								if( isSubMenu ) {
									currentMenu.addClass('next-menu');
									nextMenu.addClass('visible');
									currentMenu.css({
										overflow: 'visible',
										'overflow-y': 'visible'
									});
									
									if( nextMenuHeightDiff > 0 ) {
										nextMenu.css({
											overflow: 'hidden',
											'overflow-y': 'scroll'
										});
									}

									for( i = 0; i < nextMenu.find('> li').length; i++ ) {
										if( nextMenu.outerHeight() < ($('.header-row-sidebar').outerHeight() - 100) ) {
											nextMenu.css({
												height: nextMenu.outerHeight() + nextMenu.find('> li').outerHeight()
											});
										}
									}

									nextMenu.css({
										'padding-top': nextMenuHeightDiff + 'px'
									});
								}

								if( isBack ) {
									currentMenu.parent().parent().removeClass('next-menu');
									currentMenu.removeClass('visible');

									if( prevMenuHeightDiff > 0 ) {
										prevMenu.css({
											overflow: 'hidden',
											'overflow-y': 'scroll'
										});
									}
								}

								e.stopPropagation();
							});
						}
					}

					$(window).trigger('resize');
					
					if( $(window).width() > 991 ) {
						slideNavigation.build();
					}

					$(document).ready(function(){
						$(window).afterResize(function(){
							if( $(window).width() > 991 ) {
								slideNavigation.build();
							}
						});
					});
				}

				// Header mobile dark layout
				if($('.header-nav-primary-mobile-dark').get(0)) {
					$('#header:not(.header-transparent-dark-bottom-border):not(.header-transparent-light-bottom-border)').addClass('header-no-border-bottom');
				}
				
				return this;
			},

			events: function() {
				var self    = this,
					$html   = $('html'),
					$header = $('#header'),
					$window = $(window),
					headerBodyHeight = $('.header-body').outerHeight();

				$header.find('a[href="#"]').on('click', function(e) {
					e.preventDefault();
				});

				// Arrows mobile
				$header.find('.dropdown-toggle, .dropdown-submenu > a')
					.append('<i class="pe-7s-angle-down"></i>');
				
				$header.find('.dropdown-toggle[href="#"], .dropdown-submenu a[href="#"], .dropdown-toggle[href!="#"] .pe-7s-angle-down, .dropdown-submenu a[href!="#"] .pe-7s-angle-down').on('click', function(e) {
					e.preventDefault();
					if ($window.width() < 992) {
						$(this).closest('li').toggleClass('open');

						var height = ( $header.hasClass('header-effect-shrink') && $html.hasClass('sticky-header-active') ) ? bmm.StickyHeader.options.headerStickyHeaderContainerHeight : headerBodyHeight;
						$('.header-body').animate({
					 		height: ($('.header-nav-primary nav').outerHeight(true) + height) + 10
					 	}, 0);
					}
				});

				$header.find('.header-nav-click-to-open .dropdown-toggle[href="#"], .header-nav-click-to-open .dropdown-submenu a[href="#"]').on('click', function(e) {
					e.preventDefault();
					if ($window.width() > 991) {

						if (!$(this).closest('li').hasClass('open')) {

							var $li = $(this).closest('li'),
								isSub = false;

							if ( $(this).parent().hasClass('dropdown-submenu') ) {
								isSub = true;
							}

							$(this).closest('.dropdown-menu').find('.dropdown-submenu.open').removeClass('open');
							$(this).parent('.dropdown').parent().find('.dropdown.open').removeClass('open');

							if (!isSub) {
								$(this).parent().find('.dropdown-submenu.open').removeClass('open');
							}

							$li.addClass('open');

							$(document).off('click.nav-click-to-open').on('click.nav-click-to-open', function (e) {
								if (!$li.is(e.target) && $li.has(e.target).length === 0) {
									$li.removeClass('open');
									$li.parents('.open').removeClass('open');
								}
							});

						}
						
						else {
							$(this).closest('li').removeClass('open');
						}

						$window.trigger('resize');
					}
				});

				// Collapse nav
				$header.find('[data-collapse-nav]').on('click', function(e) {
					$(this).parents('.collapse').removeClass('show');
				});

				// Extended features
				$header.find('.header-nav-extended-toggle').on('click', function(e) {
					e.preventDefault();

					var $toggleParent = $(this).parent();

					if (!$(this).siblings('.header-nav-extended-dropdown').hasClass('show')) {

						var $dropdown = $(this).siblings('.header-nav-extended-dropdown');

						$('.header-nav-extended-dropdown.show').removeClass('show');

						$dropdown.addClass('show');

						$(document).off('click.header-nav-extended-toggle').on('click.header-nav-extended-toggle', function (e) {
							if (!$toggleParent.is(e.target) && $toggleParent.has(e.target).length === 0) {
								$('.header-nav-extended-dropdown.show').removeClass('show');
							}
						});

						if ($(this).attr('data-focus')) {
							$('#' + $(this).attr('data-focus')).focus();
						}
					}
					
					else {
						$(this).siblings('.header-nav-extended-dropdown').removeClass('show');
					}
				});

				// Hamburger Menu
				var hamburgerMenuBtn = $('.hamburger-btn'),
				
				hamburgerSideHeader = $('#header.sidebar, #header.sidebar-overlay-full-screen');
				
				hamburgerMenuBtn.on('click', function(){
					if($(this).attr('data-set-active') != 'false') {
						$(this).toggleClass('active');
					}
					
					hamburgerSideHeader.toggleClass('sidebar-hidden');
					$html.toggleClass('sidebar-hidden');

					$window.trigger('resize');
				});

				$('.hamburger-close').on('click', function(){
					$('.hamburger-btn:not(.hamburger-btn-side-header-mobile-show)').trigger('click');
				});				
				
				// Header body height on mobile menu
				$('.header-nav-primary nav').on('show.bs.collapse', function () {
				 	$(this).removeClass('closed');

				 	// Mobile meu opened class
				 	$('html').addClass('mobile-menu-opened');

			 		$('.header-body').animate({
				 		height: ($('.header-body').outerHeight() + $('.header-nav-primary nav').outerHeight(true)) + 10
				 	});

				 	// Header below slider
				 	if( $('#header').is('.header-bottom-slider, .header-below-slider') && !$('html').hasClass('sticky-header-active') ) {
				 		self.scrollToTarget( $('#header'), 0 );
				 	}
				});

				// Header body height on collapse mobile menu
				$('.header-nav-primary nav').on('hide.bs.collapse', function () {
				 	$(this).addClass('closed');

				 	// Remove mobile menu opened class
				 	$('html').removeClass('mobile-menu-opened');

			 		$('.header-body').animate({
				 		height: ($('.header-body').outerHeight() - $('.header-nav-primary nav').outerHeight(true))
				 	}, function(){
				 		$(this).height('auto');
				 	});
				});

				// Header effect - shrink
				$window.on('stickyHeader.activate', function(){
					if( $window.width() < 992 && $header.hasClass('header-effect-shrink') ) {
						if( $('.header-btn-collapse-nav').attr('aria-expanded') == 'true' ) {
							$('.header-body').animate({
						 		height: ( $('.header-nav-primary nav').outerHeight(true) + bmm.StickyHeader.options.headerStickyHeaderContainerHeight ) + ( ($('.header-nav-bar').get(0)) ? $('.header-nav-bar').outerHeight() : 0 ) 
						 	});
						}
					}
				});

				$window.on('stickyHeader.deactivate', function(){
					if( $window.width() < 992 && $header.hasClass('header-effect-shrink') ) {
						if( $('.header-btn-collapse-nav').attr('aria-expanded') == 'true' ) {
							$('.header-body').animate({
						 		height: headerBodyHeight + $('.header-nav-primary nav').outerHeight(true) + 10
						 	});
						}
					}
				});

				// Sidebar - Header body height
				$(document).ready(function(){
					if( $window.width() > 991 ) {
						var flag = false;
						
						$window.on('resize', function(){
							if( $window.width() < 992 && flag == false ) {
								headerBodyHeight = $('.header-body').outerHeight();
								flag = true;

								setTimeout(function(){
									flag = false;
								}, 300);
							}
						});
					}
				});

				// Sidebar - Header height on mobile
				if( $html.hasClass('sidebar') ) {
					if( $window.width() < 992 ) {
						$header.css({
							height: $('.header-body .header-container').outerHeight() + (parseInt( $('.header-body').css('border-top-width') ) + parseInt( $('.header-body').css('border-bottom-width') ))
						});
					}

					$(document).ready(function(){
						$window.afterResize(function(){
							if( $window.width() < 992 ) {
								$header.css({
									height: $('.header-body .header-container').outerHeight() + (parseInt( $('.header-body').css('border-top-width') ) + parseInt( $('.header-body').css('border-bottom-width') ))
								});
							}
							
							else {
								$header.css({
									height: ''
								});
							}
						});
					});
				}

				// Anchors positions
				$('[data-hash]').each(function() {

					var target = $(this).attr('href'),
					
					offset = ($(this).is("[data-hash-offset]") ? $(this).data('hash-offset') : 0);

					if($(target).get(0)) {
						$(this).on('click', function(e) {
							e.preventDefault();

							if( !$(e.target).is('i') ) {

								// Close Collapse
								$(this).parents('.collapse.show').collapse('hide');

								self.scrollToTarget(target, offset);
							}

							return;
						});
					}
				});

				// Floating
				if($('#header.header-floating-icons').get(0)) {
					$('#header.header-floating-icons [data-hash]').off().each(function() {
						var target = $(this).attr('href'),
						
						offset = ($(this).is("[data-hash-offset]") ? $(this).data('hash-offset') : 0);

						if($(target).get(0)) {
							$(this).on('click', function(e) {
								e.preventDefault();

									$('html, body').animate({
										scrollTop: $(target).offset().top - offset
									}, 600, 'easeOutQuad', function() {

									});
								return;
							});
						}
					});
				}

				return this;
			},

			scrollToTarget: function(target, offset) {
				var self = this;

				$('body').addClass('scrolling');

				$('html, body').animate({
					scrollTop: $(target).offset().top - offset
				},
				
				self.options.scrollDelay, self.options.scrollAnimation, function() {
					$('body').removeClass('scrolling');
				});

				return this;
			}
		}
	});

}).apply(this, [window.bmm, jQuery]);

// Header sticky
(function(bmm, $) {
	bmm = bmm || {};

	var initialized = false;

	$.extend(bmm, {
		StickyHeader: {
			defaults: {
				wrapper: $('#header'),
				headerBody: $('#header .header-body'),
				headerStickyEnabled: true,
				headerStickyBoxedEnable: true,
				headerStickyMobileEnable: true,
				headerStickyStart: 0,
				headerStickyStartElement: false,
				headerStickySetTop: 0,
				headerStickyEffect: '',
				headerStickyHeaderContainerHeight: false,
				headerStickyLogoChange: false,
				headerStickyLogoChangeWrapper: true
			},

			initialize: function($wrapper, opts) {
				if (initialized) {
					return this;
				}

				initialized = true;
				this.$wrapper = ($wrapper || this.defaults.wrapper);

				this
					.setOptions(opts)
					.build()
					.events();

				return this;
			},

			setOptions: function(opts) {
				this.options = $.extend(true, {}, this.defaults, opts, bmm.fn.getOptions(this.$wrapper.data('plugin-options')));

				return this;
			},

			build: function() {
				if (!this.options.headerStickyBoxedEnable && $('html').hasClass('boxed') || $('html').hasClass('sidebar-hamburger') || !this.options.headerStickyEnabled) {
					return this;
				}

				var self = this,
					$html = $('html'),
					$window = $(window),
					sideHeader = $html.hasClass('sidebar'),
					initialHeaderTopHeight = self.options.wrapper.find('.header-top').outerHeight(),
					initialHeaderContainerHeight = self.options.wrapper.find('.header-container').outerHeight(),
					minHeight;

				$html.addClass('sticky-header-enabled');

				if (parseInt(self.options.headerStickySetTop) < 0) {
					$html.addClass('sticky-header-negative');
				}

				if(self.options.headerStickyStartElement) {

					var $headerStickyStartElement = $(self.options.headerStickyStartElement);

					$(window).on('scroll resize', function() {
						self.options.headerStickyStart = $headerStickyStartElement.offset().top;
					});

					$(window).trigger('resize');
				}

				// Define min height
				if( self.options.wrapper.find('.header-top').get(0) ) {
					minHeight = ( initialHeaderTopHeight + initialHeaderContainerHeight );
				}
				
				else {
					minHeight = initialHeaderContainerHeight;
				}

				// Wrapper min height
				if( !sideHeader ) {
					if( !$('.header-logo-sticky-change').get(0) ) {
						self.options.wrapper.css('height', self.options.headerBody.outerHeight());
					}
					
					else {
						$window.on('headerStickyLogoChange.loaded', function(){
							self.options.wrapper.css('height', self.options.headerBody.outerHeight());
						});
					}

					if( self.options.headerStickyEffect == 'shrink' ) {
						$(document).ready(function(){
							if( $window.scrollTop() >= self.options.headerStickyStart ) {
								self.options.wrapper.find('.header-container').on('transitionend webkitTransitionEnd oTransitionEnd', function(){
									self.options.headerBody.css('position', 'fixed');
								});
							}
							
							else {
								self.options.headerBody.css('position', 'fixed');
							}
						});

						self.options.wrapper.find('.header-container').css('height', initialHeaderContainerHeight);
						self.options.wrapper.find('.header-top').css('height', initialHeaderTopHeight);
					}
				}

				// Sticky header height
				if( self.options.headerStickyHeaderContainerHeight ) {
					self.options.wrapper.find('.header-container').css('height', self.options.wrapper.find('.header-container').outerHeight());
				}

				// Boxed layout
				if($html.hasClass('boxed') && self.options.headerStickyEffect == 'shrink') {
					if( (parseInt(self.options.headerStickyStart) == 0) && $window.width() > 991) {
						self.options.headerStickyStart = 30;
					}

					// Header body position
					self.options.headerBody.css('position','absolute');

					$window.on('scroll', function(){
						if( $window.scrollTop() > $('.body').offset().top ) {
							self.options.headerBody.css({
								'position' : 'fixed',
								'top' : 0
							});								
						}
						
						else {
							self.options.headerBody.css({
								'position' : 'absolute',
								'top' : 0
							});
						}
					});
				}

				// Check sticky header
				var activate_flag = true,
					deactivate_flag = false;

				self.checkStickyHeader = function() {
					if( $window.width() > 991 && $html.hasClass('sidebar') ) {
						$html.removeClass('sticky-header-active');
						activate_flag = true;
						
						return;
					}

					if ($window.scrollTop() >= parseInt(self.options.headerStickyStart)) {
						if( activate_flag ) {
							self.activateStickyHeader();
							activate_flag = false;
							deactivate_flag = true;
						}
					}
					
					else {
						if( deactivate_flag ) {
							self.deactivateStickyHeader();
							deactivate_flag = false;
							activate_flag = true;
						}
					}
				};
				
				// Activate sticky header
				self.activateStickyHeader = function() {

					if ($window.width() < 992) {
						if (!self.options.headerStickyMobileEnable) {
							self.deactivateStickyHeader();
							return;
						}
					}
					
					else {
						if (sideHeader) {
							self.deactivateStickyHeader();
							return;
						}
					}

					$html.addClass('sticky-header-active');

					// Sticky effect - Reveal
					if( self.options.headerStickyEffect == 'reveal' ) {

						self.options.headerBody.css('top','-' + self.options.headerStickyStart + 'px');

						self.options.headerBody.animate({
							top: self.options.headerStickySetTop
						}, 400, function() {});

					}

					// Sticky effect - Shrink
					if( self.options.headerStickyEffect == 'shrink' ) {

						// Header top
						if( self.options.wrapper.find('.header-top').get(0) ) {
							self.options.wrapper.find('.header-top').css({
								height: 0,
								'min-height': 0,
								overflow: 'hidden'
							});
						}

						// Header container
						if( self.options.headerStickyHeaderContainerHeight ) {
							self.options.wrapper.find('.header-container').css({
								height: self.options.headerStickyHeaderContainerHeight,
								'min-height': 0
							});
						}
						
						else {
							self.options.wrapper.find('.header-container').css({
								height: (initialHeaderContainerHeight / 3) * 2, // two third of container height
								'min-height': 0
							});

							var y = initialHeaderContainerHeight - ((initialHeaderContainerHeight / 3) * 2);
							$('.body').css({
								transform: 'translate3d(0, -'+ y +'px, 0)',
								transition: 'ease transform 500ms'
							});

							if($html.hasClass('boxed')) {
								self.options.headerBody.css('position','fixed');
							}
						}

					}

					self.options.headerBody.css('top', self.options.headerStickySetTop);

					if (self.options.headerStickyLogoChange) {
						self.changeLogo(true);
					}

					// Styles
					$('[data-sticky-header-style]').each(function() {
						var $el = $(this),
							css = bmm.fn.getOptions($el.data('sticky-header-style-active')),
							opts = bmm.fn.getOptions($el.data('sticky-header-style'));

						if( $window.width() > opts.minResolution ) {
							$el.css(css);
						}
					});

					$.event.trigger({
						type: 'stickyHeader.activate'
					});
				};

				// Disable sticky header
				self.deactivateStickyHeader = function() {

					$html.removeClass('sticky-header-active');

					// Sticky effect - Shrink
					if( self.options.headerStickyEffect == 'shrink' ) {

						// Boxed layout
						if( $html.hasClass('boxed') ) {

							// Header body position
							self.options.headerBody.css('position','absolute');

							if( $window.scrollTop() > $('.body').offset().top ) {
								
								// Header body position fixed
								self.options.headerBody.css('position','fixed');								
							}

						}
						
						else {
							self.options.headerBody.css('position','fixed');
						}

						// Header top
						if( self.options.wrapper.find('.header-top').get(0) ) {
							self.options.wrapper.find('.header-top').css({
								height: initialHeaderTopHeight,
								overflow: 'visible'
							});
						}

						// Header container
						self.options.wrapper.find('.header-container').css({
							height: initialHeaderContainerHeight
						});

					}

					self.options.headerBody.css('top', 0);

					if (self.options.headerStickyLogoChange) {
						self.changeLogo(false);
					}

					// Styles
					$('[data-sticky-header-style]').each(function() {
						var $el = $(this),
							css = bmm.fn.getOptions($el.data('sticky-header-style-deactive')),
							opts = bmm.fn.getOptions($el.data('sticky-header-style'));

						if( $window.width() > opts.minResolution ) {
							$el.css(css);
						}
					});

					$.event.trigger({
						type: 'stickyHeader.deactivate'
					});
				};

				// Always sticky
				if (parseInt(self.options.headerStickyStart) <= 0) {
					self.activateStickyHeader();
				}

				// Set logo
				if (self.options.headerStickyLogoChange) {
					var $logoWrapper = self.options.wrapper.find('.header-logo'),
						$logo = $logoWrapper.find('img'),
						logoWidth = $logo.attr('width'),
						logoHeight = $logo.attr('height'),
						logoSmallTop = parseInt($logo.attr('data-sticky-top') ? $logo.attr('data-sticky-top') : 0),
						logoSmallWidth = parseInt($logo.attr('data-sticky-width') ? $logo.attr('data-sticky-width') : 'auto'),
						logoSmallHeight = parseInt($logo.attr('data-sticky-height') ? $logo.attr('data-sticky-height') : 'auto');

					if (self.options.headerStickyLogoChangeWrapper) {
						$logoWrapper.css({
							'width': $logo.outerWidth(true),
							'height': $logo.outerHeight(true)
						});
					}

					self.changeLogo = function(activate) {
						if(activate) {
							
							$logo.css({
								'top': logoSmallTop,
								'width': logoSmallWidth,
								'height': logoSmallHeight
							});
						}
						
						else {
							$logo.css({
								'top': 0,
								'width': logoWidth,
								'height': logoHeight
							});
						}
					}

					$.event.trigger({
						type: 'headerStickyLogoChange.loaded'
					});
				}

				// Sidebar
				var headerBodyHeight,
				
				flag = false;

				self.checkSideHeader = function() {
					if($window.width() < 992 && flag == false) {
						headerBodyHeight = self.options.headerBody.height();
						flag = true;
					}

					if(self.options.headerStickyStart == 0 && sideHeader) {
						self.options.wrapper.css('min-height', 0);
					}

					if(self.options.headerStickyStart > 0 && sideHeader && $window.width() < 992) {
						self.options.wrapper.css('min-height', headerBodyHeight);
					}
				}

				return this;
			},

			events: function() {
				var self = this;

				if (!this.options.headerStickyBoxedEnable && $('body').hasClass('boxed') || $('html').hasClass('sidebar-hamburger') || !this.options.headerStickyEnabled) {
					return this;
				}

				if (!self.options.alwaysheaderStickyEnabled) {
					$(window).on('scroll resize', function() {
						self.checkStickyHeader();
					});
				}
				
				else {
					self.activateStickyHeader();
				}

				$(window).on('load resize', function(){
					self.checkSideHeader();
				});

				return this;
			}
		}
	});
}).apply(this, [window.bmm, jQuery]);