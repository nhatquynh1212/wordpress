(function ($) {

	$.shopme_composer_mod = $.shopme_composer_mod || {};

	$.shopme_composer_mod.close_button = function () {

		$('body').on('click.close_button', '.close', function (e) {
			e.preventDefault();

			$(this).parent('.vc_message_box').animate({
				opacity : 0
			},function () {
				var $this = $(this);
				$this.slideUp(function(){
					$this.remove();
				});
			});
		});

	}

	/*	Load															    */
	/* -------------------------------------------------------------------- */

	$(window).load(function () { });

	/*	DOM READY														    */
	/* -------------------------------------------------------------------- */

	$(function () {
		$.shopme_composer_mod.close_button();
	});

})(jQuery);