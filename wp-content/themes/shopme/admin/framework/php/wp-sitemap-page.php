<?php

// Exit if accessed directly
if ( !defined('ABSPATH') ) {
	exit;
}

/***************************************************************
 * Manage the option
 ***************************************************************/

/**
 * Fonction de callback
 * 
 * @param array $matches
 */
function shopme_wsp_manage_option( array $matches = array() ) {
	
	global $the_post_id;
	
	if (isset($matches[1])) {
		$key = strtolower( $matches[1] );
		
		switch ($key) {
			// Get the title of the post
			case 'title':
				return get_the_title($the_post_id);
				break;
			
			// Get the URL of the post
			case 'permalink':
				return get_permalink($the_post_id);
				break;
			
			// Get the year of the post
			case 'year':
				return get_the_time('Y', $the_post_id);
				break;
			
			// Get the month of the post
			case 'monthnum':
				return get_the_time('m', $the_post_id);
				break;
			
			// Get the day of the post
			case 'day':
				return get_the_time('d', $the_post_id);
				break;
			
			// Get the day of the post
			case 'hour':
				return get_the_time('H', $the_post_id);
				break;
			
			// Get the day of the post
			case 'minute':
				return get_the_time('i', $the_post_id);
				break;
			
			// Get the day of the post
			case 'second':
				return get_the_time('s', $the_post_id);
				break;
			
			// Get the day of the post
			case 'post_id':
				return $the_post_id;
				break;
			
			// Get the day of the post
			case 'category':
				$categorie_info = get_the_category($the_post_id);
				if (!empty($categorie_info)) {
					$categorie_info = current($categorie_info);
					//return print_r($categorie_info,1);
					return (isset($categorie_info->name) ? $categorie_info->name : '');
				}
				return '';
				break;
			
			// default value
			default:
				if (isset($matches[0])) {
					return $matches[0];
				}
				return false;
				break;
		}
		
	}
	return false;
}


/***************************************************************
 * Generate the sitemap
 ***************************************************************/


/**
 * Shortcode function that generate the sitemap
 * Use like this : [wp_sitemap_page]
 * 
 * @param $atts
 * @param $content
 * @return str $return
 */
function shopme_wp_sitemap_page_func( $atts, $content = null ) {
	
	// init
	$return = '';
	
	// display only some CPT
	// the "only" parameter always is higher than "exclude" options
	$only_cpt = (isset($atts['only']) ? sanitize_text_field($atts['only']) : '');
	
	// display or not the title
	$display_title = (isset($atts['display_title']) ? sanitize_text_field($atts['display_title']) : 'true');
	$is_title_displayed = ( $display_title=='false' ? false : true );
	
	// get only the private page/post ...
	$only_private = (isset($atts['only_private']) ? sanitize_text_field($atts['only_private']) : 'false');
	$is_get_only_private = ( $only_private=='true' ? true : false );
	
	// get the kind of sort
	$sort = (isset($atts['sort']) ? sanitize_text_field($atts['sort']) : null);
	
	// Exclude some pages (separated by a coma)
	$wsp_exclude_pages        = 0;
	$wsp_is_display_post_multiple_time = 0;

	// Determine if the posts should be displayed multiple time if it is in multiple category
	$display_post_only_once = ($wsp_is_display_post_multiple_time == 1 ? false : true );
	
	// check if the attribute "only" is used
	switch ( $only_cpt ) {
		// display only PAGE
		case 'page':
			return shopme_wsp_return_content_type_page($is_title_displayed, $is_get_only_private, $wsp_exclude_pages, $sort);
			break;
		// display only POST
		case 'post':
			return shopme_wsp_return_content_type_post($is_title_displayed, $display_post_only_once, $wsp_exclude_pages, $sort);
			break;
		// display only ARCHIVE
		case 'archive':
			return shopme_wsp_return_content_type_archive($is_title_displayed);
			break;
		// display only AUTHOR
		case 'author':
			return shopme_wsp_return_content_type_author($is_title_displayed, $sort);
			break;
		// display only CATEGORY
		case 'category':
			return shopme_wsp_return_content_type_categories($is_title_displayed, $sort);
			break;
		// display only TAGS
		case 'tag':
			return shopme_wsp_return_content_type_tag($is_title_displayed);
			break;
		// empty
		case '':
			// nothing but do
			break;
		default:
			// check if it's the name of a CPT
			
			// extract CPT object
			$cpt = get_post_type_object( $only_cpt );
			
			if ( !empty($cpt) ) {
				return shopme_wsp_return_content_type_cpt_items( $is_title_displayed, $cpt, $only_cpt, $wsp_exclude_pages, $sort );
			}
			
			// check if it's a taxonomy
			$taxonomy_obj = get_taxonomy( $only_cpt );
			
			if ( !empty($taxonomy_obj) ) {
				return shopme_wsp_return_content_type_taxonomy_items($is_title_displayed, $taxonomy_obj, $wsp_exclude_pages);
			}
			// end
	}
	
	
	//===============================================
	// Otherwise, display traditionnal sitemap
	//===============================================
	
	// List the PAGES
		$return .= shopme_wsp_return_content_type_page($is_title_displayed, $is_get_only_private, $wsp_exclude_pages);

		$return .= shopme_wsp_return_content_type_post($is_title_displayed, $display_post_only_once, $wsp_exclude_pages);

	// List the CPT
	$return .= shopme_wsp_return_content_type_cpt_lists($is_title_displayed, $wsp_exclude_pages);
	
	// List the Taxonomies
	$return .= shopme_wsp_return_content_type_taxonomies_lists($is_title_displayed, $wsp_exclude_pages);
	
		$return .= shopme_wsp_return_content_type_archive($is_title_displayed);

	// List the AUTHORS
		$return .= shopme_wsp_return_content_type_author($is_title_displayed);

	// return the content
	return $return;
}
add_shortcode( 'shopme_wp_sitemap_page', 'shopme_wp_sitemap_page_func');


/**
 * Return list of pages
 * 
 * @param bool $is_title_displayed
 * @param str $wsp_exclude_pages
 * @return str $return
 */
function shopme_wsp_return_content_type_page($is_title_displayed=true, $is_get_only_private=false, $wsp_exclude_pages, $sort=null) {
	
	// init
	$return = '';
	
	// define the way the pages should be displayed
	$args = array();
	$args['title_li'] = '';
	$args['echo']     = '0';
	
	// change the sort
	if ($sort !== null) {
		$args['sort_column'] = $sort;
	}
	
	// exclude some pages ?
	if (!empty($wsp_exclude_pages)) {
		$args['exclude'] = $wsp_exclude_pages;
	}
	
	// get only the private content
	if ($is_get_only_private == true) {
		$args['post_status'] = 'private';
	}
	
	// get data
	$list_pages = wp_list_pages($args);
	
	// check it's not empty
	if (empty($list_pages)) {
		return '';
	}
	
	// add content
	if ( $is_title_displayed == true ) {
		$return .= '<h4 class="mad-wsp-title">' . esc_html__('Pages', 'shopme') . '</h4>'."\n";
	}

	$return .= '<ul class="mad-wsp-list">'."\n";
		$return .= $list_pages;
	$return .= '</ul>'."\n";
	
	// return content
	return $return;
}


/**
 * Return list of posts in the categories
 * 
 * @param bool $is_title_displayed
 * @param bool $display_post_only_once
 * @return str $return
 */
function shopme_wsp_return_content_type_post( $is_title_displayed=true, $display_post_only_once, $wsp_exclude_pages=array(), $sort_categories=null ) {
	
	// init
	$return = '';
	
	// args
	$args = array();
	
	// change the sort order
	if ($sort_categories!==null) {
		$args['orderby'] = $sort_categories;
	}
	
	// Get the categories
	$cats = get_categories( $args );
	
	// check it's not empty
	if (empty($cats)) {
		return '';
	}
	
	// Get the categories
	$cats = shopme_wsp_generateMultiArray($cats);
	
	// add content
	if ($is_title_displayed==true) {
		$return .= '<h4 class="mad-wsp-title">'. esc_html__('Posts by category', 'shopme') .'</h4>'."\n";
	}
	$return .= shopme_wsp_htmlFromMultiArray($cats, true, $display_post_only_once, $wsp_exclude_pages);
	
	// return content
	return $return;
}


/**
 * Return list of posts in the categories
 * 
 * @param bool $is_title_displayed
 * @return str $return
 */
function shopme_wsp_return_content_type_categories( $is_title_displayed=true, $sort=null ) {
	
	// init
	$return = '';
	
	// args
	$args = array();
	
	// change the sort order
	if ($sort!==null) {
		$args['orderby'] = $sort;
	}
	
	// Get the categories
	$cats = get_categories( $args );
	
	// check it's not empty
	if (empty($cats)) {
		return '';
	}

	// add content
	if ($is_title_displayed==true) {
		$return .= '<h4 class="mad-wsp-title">' . esc_html__('Categories', 'shopme') . '</h4>'."\n";
	}
	$return .= '<ul class="mad-wsp-list">'."\n";
	foreach ($cats as $cat) {
		$return .= "\t".'<li><a href="'. esc_url(get_category_link($cat->cat_ID)) .'">'.$cat->name.'</a></li>'."\n";
	}
	$return .= '</ul>'."\n";
	
	// return content
	return $return;
}


/**
 * Return list of posts in the categories
 * 
 * @param bool $is_title_displayed
 * @return str $return
 */
function shopme_wsp_return_content_type_tag($is_title_displayed=true) {
	
	// init
	$return = '';
	
	// args
	$args = array();
	
	// Get the categories
	$posttags = get_tags( $args );
	
	// check it's not empty
	if (empty($posttags)) {
		return '';
	}
	
	// add content
	if ($is_title_displayed==true) {
		$return .= '<h4 class="mad-wsp-title">'. esc_html__('Tags', 'shopme') .'</h4>'."\n";
	}
	$return .= '<ul class="mad-wsp-list">'."\n";
	foreach($posttags as $tag) {
		$return .= "\t".'<li><a href="'. esc_url(get_tag_link($tag->term_id)) .'">'.$tag->name.'</a></li>'."\n";
	}
	$return .= '</ul>'."\n";
	
	// return content
	return $return;
}


/**
 * Return list of archives
 * 
 * @param bool $is_title_displayed
 * @return str $return
 */
function shopme_wsp_return_content_type_archive($is_title_displayed=true) {
	
	// init
	$return = '';
	
	// define the way the pages should be displayed
	$args = array();
	$args['echo'] = 0;
	
	// get data
	$list_archives = wp_get_archives($args);
	
	// check it's not empty
	if (empty($list_archives)) {
		return '';
	}
	
	// add content
	if ($is_title_displayed==true) {
		$return .= '<h4 class="mad-wsp-title">'. esc_html__('Archives', 'shopme') .'</h4>'."\n";
	}
	$return .= '<ul class="mad-wsp-list">'."\n";
	$return .= $list_archives;
	$return .= '</ul>'."\n";
	
	// return content
	return $return;
}


/**
 * Return list of authors
 * 
 * @param bool $is_title_displayed
 * @return str $return
 */
function shopme_wsp_return_content_type_author( $is_title_displayed=true, $sort=null ) {
	
	// init
	$return = '';
	
	// define the way the pages should be displayed
	$args = array();
	$args['echo'] = 0;
	
	// change the sort order
	if ($sort!==null) {
		$args['orderby'] = $sort;
	}
	
	// get data
	$list_authors = wp_list_authors($args);
	
	// check it's not empty
	if (empty($list_authors)) {
		return '';
	}
	
	// add content
	if ($is_title_displayed==true) {
		$return .= '<h4 class="mad-wsp-title">'. esc_html__('Authors', 'shopme').'</h4>'."\n";
	}
	$return .= '<ul class="mad-wsp-list">'."\n";
	$return .= $list_authors;
	$return .= '</ul>'."\n";
	
	// return content
	return $return;
}


/**
 * Return list of all other custom post type
 * 
 * @param bool $is_title_displayed
 * @param str $wsp_exclude_pages
 * @return str $return
 */
function shopme_wsp_return_content_type_cpt_lists( $is_title_displayed=true, $wsp_exclude_pages ) {
	
	// init
	$return = '';
	
	// define the main arguments
	$args = array(
		'public'   => true,
		'_builtin' => false
	);
	
	// Get the CPT (Custom Post Type)
	$post_types = get_post_types( $args, 'names' ); 
	
	// check it's not empty
	if (empty($post_types)) {
		return '';
	}
	
	// list all the CPT
	foreach ( $post_types as $post_type ) {

		// extract CPT object
		$cpt = get_post_type_object( $post_type );

			$return .= shopme_wsp_return_content_type_cpt_items( $is_title_displayed, $cpt, $post_type, $wsp_exclude_pages );
	}
	
	// return content
	return $return;
}


/**
 * Return list of all other custom post type
 * 
 * @param bool $is_title_displayed
 * @param str $cpt
 * @param str $post_type
 * @param str $wsp_exclude_pages
 * @return str $return
 */
function shopme_wsp_return_content_type_cpt_items( $is_title_displayed=true, $cpt, $post_type, $wsp_exclude_pages, $sort=null ) {
	
	// init
	$return = '';
	
	// List the pages
	$list_pages = '';
	
	// define the way the pages should be displayed
	$args = array();
	$args['post_type'] = $post_type;
	$args['posts_per_page'] = 999999;
	$args['suppress_filters'] = 0;
	
	// exclude some pages ?
	if (!empty($wsp_exclude_pages)) {
		$args['exclude'] = $wsp_exclude_pages;
	}
	
	// change the sort order
	if ($sort!==null) {
		$args['orderby'] = $sort;
	}
	
	$posts_cpt = get_posts( $args );
	
	// List all the results
	if ( !empty($posts_cpt) ) {
		foreach( $posts_cpt as $post_cpt ) {
			$list_pages .= '<li><a href="'. esc_url(get_permalink( $post_cpt->ID )) .'">'.$post_cpt->post_title.'</a></li>'."\n";
		}
	}
	
	// Return the data (if it exists)
	if (!empty($list_pages)) {
		if ($is_title_displayed==true) {
			$return .= '<h4 class="mad-wsp-title mad-wsp-'.$post_type.'s-title">' . $cpt->label . '</h4>'."\n";
		}
		$return .= '<ul class="mad-wsp-list mad-wsp-' . $post_type . 's-list">'."\n";
		$return .= $list_pages;
		$return .= '</ul>'."\n";
	}
	
	// return content
	return $return;
}


/**
 * Return list of all other custom post type
 * 
 * @param bool $is_title_displayed
 * @param str $wsp_exclude_pages
 * @return str $return
 */
function shopme_wsp_return_content_type_taxonomies_lists($is_title_displayed=true, $wsp_exclude_pages) {
	
	// init
	$return = '';
	
	$args = array(
		'public'   => true,
		'_builtin' => false
		);
	$taxonomies_names = get_taxonomies( $args );
	
	// check it's not empty
	if (empty($taxonomies_names)) {
		return '';
	}
	
	// list all the taxonomies
	foreach ( $taxonomies_names as $taxonomy_name ) {
		
		// Extract
		$taxonomy_obj = get_taxonomy( $taxonomy_name );
		
		// Is this taxonomy already excluded ?
		$wsp_exclude_taxonomy = get_option('wsp_exclude_taxonomy_'.$taxonomy_name);
		
		if ( empty($wsp_exclude_taxonomy) ) {
			$return .= shopme_wsp_return_content_type_taxonomy_items( $is_title_displayed, $taxonomy_obj, $wsp_exclude_taxonomy );
		}
	}
	
	// return content
	return $return;
}


/**
 * Return list of all other taxonomies
 * 
 * @param bool $is_title_displayed
 * @param object $taxonomy_obj
 * @param str $wsp_exclude_pages
 * @return str $return
 */
function shopme_wsp_return_content_type_taxonomy_items( $is_title_displayed=true, $taxonomy_obj, $wsp_exclude_taxonomy ) {
	
	// init
	$return = '';
	
	// List the pages
	$list_pages = '';
	
	// get some data
	$taxonomy_name = $taxonomy_obj->name;
	$taxonomy_label = $taxonomy_obj->label;
	
	// init variable to get terms of a taxonomy
	$taxonomies = array( $taxonomy_name );
	$args = array();
	
	// get the terms of this taxonomy
	$terms = get_terms($taxonomies, $args);
	
	// List all the results
	if ( !empty($terms) ) {
		foreach( $terms as $terms_obj ) {
			$list_pages .= '<li><a href="'. esc_url(get_term_link( $terms_obj )) .'">'.$terms_obj->name.'</a></li>'."\n";
		}
	}
	
	// Return the data (if it exists)
	if (!empty($list_pages)) {
		if ($is_title_displayed==true) {
			$return .= '<h4 class="mad-wsp-title mad-wsp-'.$taxonomy_name.'s-title">' . $taxonomy_label . '</h4>'."\n";
		}
		$return .= '<ul class="mad-wsp-list mad-wsp-'.$taxonomy_name.'s-list">'."\n";
		$return .= $list_pages;
		$return .= '</ul>'."\n";
	}
	
	// return content
	return $return;
}


/**
 * Generate a multidimensional array from a simple linear array using a recursive function
 * 
 * @param array $arr
 * @param int $parent
 * @return array $pages
 */
function shopme_wsp_generateMultiArray( array $arr = array() , $parent = 0 ) {
	
	// check if not empty
	if (empty($arr)) {
		return array();
	}
	
	$pages = array();
	// go through the array
	foreach($arr as $k => $page) {
		if ($page->parent == $parent) {
			$page->sub = isset($page->sub) ? $page->sub : shopme_wsp_generateMultiArray($arr, $page->cat_ID);
			$pages[] = $page;
		}
	}
	
	return $pages;
}


/**
 * Display the multidimensional array using a recursive function
 * 
 * @param array $nav
 * @param bool $useUL
 * @param bool $display_post_only_once
 * @return str $html
 */
function shopme_wsp_htmlFromMultiArray( array $nav = array() , $useUL = true, $display_post_only_once = true, $wsp_exclude_pages = array(), $sort=null ) {
	
	// check if not empty
	if (empty($nav)) {
		return '';
	}
	
	$html = '';
	if ($useUL === true) {
		$html .= '<ul class="mad-wsp-list">'."\n";
	}
	
	// List all the categories
	foreach ($nav as $page) {
		$html .= "\t".'<li><strong class="mad-wsp-title">'
			.sprintf( esc_html__('Category: %1$s', 'shopme'), '<a href="'. esc_url(get_category_link($page->cat_ID)) .'">'.$page->name.'</a>' )
			.'</strong>'."\n";
		
		$post_by_cat = shopme_wsp_displayPostByCat($page->cat_ID, $display_post_only_once, $wsp_exclude_pages);
		
		// List of posts for this category
		$category_recursive = '';
		if (!empty($page->sub)) {
			// Use recursive function to get the childs categories
			$category_recursive = shopme_wsp_htmlFromMultiArray( $page->sub, false, $display_post_only_once, $wsp_exclude_pages, $sort );
		}
		
		// display if it exist
		if ( !empty($post_by_cat) || !empty($category_recursive) ) {
			$html .= '<ul class="mad-wsp-list">';
		}
		if ( !empty($post_by_cat) ) {
			$html .= $post_by_cat;
		}
		if ( !empty($category_recursive) ) {
			$html .= $category_recursive;
		}
		if ( !empty($post_by_cat) || !empty($category_recursive) ) {
			$html .= '</ul>';
		}
		
		$html .= '</li>'."\n";
	}
	
	if ($useUL === true) {
		$html .= '</ul>'."\n";
	}
	return $html;
}


/**
 * Display the multidimensional array using a recursive function
 * 
 * @param int $cat_id
 * @param bool $display_post_only_once
 * @return str $html
 */
function shopme_wsp_displayPostByCat( $cat_id, $display_post_only_once=true, $wsp_exclude_pages=array(), $sort=null ) {
	
	global $the_post_id;
	
	// init
	$html = '';
	
	// define the way the pages should be displayed
	$args = array();
	$args['numberposts'] = 999999;
	$args['cat'] = $cat_id;
	
	// exclude some pages ?
	if (!empty($wsp_exclude_pages)) {
		$args['exclude'] = $wsp_exclude_pages;
	}
	
	// change the sort order
	if ($sort!==null) {
		$args['orderby'] = $sort;
	}
	
	// List of posts for this category
	$the_posts = get_posts( $args );
	
	// check if not empty
	if (empty($the_posts)) {
		return '';
	}
	
		$wsp_posts_by_category = '<a href="{permalink}">{title}</a> ({monthnum}/{day}/{year})';
		
	// list the posts
	foreach ( $the_posts as $the_post ) {
		// Display the line of a post
		$get_category = get_the_category($the_post->ID);
		
		// Display the post only if it is on the deepest category
		if ( $display_post_only_once==false || ($display_post_only_once==true && $get_category[0]->cat_ID == $cat_id) ) {
			
			// get post ID
			$the_post_id = $the_post->ID;
			
			// replace the ID by the real value
			$html .= "\t\t".'<li class="wsp-post">'
				.preg_replace_callback( '#\{(.*)\}#Ui', 'shopme_wsp_manage_option', $wsp_posts_by_category)
				.'</li>'."\n";
		}
	}
	
	return $html;
}

