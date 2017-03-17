<?php

/* ---------------------------------------------------------------------- */
/*	Template: Share
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_share_product_this')) {
	function shopme_share_product_this() {
		wc_get_template( "share-product.php" );
	}
}

if (!function_exists('shopme_share_post_this')) {
	function shopme_share_post_this() {
		shopme_get_template( "/content/share.php" );
	}
}


/* ---------------------------------------------------------------------- */
/*	Template: Header Breadcrumbs
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_header_after_breadcrumbs')) {
	function shopme_header_after_breadcrumbs() {
		shopme_get_template( '/header/breadcrumbs.php' );
	}
}

/* ---------------------------------------------------------------------- */
/*	Template: Before content
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_before_content')) {
	function shopme_before_content() {
		shopme_get_template( '/content/before-content.php' );
	}
}

/* ---------------------------------------------------------------------- */
/*	Template: After content
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_after_content')) {
	function shopme_after_content() {
		shopme_get_template( '/content/after-content.php' );
	}
}

/* ---------------------------------------------------------------------- */
/*	Template: Footer In Top Part - Widgets
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_footer_in_top_part_widgets')) {
	function shopme_footer_in_top_part_widgets() {
		shopme_get_template( '/footer/footer-in-top-part-widgets.php' );
	}
}

/* ---------------------------------------------------------------------- */
/*	Template: Footer In Bottom Part - Widgets
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_footer_in_bottom_part')) {
	function shopme_footer_in_bottom_part() {
		shopme_get_template( '/footer/footer-in-bottom-part.php' );
	}
}



