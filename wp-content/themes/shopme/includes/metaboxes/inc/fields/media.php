<?php

/**
 * Media field class which users WordPress media popup to upload and select files.
 */
class MAD_Media_Field extends MAD_File_Field {

	/**
	 * Enqueue scripts and styles
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_style( 'mad-media', MAD_CSS_URL . 'media.css', array(), MAD_VER );
		wp_enqueue_script( 'mad-media', MAD_JS_URL . 'media.js', array( 'jquery-ui-sortable', 'underscore', 'backbone', 'media-grid' ), MAD_VER, true );

		self::localize_script( 'mad-media', 'i18nRwmbMedia', array(
			'add'                => apply_filters( 'mad_media_add_string', _x( '+ Add Media', 'media', 'shopme' ) ),
			'single'             => apply_filters( 'mad_media_single_files_string', _x( ' file', 'media', 'shopme' ) ),
			'multiple'           => apply_filters( 'mad_media_multiple_files_string', _x( ' files', 'media', 'shopme' ) ),
			'remove'             => apply_filters( 'mad_media_remove_string', _x( 'Remove', 'media', 'shopme' ) ),
			'edit'               => apply_filters( 'mad_media_edit_string', _x( 'Edit', 'media', 'shopme' ) ),
			'view'               => apply_filters( 'mad_media_view_string', _x( 'View', 'media', 'shopme' ) ),
			'noTitle'            => _x( 'No Title', 'media', 'shopme' ),
			'loadingUrl'         => MAD_URL . 'img/loader.gif',
			'extensions'         => self::get_mime_extensions(),
			'select'             => apply_filters( 'mad_media_select_string', _x( 'Select Files', 'media', 'shopme' ) ),
			'or'                 => apply_filters( 'mad_media_or_string', _x( 'or', 'media', 'shopme' ) ),
			'uploadInstructions' => apply_filters( 'mad_media_upload_instructions_string', _x( 'Drop files here to upload', 'media', 'shopme' ) ),
		) );
	}

	/**
	 * Add actions
	 */
	public static function add_actions() {
		$args  = func_get_args();
		$field = reset( $args );
		add_action( 'print_media_templates', array( self::get_class_name( $field ), 'print_templates' ) );
	}

	/**
	 * Get field HTML
	 *
	 * @param mixed $meta
	 * @param array $field
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$meta       = (array) $meta;
		$meta       = implode( ',', $meta );
		$attributes = $load_test_attr = self::get_attributes( $field, $meta );

		$html = sprintf(
			'<input %s>
			<div class="mad-media-view" data-mime-type="%s" data-max-files="%s" data-force-delete="%s" data-show-status="%s"></div>',
			self::render_attributes( $attributes ),
			$field['mime_type'],
			$field['max_file_uploads'],
			$field['force_delete'] ? 'true' : 'false',
			$field['max_status']
		);

		return $html;
	}

	/**
	 * Normalize parameters for field
	 *
	 * @param array $field
	 *
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = parent::normalize( $field );
		$field = wp_parse_args( $field, array(
			'std'              => array(),
			'mime_type'        => '',
			'max_file_uploads' => 0,
			'force_delete'     => false,
			'max_status'       => true,
		) );

		$field['multiple'] = true;

		return $field;
	}

	/**
	 * Get the attributes for a field
	 *
	 * @param array $field
	 * @param mixed $value
	 *
	 * @return array
	 */
	public static function get_attributes( $field, $value = null ) {
		$attributes         = parent::get_attributes( $field, $value );
		$attributes['type'] = 'hidden';
		$attributes['name'] .= ! $field['clone'] && $field['multiple'] ? '[]' : '';
		$attributes['disabled'] = true;
		$attributes['id']       = false;
		$attributes['value']    = $value;

		return $attributes;
	}

	/**
	 * Get supported mime extensions.
	 *
	 * @return array
	 */
	protected static function get_mime_extensions() {
		$mime_types = wp_get_mime_types();
		$extensions = array();
		foreach ( $mime_types as $ext => $mime ) {
			$ext               = explode( '|', $ext );
			$extensions[ $mime ] = $ext;

			$mime_parts = explode( '/', $mime );
			if ( empty( $extensions[ $mime_parts[0] ] ) ) {
				$extensions[ $mime_parts[0] ] = array();
			}
			$extensions[ $mime_parts[0] ] = $extensions[ $mime_parts[0] . '/*' ] = array_merge( $extensions[ $mime_parts[0] ], $ext );

		}

		return $extensions;
	}

	/**
	 * Get meta values to save
	 *
	 * @param mixed $new
	 * @param mixed $old
	 * @param int   $post_id
	 * @param array $field
	 *
	 * @return array|mixed
	 */
	public static function value( $new, $old, $post_id, $field ) {
		array_walk( $new, 'absint' );
		return array_filter( array_unique( $new ) );
	}

	/**
	 * Save meta value
	 *
	 * @param $new
	 * @param $old
	 * @param $post_id
	 * @param $field
	 */
	public static function save( $new, $old, $post_id, $field ) {
		delete_post_meta( $post_id, $field['id'] );
		parent::save( $new, array(), $post_id, $field );
	}

	/**
	 * Template for media item
	 */
	public static function print_templates() {
		require_once MAD_INC_DIR . 'templates/media.php';
	}
}
