(function ($, window) {

	"use strict";

	$(window).load(function () {

		/*	Owl Carousel
		 /* ------------------------------------------------------------------ */

		// required
		$('.owl_carousel:not(.widgets_carousel)')
			.on('initialized.owl.carousel resized.owl.carousel refresh.owl.carousel', $.shopme_core_helpers.sameheight)
			.on('initialized.owl.carousel translated.owl.carousel refresh.owl.carousel', $.shopme_core_helpers.owlGetVisibleElements);

		(function () {

			var $brands = $('.brands-logo-area');

			if ($brands.length) {

				$brands.each(function () {

					var $this = $(this),
						$carousel = $('.owl_carousel', $this),
						$dataSidebarPortrait = $this.data('sidebar') == 'no_sidebar' ? 4 : 3,
						$dataSidebarLandScape = $this.data('sidebar') == 'no_sidebar' ? 6 : 4;

					if ($carousel.length) {
						$carousel.owlCarousel({
							responsive : {
								0 :   { items : 2 },
								480 : { items : $dataSidebarPortrait },
								992 : { items : $dataSidebarLandScape }
							},
							autoplay: $this.data('autoplay') == true ? true : false,
							autoplayTimeout: $this.data('autoplay') == true ? $this.data('autoplaytimeout') : 5000,
							margin : 30,
							loop: true,
							nav : true,
							navText : [],
							rtl: window.ISRTL ? true : false
						});
					}

				});

			}

		})();

		(function () {

			if ($('.grid_view.owl_carousel').length) {

				var $carouselOfEntries = $('.grid_view.owl_carousel');

				$carouselOfEntries.each(function () {

					var $this = $(this),
						$parent = $this.parent();

					$this.owlCarousel({
						responsive : {
							0 : {
								items : 1
							},
							485 : {
								items : 2
							},
							992 : {
								items : $parent.data('columns') || 3
							}
						},
						nav : true,
						navText : [],
						rtl: window.ISRTL ? true : false
					});

				});

			}

		})();

		(function () {

			if ($('.widgets_carousel').length || $('.widget_rss > ul').length) {

				var $carousels = $('.widgets_carousel, .widget_rss > ul');

				$carousels.each(function () {

					var $this = $(this),
						length = $this.children().length;

					if (length > 1) {

						var	$owl = $this.owlCarousel({
							items : 1,
							autoHeight : true,
							loop : true,
							nav : true,
							navText : [],
							themeClass : 'single_visible_element',
							rtl: window.ISRTL ? true : false
						});

						$owl.off('change.owl.carousel');

					}

				});

			}

		})();

		(function () {

			if ( $('.entry .rating.readonly-rating').length ) {

				$('.entry .rating.readonly-rating').raty({
					readOnly: true,
					path: shopme_global.paththeme + '/images/img',
					score: function() {
						return $(this).attr('data-score');
					}
				});

			}

			if ( $('.entry .rating.rate').length ) {
				$('.entry .rating.rate').raty({
					path: shopme_global.paththeme + '/images/img',
					score: function () {
						return $(this).attr('data-score');
					}
				});
			}

		})();

	});

	$(function () {

		$.shopme_core.run({
			sticky: $('#header').data('shrink'),
			animated: true
		});

		/*	Custom Select
		 /* ------------------------------------------------------------------ */

		if ($('.custom_select').length) {
			$('.custom_select').shopme_custom_select();
		}

		/*  Dropdown List
		/* ------------------------------------------------------------------ */

		if ($('.dropdown-list').length) {
			$.shopme_dropdown_list.init();
		}

		window.ISRTL = getComputedStyle(document.body).direction === 'rtl';

		/*	Tabs
		/* ------------------------------------------------------------------ */

		if ($('.mad-tabs').length) {
			$('.mad-tabs').shopme_tabs();
		}

		/*	Aside Admin Panel												  */
		/* ------------------------------------------------------------------ */

		(function(){

			$('.panel-button').on('click',function () {
				$(this).parent().toggleClass('opened').siblings().removeClass('opened');
			});

			if ($('#contactform').length) {

				var $form = $('#contactform');
				$form.append('<div class="contact-form-responce" />');

				$form.each(function () {

					var $this = $(this),
						$response = $('.contact-form-responce', $this).append('<p></p>');

					$this.submit(function () {

						$.ajax({
							type: "POST",
							url: shopme_global.ajaxurl,
							dataType: 'json',
							data: {
								action: 'send_contact_form',
								values: $this.serialize(),
								_wpnonce: $this.data('nonce')
							},
							error: function (response) { },
							success: function (response) {

								var $text = $response.find('p').html('');

								if (response.status === 'error') {
									$.each(response.text, function (name, label) {
										$text.append(label + '</br>');
									});
									$response.removeClass('alert-success').addClass('alert-danger')
										.fadeIn(400)
										.delay(3000)
										.fadeOut(350);
								} else if (response.status === 'success') {
									$text.html('').html(response.text);
									$response.removeClass('alert-danger').addClass('alert-success')
										.fadeIn(400)
										.delay(3000)
										.fadeOut(350);
								}

								$this.trigger('reset');

							}

						});

						return false;

					});
				});

			}

		})();

	});

}(jQuery, window));