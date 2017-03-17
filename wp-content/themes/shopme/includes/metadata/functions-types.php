<?php

if (!function_exists('shopme_save_taxdata')) {

	function shopme_save_taxdata( $term_id, $ts_id, $taxonomy, $meta_boxes ) {
		if (!isset($meta_boxes) || empty($meta_boxes))
			return;

		foreach ($meta_boxes as $meta_box) {

			extract(shortcode_atts(array(
				"name" => '',
				"title" => '',
				"desc" => '',
				"type" => '',
				"default" => '',
				"options" => ''
			), $meta_box));

			if ( !isset($_POST[$name . '_noncename']))
				return;

			if ( !wp_verify_nonce( $_POST[$name.'_noncename'], plugin_basename(__FILE__) ) ) {
				return;
			}

			$meta_box_value = get_metadata($taxonomy, $term_id, $name, true);

			if (!isset($_POST[$name])) {
				delete_metadata($taxonomy, $term_id, $name, $meta_box_value);
				continue;
			}

			$data = $_POST[$name];

			if (is_array($data))
				$data = implode(',', $data);

			if (!$meta_box_value && !$data)
				add_metadata($taxonomy, $term_id, $name, $data, true);
			elseif ($data != $meta_box_value)
				update_metadata($taxonomy, $term_id, $name, $data);
			elseif (!$data)
				delete_metadata($taxonomy, $term_id, $name, $meta_box_value);
		}
	}

}


if (!function_exists('shopme_show_tax_add_meta_html')) {

	// Show Taxonomy Add meta
	function shopme_show_tax_add_meta_html($meta_box) {

		$name = $title = $desc = $type = $default = $options = '';

		extract(shortcode_atts(array(
			"name" => '',
			"title" => '',
			"desc" => '',
			"type" => '',
			"default" => '',
			"options" => ''
		), $meta_box));

		?>

		<div class="shopme-form-field">

			<?php wp_nonce_field( plugin_basename(__FILE__), $name . '_noncename' );

			if ($type == "text") : // text ?>
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" />
				<?php if ($desc) : ?><p><?php echo $desc ?></p><?php endif; ?>
			<?php endif;

			if ($type == "select") :  ?>
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<select name="<?php echo $name ?>" id="<?php echo $name ?>">

					<?php if ($options == 'page'): ?>

						<option value=""><?php esc_html_e('None', 'shopme'); ?></option>

						<?php $options = get_pages('title_li=&orderby=name');

						if (is_array($options)) :
							foreach ($options as $key => $entry) :
								$std = $entry->ID;
								$title = $entry->post_title;
								?>
								<option value="<?php echo $std ?>"><?php echo $title ?></option>
							<?php endforeach;
						endif; ?>

					<?php else: ?>
						<?php if (is_array($options)) :
							foreach ($options as $key => $value) : ?>
								<option value="<?php echo $key ?>"><?php echo $value ?></option>
							<?php endforeach;
						endif; ?>
					<?php endif; ?>

				</select>
				<?php if ($desc) : ?><p><?php echo $desc ?></p><?php endif; ?>
			<?php endif;

			if ($type == "editor") : ?>
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<?php wp_editor( '', $name ) ?>
				<?php if ($desc) : ?><p><?php echo $desc ?></p><?php endif; ?>
			<?php endif;

			if ($type == "upload") :  ?>
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<label for='upload_image'>
					<input style="margin-bottom:5px;" type="text" name="<?php echo $name ?>"  id="<?php echo $name ?>" /><br/>
					<button class="button_upload_image button" id="<?php echo $name ?>"><?php esc_html_e('Upload Image', 'shopme') ?></button>
					<button class="button_remove_image button" id="<?php echo $name ?>"><?php esc_html_e('Remove Image', 'shopme') ?></button>
				</label>
				<?php if ($desc) : ?><p><?php echo $desc ?></p><?php endif; ?>
			<?php endif;

			if ($type == "textarea") :  ?>
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<textarea id="<?php echo $name ?>" name="<?php echo $name ?>"></textarea>
				<?php if ($desc) : ?><p><?php echo $desc ?></p><?php endif; ?>
			<?php endif;

			if ($type == "checkbox") : // checkbox ?>
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<label><input style="display:inline-block; width:auto;" type="checkbox" name="<?php echo $name ?>" value="<?php echo $name ?>" /> <?php echo $desc ?></label>
			<?php endif;

			if (($type == 'radio') && (!empty($options))) :  ?>
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<?php foreach ($options as $key => $value) : ?>
					<input style="display:inline-block; width:auto;" type="radio" id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>"  value="<?php echo $key ?>"/>
					<label style="display:inline-block" for="<?php echo $name ?>_<?php echo $key ?>"><?php echo $value ?></label>
				<?php endforeach; ?>
				<?php if ($desc) : ?><p><?php echo $desc ?></p><?php endif; ?>
			<?php endif; ?>

		</div> <?php

	}

}


if (!function_exists('shopme_show_tax_edit_meta_html')) {

	// Show Taxonomy Edit meta
	function shopme_show_tax_edit_meta_html($term, $taxonomy, $meta_box) {

		$name = $title = $desc = $type = $default = $options = '';

		extract(shortcode_atts(array(
			"name" => '',
			"title" => '',
			"desc" => '',
			"type" => '',
			"default" => '',
			"options" => ''
		), $meta_box));

		?>

		<tr class="shopme-form-field">

			<?php

			wp_nonce_field( plugin_basename(__FILE__), $name . '_noncename' );

			$meta_box_value = get_metadata($term->taxonomy, $term->term_id, $name, true);

			if ($meta_box_value == "")
				$meta_box_value = $default;

			if ($type == "text") : // text ?>
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo stripslashes($meta_box_value) ?>" size="50%" />
					<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			<?php endif;

			if ($type == "select") : ?>
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<select name="<?php echo $name ?>" id="<?php echo $name ?>">

						<?php if ($options == 'page'): ?>

							<option value=""><?php esc_html_e('None', 'shopme'); ?></option>

							<?php $options = get_pages('title_li=&orderby=name');

							if (is_array($options)) :
								foreach ($options as $key => $entry) :
									$std = $entry->ID;
									$title = $entry->post_title;
									?>
									<option value="<?php echo $std ?>"<?php echo $meta_box_value == $std ? ' selected="selected"' : '' ?>><?php echo $title ?></option>
								<?php endforeach;
							endif; ?>

						<?php else: ?>
							<?php if (is_array($options)) :
								foreach ($options as $key => $value) : ?>
									<option value="<?php echo $key ?>"<?php echo $meta_box_value == $key ? ' selected="selected"' : '' ?>><?php echo $value ?></option>
								<?php endforeach;
							endif; ?>
						<?php endif; ?>

					</select>
					<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			<?php endif;

			if ($type == "editor") : ?>
				<th colspan="2" scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td colspan="2">
					<?php wp_editor( $meta_box_value, $name ) ?>
					<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			<?php endif;

			if ($type == "upload") : ?>
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<label for='upload_image'>
						<input value="<?php echo stripslashes($meta_box_value) ?>" type="text" name="<?php echo $name ?>"  id="<?php echo $name ?>" size="50%" />
						<br/>
						<button class="button_upload_image button" id="<?php echo $name ?>"><?php esc_html_e('Upload Image', 'shopme') ?></button>
						<button class="button_remove_image button" id="<?php echo $name ?>"><?php esc_html_e('Remove Image', 'shopme') ?></button>
					</label>
					<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			<?php endif;

			if ($type == "textarea") : ?>
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<textarea id="<?php echo $name ?>" name="<?php echo $name ?>"><?php echo stripslashes($meta_box_value) ?></textarea>
					<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			<?php endif;

			if ($type == "checkbox") : ?>
				<?php if ( $meta_box_value == $name ) {
					$checked = "checked=\"checked\"";
				} else {
					$checked = "";
				} ?>
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<label><input type="checkbox" name="<?php echo $name ?>" value="<?php echo $name ?>" <?php echo $checked ?> /> <?php echo $desc ?></label>
				</td>
			<?php endif;

			if (($type == 'radio') && (!empty($options))) : ?>
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<?php foreach ($options as $key => $value) : ?>
						<input type="radio" id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>"  value="<?php echo $key ?>"
							<?php echo (isset($meta_box_value) && ($meta_box_value == $key) ? ' checked="checked"' : '') ?>/>
						<label for="<?php echo $name ?>_<?php echo $key ?>"><?php echo $value ?></label>
					<?php endforeach; ?>
					<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			<?php endif; ?>

		</tr> <?php
	}

}
