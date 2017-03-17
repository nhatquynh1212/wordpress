<?php

require_once( SHOPME_INCLUDES_PATH . 'metadata/meta_values.php' );
require_once( SHOPME_INCLUDES_PATH . 'metadata/functions-types.php' );
require_once( SHOPME_INCLUDES_PATH . 'metadata/product.php' );

if ( !function_exists('shopme_get_term_from_query_var') ) {

	function shopme_get_term_from_query_var() {

		static $term = null;

		if ( isset($term) ) return $term;

		$qterm = get_query_var( 'term', null );
		$qtaxonomy = get_query_var( 'taxonomy', null );

		if ( $qterm && $qtaxonomy ) {
			$term = get_term_by('slug', $qterm, $qtaxonomy);
		} else {
			$term = false;
		}

		return $term;
	}

}

if ( !function_exists('shopme_get_meta_value') ) {

	function shopme_get_meta_value($meta_key) {

		$value = '';

		if ( shopme_is_product_category() ) {
			$term = shopme_get_term_from_query_var();

			if ( $term ) {
				$value = get_metadata($term->taxonomy, $term->term_id, $meta_key, true);
			}
		}

		return $value;
	}

}

