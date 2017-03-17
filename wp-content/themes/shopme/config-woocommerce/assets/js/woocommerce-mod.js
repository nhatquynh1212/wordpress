(function ($, window) {

	$.shopme_woocommerce_mod = $.shopme_woocommerce_mod || {};

	$.shopme_core_helpers = $.shopme_core_helpers || {};

	$.shopme_core_helpers.owlInOwl = function (container) {

		if (typeof container == 'undefined') { container = this.$element; }

		var $thumbs_carousel = $('.thumbs_carousel', container);

		if ($thumbs_carousel.length) {

			$thumbs_carousel.owlCarousel({
				responsive: {
					0:   { items: 3 },
					480: { items: 3 },
					992: { items: 3 }
				},
				margin: 10,
				themeClass: 'thumbnails_carousel',
				nav: true,
				navText: [],
				rtl: window.ISRTL ? true : false
			});

			$thumbs_carousel.off('change.owl.carousel');

		}

	}

	/*	Products Page Carousel
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.other_products = function () {

		if ($('.other_products').length) {

			var $other_products = $('.other_products'),
				$products = $('.products', $other_products),
				$columns = $other_products.data('columns') || 3,
				$dataSidebarPortrait = $other_products.data('sidebar') == 'no_sidebar' ? 3 : 2;

			$products.owlCarousel({
				responsive : {
					0 :   { items : 1 },
					487 : { items : $dataSidebarPortrait },
					992 : { items : $columns }
				},
				nav : true,
				navText : [],
				rtl: window.ISRTL ? true : false
			});

		}

	}
	/*	Products Page Carousel
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.products_page_carousel = function () {

		if ($('.products_page_carousel').length) {

			var $carousels = $('.products_page_carousel');

			if ($carousels.children().length > 1) {

				$carousels.each(function () {

					var $this = $(this);

					if ($this.children().length > 1) {

						var	$owl = $this.owlCarousel({
							items : 1,
							autoHeight : true,
							loop : true,
							nav : true,
							navText : [],
							themeClass : 'single_visible_element',
							rtl: window.ISRTL ? true : false,
							onInitialized: $.shopme_core_helpers.owlInOwl
						});

						$owl.off('change.owl.carousel');
					}

				});
			}

		}

	}

	/*	Cart Dropdown
	 /* --------------------------------------------- */

	$.shopme_woocommerce_mod.cart_dropdown = function () {
		({
			init: function () {
				var base = this;

				base.support = {
					touch : Modernizr.touch,
					transitions : Modernizr.csstransitions
				};
				base.eventtype = base.support.touch ? 'touchstart' : 'click';
				base.listeners();
			},
			listeners: function () {
				var base = this;

				base.track_ajax_refresh_cart(base);
				base.track_ajax_adding_to_cart();
				base.track_ajax_added_to_cart(base);
				base.track_ajax_refresh();

				base.scrollbar_cart();
				base.eventQty();
			},
			track_ajax_refresh: function() {
				var data = {
					'action': 'shopme_mode_theme_update_mini_cart'
				};
				$.post(
					woocommerce_params.ajax_url, data,
					function(response) {
						$('.widget_shopping_cart_content').html(response);
					}
				);
			},
			track_ajax_refresh_cart: function (base) {

				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: shopme_global.ajaxurl,
					data: {
						action: "refresh_cart_fragment"
					},
					success: function (response) {
						base.update_cart_fragment(response.fragments);
						$('body').trigger('wc_fragments_loaded');
					}
				});

				$('body').on('wc_fragments_refreshed wc_fragments_loaded', function (e) {

					base.ajax_remove_cart_item(base);

					$.shopme_dropdown_list.update('#header .dropdown-list', {
						speed : 10
					});
				});

			},
			track_ajax_adding_to_cart: function () {

				$('body').on('adding_to_cart', function (e, $thisbutton, $data) {
					e.preventDefault();

					$thisbutton.block({
						message: null,
						overlayCSS: {
							background: '#fff url(' + shopme_global.ajax_loader_url + ') no-repeat center',
							backgroundSize: '16px 16px',
							opacity: 0.6
						}}
					);

				});

			},
			track_ajax_added_to_cart: function (base) {

				$('body').on('added_to_cart', function (e, fragments, cart_hash, $thisbutton) {

					$thisbutton.unblock().hide();

					base.update_count_and_subtotal(fragments);
					base.update_cart_dropdown.call(base, e);

					$.shopme_dropdown_list.update('#header .dropdown-list', {
						speed : 10
					});
				});

			},
			update_count_and_subtotal: function (fragments) {
				$('.open_button').attr('data-amount', fragments.count).children('b.total_price').html(fragments.subtotal);
			},
			update_cart_dropdown: function (e) {
				this.ajax_remove_cart_item(this);
			},
			update_cart_fragment: function (fragments) {
				if ( fragments ) {
					$.each(fragments, function(key, value) {
						$(key).replaceWith(value);
					});
				}
			},
			ajax_remove_cart_item: function (base) {

				$('.shopping_cart .remove-product, .sc_product .remove-product').on(base.eventtype, function (e) {

					e.preventDefault();

					var $this = $(this),
						cart_id = $this.data("cart_id"),
						product_id = $this.data("product_id");

					$.ajax({
						type: 'POST',
						dataType: 'json',
						url: shopme_global.ajaxurl,
						data: {
							action: "cart_item_remove",
							_wpnonce: woocommerce_mod.nonce_cart_item_remove,
							cart_id: cart_id
						},
						success: function (response) {

							var fragments = response.fragments;

							if (fragments) {

								$this.parent().animate({
									opacity : 0
								}, function () {

									var $this = $(this),
										collection = $this.add($this.parent());

									collection.slideUp(350, function () {

										$this.remove();

										base.update_count_and_subtotal(fragments);
										base.update_cart_fragment(fragments);

										$('body').trigger('wc_fragments_refreshed');

										//  $('.viewcart-' + product_id).removeClass('added');
										//  $('.mad_eecart_item_' + cart_id).remove();

									});

								});

							}

						}
					});

				});

			},
			scrollbar_cart: function () {

				if ($('.shopping_cart.dropdown').length)
					$('.shopping_cart.dropdown').scrollbar();

			},
			eventQty: function () {

				$(document).on( 'click', '.plus, .minus', function () {

					// Get values
					var $qty		= $( this ).closest( '.qty' ).find( '.input-text' ),
						currentVal	= parseFloat( $qty.val() ),
						max			= parseFloat( $qty.attr( 'max' ) ),
						min			= parseFloat( $qty.attr( 'min' ) ),
						step		= $qty.attr( 'step' );

					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
					if ( max === '' || max === 'NaN' ) max = '';
					if ( min === '' || min === 'NaN' ) min = 0;
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

					// Change the value
					if ( $( this ).is( '.plus' ) ) {
						if ( max && ( max == currentVal || currentVal > max ) ) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}
					} else {
						if ( min && ( min == currentVal || currentVal < min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( currentVal - parseFloat( step ) );
						}
					}

					// Trigger change event
					$qty.trigger( 'change' );
				});

			}

		}.init());
	}

	/*	Custom ScrollBar
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.set_custom_scroll_bar = function () {
		var scroll = $('.custom-scrollbar');
		if (scroll.length) {
			if (scroll.is(':visible')) {
				scroll.scrollbar();
			}
		}
	}

	/*	Elevate Zoom
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.zoom = function () {

		if ($('.single_product.images').length) {

			$.shopme_woocommerce_mod.getGalleryList = function () {

				var gallerylist = [],
					gallery = 'product_preview';

				$('.' + gallery + ' a').each(function () {

					var img_src = '';

					if ($(this).data("zoom-image")) {
						img_src = $(this).data("zoom-image");
					} else if($(this).data("image")){
						img_src = $(this).data("image");
					}

					if (img_src) {
						gallerylist.push({
							href: '' + img_src + '',
							title: $(this).find('img').attr("title")
						});
					}

				});

				return gallerylist;
			}

			if ($('.image_preview_container').length) {

				var $image_preview_container = $('.image_preview_container');

				$image_preview_container.each(function () {

					var $this = $(this),
						unique_id = $this.data('id');

					if ($('#img_zoom', $this).length) {
						$('#img_zoom', $this).elevateZoom({
							zoomType: "inner",
							gallery: 'thumbnails_' + unique_id,
							galleryActiveClass: 'active',
							cursor: "crosshair",
							responsive: true,
							easing: true,
							zoomWindowFadeIn: 500,
							zoomWindowFadeOut: 500,
							lensFadeIn: 500,
							lensFadeOut: 500
						});
					}

				});

			}

			if ($('.open_qv').length) {

				$('.open_qv').on("click", function (e) {

					e.preventDefault();

					var galleryList, galleryObj = [];

					if ($('#img_zoom').length) {

						var $this = $(this),
							ez = $this.prev('img').data('elevateZoom');

						galleryList = ez.getGalleryList();

					} else {
						galleryList = $.shopme_woocommerce_mod.getGalleryList();
					}

					$.each(galleryList, function (idx, value) {
						var image = {};
							image['src'] = value.href;
							image['type'] = 'image';
							galleryObj.push(image);
					});

					if (galleryObj.length == 0) {
						var image = {};
							image['src'] = $(this).attr('href');
							image['type'] = 'image';
							galleryObj.push(image);
					}

					$.magnificPopup.open({
						items: galleryObj,
						type: 				'image',
						mainClass: 			'mfp-fade-in',
						removalDelay: 		300,
						closeBtnInside: 	true,
						closeOnContentClick:true,
						midClick: 			true,
						fixedContentPos: 	false,
						gallery: {
							tCounter:	'%curr% / %total%',
							enabled:	true,
							preload:	[1,1]
						},
						callbacks: {
							open: function() {
								var self = this;

								$.magnificPopup.instance.next = function() {
									self.wrap.removeClass('mfp-image-loaded');
									setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 80);
								}
								$.magnificPopup.instance.prev = function() {
									self.wrap.removeClass('mfp-image-loaded');
									setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 80);
								}
							},
							imageLoadComplete: function() {
								var self = this;
								setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 15);
							}
						}
					});

				});

			}
		}

	}

	/*	Specials Carousel
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.specials_carousel = function () {

		var $widget_specials_carousel = $('.widget-specials-carousel');

		if ($widget_specials_carousel.length) {

			$widget_specials_carousel.each(function () {

				var $this = $(this),
					$products = $('div.products', $this),
					autoplay = $this.data('autoplay') ? true : false,
					autoplayTimeout = $this.data('autoplaytimeout') ? $this.data('autoplaytimeout') : 5000,
					$owl = $products.owlCarousel({
						responsive : {
							0 :   { items : 1 },
							480 : { items : 2 },
							768 : { items : 1 },
							992 : { items : 1 }
						},
						autoHeight : true,
						autoplay: autoplay,
						autoplayTimeout: autoplayTimeout,
						autoplayHoverPause: true,
						loop : true,
						nav : true,
						navText : [],
						themeClass : 'single_visible_element',
						rtl: window.ISRTL ? true : false
					});

				$owl.off('change.owl.carousel');

			});

		}

	}

	/*	Product Carousel
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.product_filter_styles = function () {

		var $products_container = $('.products-container.view-grid').not('.widget-specials-carousel');

		if ($products_container.length) {

			$products_container.each(function () {

				var $this = $(this),
					$products = $('div.products', $this),
					$dataColumns = $this.data('columns') || 3,
					$dataSidebarPortrait = $this.data('sidebar') == 'no_sidebar' ? 3 : 2;

				if ($this.hasClass('owl_carousel')) {

					$products
						.on('initialized.owl.carousel resized.owl.carousel', $.shopme_core_helpers.sameheight)
						.on('initialized.owl.carousel translated.owl.carousel', $.shopme_core_helpers.owlGetVisibleElements);

					$products.owlCarousel({
						responsive : {
							0 :   { items : 1 },
							480 : { items : $dataSidebarPortrait },
							992 : { items : $dataColumns }
						},
						nav : true,
						navText : [],
						rtl: window.ISRTL ? true : false,
						onInitialized: function () {

							var base = this,
								$element = base.$element,
								items = {},
								$filter = $('.product-filter', $this);

							$.each(base._items, function (idx, value) {
								items[idx] = value.children();
							});

							$filter.on('click', 'li', function (e) {
								var	$this = $(this),
									dataFilter = $this.children().data('filter');

								e.preventDefault();

								if ($this.is('.active')) return;

								$element.addClass('changed').animate({
									opacity : 0
								}, 200, function () {

									var dataHTML = '';

									if (dataFilter == "*") {
										$.each(items, function (i, v) {
											dataHTML += v.parent().html();
										});
									} else {
										$.each(items, function (i, v) {
											var element = $(v);
											if (element.hasClass(dataFilter)) {
												dataHTML += v.parent().html();
											}
										});
									}

									if (dataHTML.length == '') { return; }

									$element
										.on('initialized.owl.carousel resized.owl.carousel refresh.owl.carousel', $.shopme_core_helpers.sameheight)
										.on('initialized.owl.carousel translated.owl.carousel refresh.owl.carousel', $.shopme_core_helpers.owlGetVisibleElements)
										.trigger('replace.owl.carousel', dataHTML)
										.trigger('refresh.owl.carousel')
										.removeClass('changed')
										.animate({ opacity: 1 }, 200);

								});

								$this.closest('li').addClass('active').siblings().removeClass('active');

							});

						}

					});

				} else {

					var $element = $products,
						items = {},
						$filter = $('.product-filter', $this);

					$.each($element.children(), function (idx, value) {
						items[idx] = $(value);
					});

					$filter.on('click', 'li', function () {
						var	$this = $(this),
							dataFilter = $this.children().data('filter');

						if ($this.is('.active')) return;

						$element.addClass('changed').animate({
							opacity : 0
						}, 200, function () {

							var dataHTML = '';

							if (dataFilter == "*") {

								$.each(items, function (i, v) {
									var element = $(v), wrap = element.wrap('<div></div>');
									dataHTML += wrap.parent().html();
								});

							} else {
								$.each(items, function (i, v) {
									var element = $(v);

									if (element.hasClass(dataFilter)) {
										var wrap = element.wrap('<div></div>');
										dataHTML += wrap.parent().html();
									}
								});
							}

							if (dataHTML.length == '') { return; }

							$element.html(dataHTML).removeClass('changed').animate({ opacity: 1 }, 200 );

						});

						$this.closest('li').addClass('active').siblings().removeClass('active');

					});

				}

			});

		}

	}

	/*	Product Cards
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.product_cards = function () {

		var $products_cards = $('.product-cards-carousel.view-grid');

		if ( $products_cards.length ) {

			$products_cards.each(function () {

				var $this = $(this),
					$products = $('div.products-wrap', $this);

				if ( $this.hasClass('owl_carousel') ) {

					$products
						.on('initialized.owl.carousel resized.owl.carousel', $.shopme_core_helpers.sameheight)
						.on('initialized.owl.carousel translated.owl.carousel', $.shopme_core_helpers.owlGetVisibleElements);

					$products.owlCarousel({
						responsive : {
							0 :   { items : 1 },
							480 : { items : 1 },
							992 : { items : 1 }
						},
						nav : true,
						navText : [],
						rtl: window.ISRTL ? true : false,
						onInitialized: function () { }
					});

				}

			});

		}

	}

	/* Tabbed
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.tabbed = function () {

		if ($('[class*="tabs-holder"]').length) {

			var $tabsholder = $('[class*="tabs-holder"]');

			$tabsholder.each(function (i, val) {
				var $tabsNav = $('[class*="tabs-nav"]', val),
					eventtype = Modernizr.touch ? 'touchstart' : 'click';
				$tabsNav.on(eventtype, 'a', function (e) {
					e.preventDefault();

					var $this = $(this).parent('li'),
						$index = $this.index();

					if ($this.hasClass('active')) { e.preventDefault(); }

					$this.siblings()
						.removeClass('active')
						.end()
						.addClass('active')
						.parent()
						.next()
						.children('[class*="tab-content"]')
						.stop(true, true)
						.hide()
						.eq($index)
						.stop(true, true).fadeIn(800);
				});
			});
		}
	}

	/*	Related Carousel
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.related_carousel = function () {

		if ($('.related_products').length) {

			var $related_products = $('.related_products'),
				$products = $('.products', $related_products),
				$columns = $related_products.data('columns') || 4,
				$dataSidebarPortrait = $related_products.data('sidebar') == 'no_sidebar' ? 3 : 2;

			$products.owlCarousel({
				responsive : {
					0 :   { items : 1 },
					480 : { items : $dataSidebarPortrait },
					992 : { items : $columns }
				},
				nav : true,
				navText : [],
				rtl: window.ISRTL ? true : false
			});

		}

	}

	/*	Product Thumbs Carousel
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.thumbs_carousel = function () {

		if ($('.product_preview .thumbs_carousel').length) {

			var $thumbs_carousel = $('.product_preview .thumbs_carousel');

			var $owl = $thumbs_carousel.owlCarousel({
				responsive: {
					0 :   { items : 2 },
					480 : { items : 2 },
					992 : { items : 3 }
				},
				margin: 10,
				themeClass: 'thumbnails_carousel',
				nav: true,
				navText: [],
				rtl: window.ISRTL ? true : false
			});

			$owl.off('change.owl.carousel');

		}

	}

	/*	Change View Product
	/* --------------------------------------------- */

	$.changeView = function (options) {
		this.options = $.extend({}, $.changeView.DEFAULTS, options);
		this.init();
	}

	$.changeView.DEFAULTS = { }

	$.changeView.prototype = {
		init: function () {
			var base = this;
				base.body = $('body');
				base.support = {
					touch : Modernizr.touch
				};
				base.view = $('.list-or-grid');
				base.view.eventtype = base.support.touch ? 'touchstart' : 'click';
				base.event();
		},
		event: function () {
			this.view.on(this.view.eventtype, 'a', $.proxy(function (e) {
				this.load(e);
			}, this));
		},
		load: function (e) {
			e.preventDefault();

			var el = $(e.currentTarget),
				view = el.data('view'),
				container = el.closest('.products-container');
				el.siblings().removeClass('active').end().addClass('active');
				container.removeClass('view-grid list_view_products').addClass(view);
				$.cookie('mad_shop_view', view);
		}
	}

	/*	Go to Reviews
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.goto_review = function () {

		// Go to Reviews, write a Review
		$('.woocommerce-review-link, .woocommerce-write-review-link').on('click', function (e) {

			var $this = $(this), hash = $this.attr('href'), target = $(this.hash);

			if (target.length) {

				if (hash == '#reviews' || hash == '#commentform') {
					e.preventDefault();

					$('.tabs_nav li.reviews_tab a').trigger('click');

					setTimeout(function() {
						$('html, body').stop().animate({
							scrollTop: target.offset().top
						}, 600);
					}, 50);
				}

			}
		});

		var hash = window.location.hash;

		if ( hash == '#commentform' || hash == '#reviews' || hash.indexOf('#comment-') != -1 ) {

			setTimeout(function() {
				var target = $(hash);

				if (target.length) {

					if (hash == '#reviews' || hash == '#commentform' || hash.indexOf('#comment-') != -1) {
						$('.tabs_nav li.reviews_tab a').trigger('click');
					}

					$('html, body').stop().animate({
						scrollTop: target.offset().top - $.shopme_core.stickyMenu.sticky_height - $.shopme_core.stickyMenu.adminbar_height - 50
					}, 600);

				}
			}, 200);

		}

	}

	/*	Product Preview
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.product_preview = function () {

		var $product_preview = $('.product_preview[data-output]');

		if ($product_preview.length) {

			$product_preview.each(function (i, el) {

				var element = $(el),
					output = $(element.data('output'));

				element.find('[data-image]:first').addClass('active');

				element.on('click', '.elzoom', function (e) {

					e.preventDefault();

					var $this = $(this);

					if ($this.hasClass('active')) return;

					$this.parents('.thumbs_carousel').find('a').removeClass('active');
					$this.addClass('active');

					var src = $(this).data('image');

					if (output.length) {
						output.children('img').stop().animate({
							opacity : 0
						}, 250, function () {
							$(this).attr('src', src).stop().animate({ opacity : 1 });
						});
					}

				});

			});

		}

	}

	/*	Cart Variation
	 /* --------------------------------------------- */

	$.shopme_woocommerce_mod.check_cart_variation = function () {

		// wc_add_to_cart_variation_params is required to continue, ensure the object exists
		if ( typeof wc_add_to_cart_variation_params === 'undefined' )
			return false;

		$( '.variations_form' ).wc_variation_form();
		$( '.variations_form .variations select' ).change();

	}

	/*	Quick View
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.quick_view = function () {

		if ($('.quick-view').length) {
			new $.shopme_popup_prepare('.quick-view', {
				actionpopup: woocommerce_mod.action_quick_view,
				noncepopup: woocommerce_mod.nonce_quick_view_popup,
				on_load: function () {
					$.shopme_woocommerce_mod.check_cart_variation();
					$.shopme_woocommerce_mod.thumbs_carousel();
					$.shopme_woocommerce_mod.product_preview();
					$.shopme_woocommerce_mod.set_custom_scroll_bar();
				}
			});
		}

	}

	/*	Form Login
	 /* --------------------------------------------- */

	$.shopme_woocommerce_mod.form_login = function() {

		if ($('.to-login').length) {
			new $.shopme_popup_prepare('.to-login', {
				actionpopup: woocommerce_mod.action_login,
				noncepopup: woocommerce_mod.nonce_login_popup,
				on_load: function () {
					var base = this,
						href = $(base.el).data().href;

					$('form.login').ajaxForm({
						url: href,
						success: function() {
							base.closeModal();
							window.location.href = href;
						}
					});

				}
			});
		}

	}

	/*	Toggle Categories
	/* --------------------------------------------- */

	$.shopme_woocommerce_mod.dokan_toggle_category = function () {

		var $productCats = $('.dokan-category-menu');

		if ( $productCats.length ) {

			$productCats.find('li').each(function (idx, element) {
				if ($(element).children('.sub-category').length) {
					$(element).not('.active').children('.sub-category').hide();
				}
			});

			$productCats.on('click', '.caret', function (e) {
				e.preventDefault();
				var $self = $(e.target),
					$this = $self.parent('a').parent('li');
				if ($this.children('.sub-category').length) {
					$this.toggleClass('active').children('.sub-category').slideToggle(700, 'easeInOutQuart');
				}
			});

		}
	}

	/*	LOAD READY
	/* --------------------------------------------- */

	$(window).load(function () {

		$.shopme_core_helpers.owlInOwl('.single_product.images');

		$.shopme_woocommerce_mod.product_filter_styles();
		$.shopme_woocommerce_mod.product_cards();
		$.shopme_woocommerce_mod.products_page_carousel();
		$.shopme_woocommerce_mod.related_carousel();
		$.shopme_woocommerce_mod.other_products();
		$.shopme_woocommerce_mod.specials_carousel();

	});

	/*	DOM READY
	/* --------------------------------------------- */

	$(function () {

		$.shopme_woocommerce_mod.cart_dropdown();
		$.shopme_woocommerce_mod.quick_view();
		$.shopme_woocommerce_mod.form_login();
		$.shopme_woocommerce_mod.zoom();
		$.shopme_woocommerce_mod.tabbed();

		if ($('.list-or-grid').length) { new $.changeView(); }

		$.shopme_woocommerce_mod.product_preview();
		$.shopme_woocommerce_mod.goto_review();
		$.shopme_woocommerce_mod.dokan_toggle_category();

	});

})(jQuery, window);

