<?php

/**
 * Input List Walker
 * For checkbox and radio list fields
 */
class MAD_Walker_Input_List extends MAD_Walker_Base {

	/**
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of item.
	 * @param array  $args
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul class="mad-input-list">';
	}

	/**
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of item.
	 * @param array  $args
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '</ul>';
	}

	/**
	 * @see Walker::start_el()
	 *
	 * @param string $output            Passed by reference. Used to append additional content.
	 * @param object $object            Item data object.
	 * @param int    $depth             Depth of item.
	 * @param int    $current_object_id Item ID.
	 * @param array  $args
	 */
	public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$label      = $this->db_fields['label'];
		$id         = $this->db_fields['id'];
		$attributes = MAD_Field::call( 'get_attributes', $this->field, $object->$id );

		$output .= sprintf(
			'<li><label><input %s %s>%s</label>',
			MAD_Field::render_attributes( $attributes ),
			checked( in_array( $object->$id, $this->meta ), 1, false ),
			MAD_Field::filter( 'choice_label', $object->$label, $this->field, $object )
		);
	}

	/**
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args
	 */
	public function end_el( &$output, $page, $depth = 0, $args = array() ) {
		$output .= '</li>';
	}
}
