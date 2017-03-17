(function ($) {

	$.shopme_media_uploader = $.shopme_media_uploader || {};

	$.shopme_media_uploader.init = function () {

		$('.uploader-upload-button').unbind('click').on('click', function (e) {
			$.shopme_media_uploader.add(e);
		});

		$('.uploader-config-button').unbind('click').on('click', function (e) {
			$.shopme_media_uploader.upload_config(e);
		});

		$('body').unbind('click').on('click', '.uploader-remove-preview', function (e) {
			$.shopme_media_uploader.remove(e);
		});

	}

	/*	Add Media File
	/* --------------------------------------------- */

	$.shopme_media_uploader.add = function (e) {
		e.preventDefault();

		var frame, el = $(e.target),
			selector = el.parents('.upload-wrap:first');

		if ( frame ) {
			frame.open();
			return;
		}

		// Create the media frame.
		frame = wp.media({
			multiple: false,
			title: el.data( 'title' ),
			button: {
				text: el.data( 'text' )
			}
		});

		frame.on( 'select', function() {

				var attachment = frame.state().get('selection').first();
					frame.close();

				var data = $(selector).find('.data').data();

				if ( data === undefined || data.mode === 'undefined' ) {
					data = {};
					data.mode = "image";
				}

				if (data.mode === 0) {
				} else {
					if ( data.mode !== false) {
						if (attachment.attributes.type !== data.mode) {
							if (attachment.attributes.subtype !== data.mode ) {
								return;
							}
						}
					}
				}

				$upload_input = selector.find( '.uploader-upload-input' ),
				dependence_id = $upload_input.attr('id');

				$upload_input.val(attachment.attributes.url);
				if ($('input[data-dependence="'+ dependence_id +'"]').length)
					$('input[data-dependence="'+ dependence_id +'"]').val( attachment.attributes.id );

				var thumbSrc = attachment.attributes.url;
				if ( typeof attachment.attributes.sizes !== 'undefined' && typeof attachment.attributes.sizes.thumbnail !== 'undefined' ) {
					thumbSrc = attachment.attributes.sizes.thumbnail.url;
				} else if ( typeof attachment.attributes.sizes !== 'undefined' ) {
					var height = attachment.attributes.height;

					for ( var key in attachment.attributes.sizes ) {
						var object = attachment.attributes.sizes[key];

						if ( object.height < height ) {
							height = object.height;
							thumbSrc = object.url;
						}
					}
				} else {
					thumbSrc = attachment.attributes.icon;
				}

				if ( !selector.find( '.uploader-upload-input' ).hasClass('noPreview') ) {
					selector.find('.preview-thumbnail-container')
						.empty()
						.hide()
						.append('<a href="#" class="uploader-remove-preview">Remove</a><img class="mad-option-image" alt="" src="' + thumbSrc + '">')
						.slideDown('fast');
				}

			}
		);

		frame.open();
	}

	/*	Remove Media File
	/* --------------------------------------------- */

	$.shopme_media_uploader.remove = function (e) {
		e.preventDefault();

		var $this = $(e.target),
			parent = $this.parents('.upload-wrap:first'),
			input = parent.children('.uploader-upload-input'),
			uploadId = parent.children('.upload-id'),
			thumbnail = parent.children('.preview-thumbnail-container');
			input.val('');
			uploadId.val('');
			thumbnail.slideUp(300);
	}

	/*	Upload Config
	/* --------------------------------------------- */

	$.shopme_media_uploader.upload_config = function (e) {
		e.preventDefault();

		var title  = 'Upload config file',
			data = $(e.target).data();

		tb_show( title, 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');

		window.send_to_editor = function (html) {
			var href = $(html).attr('href');
			data.href = href;

			if (href.match(".txt")) {
				$.ajax({
					type: "POST",
					url: data.url,
					data: data,
					beforeSend: function () { },
					error: function () {
						window.location.reload(true);
					},
					success: function (response) {
						if (response.match('madImportConfig')) {
							response = response.replace('madImportConfig', '');

							$('#mad-options-page').shopme_framework_popup({
								message: shopmeLocalize.importsuccessOptions,
								add_class: 'mad-message-success'
							}, function () {
								window.location.reload(true);
							});

						}
					},
					complete: function () {
						tb_remove();
					}
				});
			} else {
				tb_remove();
			}
		}
	}

	$(function () {
		$.shopme_media_uploader.init();
	});

})(jQuery);