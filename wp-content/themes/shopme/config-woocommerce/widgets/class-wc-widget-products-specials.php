<?php
/**
 * List products. One widget to rule them all.
 *
 * @category 	Widgets
 * @package 	config-woocommerce/widgets
 * @version 	2.1.0
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Shopme_WC_Widget_Products_Specials extends SHOPME_Widget {

	function widgets_scripts( $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_style( SHOPME_PREFIX . 'chosen-drop-down', SHOPME_BASE_URI . 'js/chosen/chosen.css' );
		wp_enqueue_script( SHOPME_PREFIX . 'chosen-drop-down', SHOPME_BASE_URI . 'js/chosen/chosen.jquery.min.js', array('jquery') );

		wp_enqueue_script( SHOPME_PREFIX . 'admin', get_template_directory_uri() . '/config-woocommerce/assets/js/admin.js', array('jquery'), null, true );
	}

	public function load_widgets_hook() {
		add_action( 'admin_enqueue_scripts', array($this, 'widgets_scripts'), 5 );
	}

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action('load-widgets.php', array(&$this, 'load_widgets_hook') , 4);

		$this->widget_cssclass    = 'woocommerce widget_products_specials';
		$this->widget_description = esc_html__( 'Widget display a list or carousel of your products on your site.', 'shopme' );
		$this->widget_id          = 'mad_woocommerce_products_specials';
		$this->widget_name        = SHOPME_THEMENAME .' '. esc_html__( 'WooCommerce Specials', 'shopme' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Specials', 'shopme' ),
				'label' => esc_html__( 'Title', 'shopme' )
			),
			'color_title'  => array(
				'type'  => 'colorpicker',
				'std'   => '',
				'label' => esc_html__( 'Color', 'shopme' ),
				'desc'  => esc_html__('Color text for title', 'shopme' )
			),
			'type' => array(
				'type'  => 'select',
				'std'   => '',
				'label' => esc_html__( 'Type', 'shopme' ),
				'options' => array(
					''   => esc_html__( 'List Style', 'shopme' ),
					'owl_carousel' => esc_html__( 'Carousel', 'shopme' ),
				)
			),
			'autoplay' => array(
				'type' => 'checkbox',
				'std' => '',
				'label' => esc_html__('Autoplay', 'shopme'),
				'desc' => esc_html__('Enable autoplay', 'shopme')
			),
			'autoplayTimeout' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 5000,
				'label' => esc_html__( 'AutoplayTimeout', 'shopme' )
			),
			'layout' => array(
				'type'  => 'select',
				'std'   => 'type_1',
				'label' => esc_html__( 'Layout', 'shopme' ),
				'options' => array(
					'type_1'   => esc_html__( 'Type 1', 'shopme' ),
					'type_2' => esc_html__( 'Type 2', 'shopme' ),
					'type_3' => esc_html__( 'Type 3', 'shopme' ),
					'type_4' => esc_html__( 'Type 4', 'shopme' )
				),
				'desc' => esc_html__('Choose layout style.', 'shopme' )
			),
			'show' => array(
				'type'  => 'select',
				'std'   => '',
				'label' => esc_html__( 'Show', 'shopme' ),
				'options' => array(
					''         => esc_html__( 'All Products', 'shopme' ),
					'featured' => esc_html__( 'Featured Products', 'shopme' ),
					'onsale'   => esc_html__( 'On-sale Products', 'shopme' ),
				)
			),
			'number' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 5,
				'label' => esc_html__( 'Number of products to show', 'shopme' )
			),
			'category' => array(
				'type' => 'chosen_select',
				'label' => esc_html__('Category of products to show', 'shopme'),
				'taxonomy' => 'product_cat',
				'std' => ''
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => esc_html__( 'Order by', 'shopme' ),
				'options' => array(
					'date'   => esc_html__( 'Date', 'shopme' ),
					'price'  => esc_html__( 'Price', 'shopme' ),
					'rand'   => esc_html__( 'Random', 'shopme' ),
					'sales'  => esc_html__( 'Sales', 'shopme' ),
				)
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'desc',
				'label' => _x( 'Order', 'Sorting order', 'shopme' ),
				'options' => array(
					'asc'  => esc_html__( 'ASC', 'shopme' ),
					'desc' => esc_html__( 'DESC', 'shopme' ),
				)
			),
			'css_animation' => array(
				'type'  => 'select',
				'std'   => '',
				'label' => esc_html__( 'CSS Animation', 'shopme' ),
				'options' => array(
					''  => esc_html__( 'No', 'shopme' ),
					'fadeInDown' => esc_html__( 'Fade In Down', 'shopme' ),
				),
				'desc' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'shopme' )
			),
			'animation_delay' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => '',
				'label' => esc_html__( 'Animation delay', 'shopme' ),
				'desc' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'shopme' )
			)
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {

		$type		 = isset($instance['type']) ? sanitize_title($instance['type']) : $this->settings['type']['std'];
		$layout		 = isset($instance['layout']) ? sanitize_title($instance['layout']) : $this->settings['layout']['std'];
		$show        = isset($instance['show']) ? sanitize_title( $instance['show'] ) : $this->settings['show']['std'];
		$autoplay = isset($instance['autoplay']) ? absint( $instance['autoplay'] ) : 0;
		$autoplayTimeout = isset($instance['autoplayTimeout']) ? absint( $instance['autoplayTimeout'] ) : $this->settings['autoplayTimeout']['std'];
		$number      = isset($instance['number']) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		$category     = isset($instance['category']) ? sanitize_title( $instance['category'] ) : $this->settings['category']['std'];
		$orderby     = isset($instance['orderby']) ? sanitize_title( $instance['orderby'] ) : $this->settings['orderby']['std'];
		$order       = isset($instance['order']) ? sanitize_title( $instance['order'] ) : $this->settings['order']['std'];
		$css_animation  = isset($instance['css_animation']) ? $instance['css_animation'] : $this->settings['order']['std'];
		$animation_delay  = isset($instance['animation_delay']) ? sanitize_title( $instance['animation_delay'] ) : $this->settings['order']['std'];
		$show_rating = false;

		$css_classes = array();
		$css_classes[] = $type;
		$css_classes[] = $layout;

		$attributes = $animation_atts = array();

		if ( $type == 'owl_carousel' ) {
			$css_classes[] = 'widget-specials-carousel';

			if ( $autoplay ) {
				$attributes[] = 'data-autoplay="'. $autoplay .'"';
				$attributes[] = 'data-autoplaytimeout="'. $autoplayTimeout .'"';
			}
		}

		if ( $css_animation != '' ) {
			$animation_atts = array(
				'animated' => $css_animation
			);
		}

		$css_class = 'products-container view-grid widget-specials ' . implode(' ', $css_classes);

    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'product',
    		'no_found_rows'  => 1,
    		'order'          => $order == 'asc' ? 'asc' : 'desc'
    	);

    	$query_args['meta_query'] = array();

	    $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	    $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

		$query_args['meta_key'] = 'total_sales';

    	switch ( $show ) {
    		case 'featured' :
    			$query_args['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
    			break;
    		case 'onsale' :
    			$product_ids_on_sale = wc_get_product_ids_on_sale();
				$product_ids_on_sale[] = 0;
				$query_args['post__in'] = $product_ids_on_sale;
    			break;
    	}

    	switch ( $orderby ) {
			case 'price' :
				$query_args['meta_key'] = '_price';
    			$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand' :
    			$query_args['orderby']  = 'rand';
				break;
			case 'sales' :
				$query_args['meta_key'] = 'total_sales';
    			$query_args['orderby']  = 'meta_value_num';
				break;
			default :
				$query_args['orderby']  = 'date';
    	}

		if ( !empty($category) ) {

			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'product_cat',
					'field' => 'id',
					'terms' => $category
				)
			);

			$query_args['tax_query'] = $tax_query;

		}

		$r = new WP_Query( $query_args );

		ob_start();

		if ( $r->have_posts() ) {

			$this->widget_start( $args, $instance );

			echo "<div class='". esc_attr($css_class) ."'  ". implode(' ', $attributes) .">";

				woocommerce_product_loop_start();

					while ( $r->have_posts()) {
						$r->the_post();
						wc_get_template( 'content-product.php', array(
								'show_rating' => $show_rating,
								'animation' => $animation_atts
							)
						);
					}

				woocommerce_product_loop_end();

			echo '</div>';

			$this->widget_end($args);

		}

		wp_reset_postdata();

		echo ob_get_clean();
	}

	public function create_data_string($data = array()) {
		$data_string = "";

		foreach ($data as $key => $value) {
			if (is_array($value)) $value = implode(", ", $value);
			$data_string .= " data-$key={$value} ";
		}
		return $data_string;
	}

}
