<?php
	$footer_row_top_widgets_array = json_decode(html_entity_decode($footer_row_top_columns_variations), true);
	$footer_row_middle_widgets_array = json_decode(html_entity_decode($footer_row_middle_columns_variations), true);
	$footer_row_bottom_widgets_array = json_decode(html_entity_decode($footer_row_bottom_columns_variations), true);

	$get_sidebars_top_widgets = unserialize($get_sidebars_top_widgets);
	$get_sidebars_middle_widgets = unserialize($get_sidebars_middle_widgets);
	$get_sidebars_bottom_widgets = unserialize($get_sidebars_bottom_widgets);
?>


<div class="meta-option">

	<div class="meta-description">
		<h4 class="heading"><?php esc_html_e('Show Row Top widgets ?', 'shopme'); ?></h4>
		<span><?php esc_html_e('Select yes if you want to show the top row of widgets', 'shopme'); ?></span>
	</div><!--/ .meta-description-->

	<div class="meta-controls">

		<div class="meta-button-set">

			<div class="meta-radio-button">
				<input id="footer_row_top_show_yes" <?php checked(@$footer_row_top_show, 'yes') ?> type="radio"
					   value="yes" name="footer_row_top_show" autocomplete="off"/>
				<label for="footer_row_top_show_yes"><?php esc_html_e('Show', 'shopme') ?></label>
			</div>

			<div class="meta-radio-button">
				<input id="footer_row_top_show_no" <?php checked(@$footer_row_top_show, 'no') ?> type="radio"
					   value="no" name="footer_row_top_show" autocomplete="off"/>
				<label for="footer_row_top_show_no"><?php esc_html_e('Hide', 'shopme') ?></label>
			</div>

		</div><!--/ .meta-button-set-->

	</div><!--/ .meta-controls-->

</div><!--/ .meta-option-->

<div class="meta-option footer_row_top_show" <?php if ($footer_row_top_show == 'no'): ?>style="display: none;"<?php endif; ?>>

	<div class="meta-description">
		<h4 class="heading"><?php esc_html_e('Footer Row Top Widget', 'shopme'); ?></h4>
		<span><?php esc_html_e('Here you can select how your footer row top widgets will be displayed.', 'shopme'); ?></span>
	</div><!--/ .meta-description-->

	<div class="meta-controls">

		<div class="meta-set">

			<?php if (is_array($footer_row_top_widgets_array)): ?>

				<div class="meta-list-set">

					<span><?php esc_html_e('Columns', 'shopme') ?>:</span>

					<ul class="options-columns">
						<?php for ( $i = 1; $i < $columns + 1; $i++ ) : $active_class = '';
							if ( $i == key($footer_row_top_widgets_array) ) { $active_class = 'active'; }
							?>

							<li data-val="<?php echo $i ?>" class="<?php echo $active_class ?>"><?php echo $i ?></li>

						<?php endfor; ?>
					</ul>

				</div><!--/ .meta-list-set-->

				<div class="meta-columns-set">

					<?php for ($i = 1; $i < $columns + 1; $i++):
						$css_class = $col = '';
						if ($i > key ($footer_row_top_widgets_array)) {
							$css_class = 'hidden';
						} else {
							$col = $footer_row_top_widgets_array[key($footer_row_top_widgets_array)][0][$i-1];
						}
						?>

						<div class="mod-columns <?php if (!empty($col)) { echo "mod-grid-{$col}"; } ?> <?php echo $css_class ?>">

							<?php if (!empty($get_sidebars)): ?>

								<select name="get_sidebars_top_widgets[]" id="">
									<?php foreach ($get_sidebars as $key => $value): ?>
										<option <?php selected($get_sidebars_top_widgets[$i - 1], $key); ?> value="<?php echo $key ?>"><?php echo $value ?></option>
									<?php endforeach; ?>
								</select>

							<?php endif; ?>

						</div>

					<?php endfor; ?>

				</div><!--/ .meta-columns-set-->

				<div class="meta-list-set">

					<span><?php esc_html_e('Styles', 'shopme') ?>:</span>

					<ul class="options-type">
						<?php foreach ( $columns_variations[key($footer_row_top_widgets_array)] as $key => $val ) : $active_class = '';
							if ( $footer_row_top_widgets_array[ key($footer_row_top_widgets_array) ][0] == $val  ) { $active_class = 'active'; }
							$value = $key + 1;
							?>

							<li data-val="<?php echo $value ?>" class="<?php echo $active_class ?>"><?php echo $value ?></li>

						<?php endforeach; ?>
					</ul>

				</div><!--/ .meta-list-set-->

				<input type="hidden" class="data-widgets-hidden" data-columns="<?php echo key($footer_row_top_widgets_array); ?>" name="footer_row_top_columns_variations" value='<?php echo htmlspecialchars($footer_row_top_columns_variations) ?>' />

			<?php endif; ?>

		</div><!--/ .meta-set-->

	</div><!--/ .meta-controls-->

</div><!--/ .meta-option-->

<div class="meta-option">

	<div class="meta-description">
		<h4 class="heading"><?php esc_html_e('Show Row Middle widgets ?', 'shopme'); ?></h4>
		<span><?php esc_html_e('Select yes if you want to show the middle row of widgets', 'shopme'); ?></span>
	</div><!--/ .meta-description-->

	<div class="meta-controls">

		<div class="meta-button-set">

			<div class="meta-radio-button">
				<input id="footer_row_middle_show_yes" <?php checked(@$footer_row_middle_show, 'yes') ?> type="radio"
					   value="yes" name="footer_row_middle_show" autocomplete="off"/>
				<label for="footer_row_middle_show_yes"><?php esc_html_e('Show', 'shopme') ?></label>
			</div>

			<div class="meta-radio-button">
				<input id="footer_row_middle_show_no" <?php checked(@$footer_row_middle_show, 'no') ?> type="radio"
					   value="no" name="footer_row_middle_show" autocomplete="off"/>
				<label for="footer_row_middle_show_no"><?php esc_html_e('Hide', 'shopme') ?></label>
			</div>

		</div><!--/ .meta-button-set-->

	</div><!--/ .meta-controls-->

</div><!--/ .meta-option-->

<div class="meta-option footer_row_middle_show" <?php if ($footer_row_middle_show == 'no'): ?>style="display: none;"<?php endif; ?>>

	<div class="meta-description">
		<h4 class="heading"><?php esc_html_e('Footer Row Middle Widget', 'shopme'); ?></h4>
		<span><?php esc_html_e('Here you can select how your footer row middle widgets will be displayed.', 'shopme'); ?></span>
	</div><!--/ .meta-description-->

	<div class="meta-controls">

		<div class="meta-set">

			<?php if (is_array($footer_row_middle_widgets_array)): ?>

				<div class="meta-list-set">

					<span><?php esc_html_e('Columns', 'shopme') ?>:</span>

					<ul class="options-columns">
						<?php for ( $i = 1; $i < $columns + 1; $i++ ) : $active_class = '';
							if ( $i == key($footer_row_middle_widgets_array) ) { $active_class = 'active'; }
							?>

							<li data-val="<?php echo $i ?>" class="<?php echo $active_class ?>"><?php echo $i ?></li>

						<?php endfor; ?>
					</ul>

				</div><!--/ .meta-list-set-->

				<div class="meta-columns-set">

					<?php for ($i = 1; $i < $columns + 1; $i++):
						$css_class = $col = '';
						if ($i > key ($footer_row_middle_widgets_array)) {
							$css_class = 'hidden';
						} else {
							$col = $footer_row_middle_widgets_array[key($footer_row_middle_widgets_array)][0][$i-1];
						}
						?>

						<div class="mod-columns <?php if (!empty($col)) { echo "mod-grid-{$col}"; } ?> <?php echo $css_class ?>">

							<?php if (!empty($get_sidebars)): ?>

								<select name="get_sidebars_middle_widgets[]" id="">
									<?php foreach ($get_sidebars as $key => $value): ?>
										<option <?php selected($get_sidebars_middle_widgets[$i - 1], $key); ?> value="<?php echo $key ?>"><?php echo $value ?></option>
									<?php endforeach; ?>
								</select>

							<?php endif; ?>

						</div>

					<?php endfor; ?>

				</div><!--/ .meta-columns-set-->

				<div class="meta-list-set">

					<span><?php esc_html_e('Styles', 'shopme') ?>:</span>

					<ul class="options-type">
						<?php foreach ( $columns_variations[key($footer_row_middle_widgets_array)] as $key => $val ) : $active_class = '';
							if ( $footer_row_middle_widgets_array[ key($footer_row_middle_widgets_array) ][0] == $val  ) { $active_class = 'active'; }
							$value = $key + 1;
							?>

							<li data-val="<?php echo $value ?>" class="<?php echo $active_class ?>"><?php echo $value ?></li>

						<?php endforeach; ?>
					</ul>

				</div><!--/ .meta-list-set-->

				<input type="hidden" class="data-widgets-hidden" data-columns="<?php echo key($footer_row_middle_widgets_array); ?>" name="footer_row_middle_columns_variations" value='<?php echo htmlspecialchars($footer_row_middle_columns_variations) ?>' />

			<?php endif; ?>

		</div><!--/ .meta-set-->

	</div><!--/ .meta-controls-->

</div><!--/ .meta-option-->

<div class="meta-option">

	<div class="meta-description">
		<h4 class="heading"><?php esc_html_e('Show Row Bottom widgets ?', 'shopme'); ?></h4>
		<span><?php esc_html_e('Select yes if you want to show the bottom row of widgets', 'shopme'); ?></span>
	</div><!--/ .meta-description-->

	<div class="meta-controls">

		<div class="meta-button-set">

			<div class="meta-radio-button">
				<input id="footer_row_bottom_show_yes" <?php checked($footer_row_bottom_show, 'yes') ?> type="radio"
					   value="yes" name="footer_row_bottom_show" autocomplete="off" />
				<label for="footer_row_bottom_show_yes"><?php esc_html_e('Show', 'shopme') ?></label>
			</div>

			<div class="meta-radio-button">
				<input id="footer_row_bottom_show_no" <?php checked($footer_row_bottom_show, 'no') ?> type="radio"
					   value="no" name="footer_row_bottom_show" autocomplete="off" />
				<label for="footer_row_bottom_show_no"><?php esc_html_e('Hide', 'shopme') ?></label>
			</div>

		</div><!--/ .meta-button-set-->

	</div><!--/ .meta-controls-->

</div><!--/ .meta-option-->

<div class="meta-option footer_row_bottom_show" <?php if ($footer_row_bottom_show == 'no'): ?>style="display: none;"<?php endif; ?>>

	<div class="meta-description">
		<h4 class="heading"><?php esc_html_e('Footer Row Bottom Widget', 'shopme'); ?></h4>
		<span><?php esc_html_e('Here you can select how your footer row bottom widgets will be displayed.', 'shopme'); ?></span>
	</div><!--/ .meta-description-->

	<div class="meta-controls">

		<div class="meta-set">

			<?php if (is_array($footer_row_bottom_widgets_array)): ?>

				<div class="meta-list-set">

					<span><?php esc_html_e('Columns', 'shopme') ?>:</span>

					<ul class="options-columns">
						<?php for ( $i = 1; $i < $columns + 1; $i++ ) : $active_class = '';
							if ( $i == key($footer_row_bottom_widgets_array) ) { $active_class = 'active'; }
							?>

							<li data-val="<?php echo $i ?>" class="<?php echo $active_class ?>"><?php echo $i ?></li>

						<?php endfor; ?>
					</ul>

				</div><!--/ .meta-list-set-->

				<div class="meta-columns-set">

					<?php for ($i = 1; $i < $columns + 1; $i++):
						$css_class = $col = '';

						if ($i > key ($footer_row_bottom_widgets_array)) {
							$css_class = 'hidden';
						} else {
							$col = $footer_row_bottom_widgets_array[key($footer_row_bottom_widgets_array)][0][$i-1];
						}
						?>

						<div class="mod-columns <?php if (!empty($col)) { echo "mod-grid-{$col}"; } ?> <?php echo $css_class ?>">

							<?php if (!empty($get_sidebars)): ?>

								<select name="get_sidebars_bottom_widgets[]" id="">
									<?php foreach ($get_sidebars as $key => $value): ?>
										<option <?php selected($get_sidebars_bottom_widgets[$i - 1], $key); ?> value="<?php echo $key ?>"><?php echo $value ?></option>
									<?php endforeach; ?>
								</select>

							<?php endif; ?>

						</div>

					<?php endfor; ?>

				</div><!--/ .meta-columns-set-->

				<div class="meta-list-set">

					<span><?php esc_html_e('Styles', 'shopme') ?>:</span>

					<ul class="options-type">
						<?php foreach ( $columns_variations[key($footer_row_bottom_widgets_array)] as $key => $val ) : $active_class = '';
							if ( $footer_row_bottom_widgets_array[ key($footer_row_bottom_widgets_array) ][0] == $val  ) { $active_class = 'active'; }
							$value = $key + 1;
							?>

							<li data-val="<?php echo $value ?>" class="<?php echo $active_class ?>"><?php echo $value ?></li>

						<?php endforeach; ?>
					</ul>

				</div><!--/ .meta-list-set-->

				<input type="hidden" class="data-widgets-hidden" data-columns="<?php echo key($footer_row_bottom_widgets_array); ?>" name="footer_row_bottom_columns_variations" value='<?php echo htmlspecialchars($footer_row_bottom_columns_variations) ?>' />

			<?php endif; ?>

		</div><!--/ .meta-set-->

	</div><!--/ .meta-controls-->

</div><!--/ .meta-option-->