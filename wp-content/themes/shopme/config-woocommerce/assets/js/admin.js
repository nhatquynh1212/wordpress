(function ($) {
	$(function () {

		if ( $('#widgets-right select.shopme_chosen_select').length ) {
			$('#widgets-right select.shopme_chosen_select').chosen( { disable_search_threshold: 10, width: '100%' } );
		}

		$(document).on( 'widget-updated widget-added', function (widget, param) {

			if ( $('#widgets-right select.shopme_chosen_select').length ) {
				$('#widgets-right select.shopme_chosen_select').chosen({ disable_search_threshold: 10, width: '100%' });
			}

		});

	});
})(jQuery);