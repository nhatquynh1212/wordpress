(function ($) {

	$('form.newsletter').on('submit', function (e) {
		e.preventDefault();

		var $this = $(this),
			$submit = $this.find('button[type=submit]');

		$this.ajaxSubmit({
			type : 'POST',
			url	 : shopme_global.ajaxurl,
			data : {
				ajax_nonce : shopme_global.ajax_nonce,
				action : 'add_to_mailchimp_list'
			},
			timeout	: 10000,
			dataType: 'json',
			beforeSubmit: function () {
				$submit.block({
					message: null,
					overlayCSS: {
						background: '#fff url(' + shopme_global.ajax_loader_url + ') no-repeat center',
						backgroundSize: '16px 16px',
						opacity: 0.6
					}
				});
			},
			success	: function (responseText) {

				$this.find('div').remove();

				$alert =  $('<div></div>', {
					text : responseText.text,
					'class' : 'alert_box_error'
				});

				$this.append($alert).addClass('showed_message');

				$submit.unblock();
				$this.trigger('reset');
			}
		});
	});

})(jQuery);