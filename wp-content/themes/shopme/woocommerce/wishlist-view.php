<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.7
 */
?>

<form
	id="yith-wcwl-form"
	action="<?php echo esc_url( YITH_WCWL()->get_wishlist_url( 'view' . ( $wishlist_meta['is_default'] != 1 ? '/' . $wishlist_meta['wishlist_token'] : '' ) ) ) ?>"
	method="post"
>

    <!-- TITLE -->
    <?php
    do_action( 'yith_wcwl_before_wishlist_title' );

    if( ! empty( $page_title ) ) :
    ?>
        <div class="wishlist-title <?php echo ( $wishlist_meta['is_default'] != 1 && $is_user_owner ) ? 'wishlist-title-with-form' : ''?>">
            <?php echo apply_filters( 'yith_wcwl_wishlist_title', '<h1>' . $page_title . '</h1>' ); ?>
            <?php if( $wishlist_meta['is_default'] != 1 && $is_user_owner ): ?>
                <a class="btn button show-title-form">
                    <?php echo apply_filters( 'yith_wcwl_edit_title_icon', '<i class="fa fa-pencil"></i>' )?>
                    <?php esc_html_e( 'Edit title', 'shopme' ) ?>
                </a>
            <?php endif; ?>
        </div>
        <?php if( $wishlist_meta['is_default'] != 1 && $is_user_owner ): ?>
            <div class="hidden-title-form">
                <input type="text" value="<?php echo $page_title ?>" name="wishlist_name"/>
                <button>
                    <?php echo apply_filters( 'yith_wcwl_save_wishlist_title_icon', '<i class="fa fa-check"></i>' )?>
                    <?php esc_html_e( 'Save', 'shopme' )?>
                </button>
                <a class="hide-title-form btn button">
                    <?php echo apply_filters( 'yith_wcwl_cancel_wishlist_title_icon', '<i class="fa fa-remove"></i>' )?>
                    <?php esc_html_e( 'Cancel', 'shopme' )?>
                </a>
            </div>
        <?php endif; ?>
    <?php
    endif;

     do_action( 'yith_wcwl_before_wishlist' ); ?>

    <!-- WISHLIST TABLE -->

	<?php if ( $pagination == 'yes' && !empty( $page_links ) ): ?>

		<header class="top_box on_the_sides">

			<div class="left_side v_centered">

			</div>

			<div class="right_side"><?php echo $page_links ?></div>

		</header><!--/ .top_box-->

	<?php endif; ?>

	<div class="table_wrap">

		<table
			class="shop_table cart table_type_1 wishlist_table"
			cellspacing="0"
			data-pagination="<?php echo esc_attr( $pagination )?>"
			data-per-page="<?php echo esc_attr( $per_page )?>"
			data-page="<?php echo esc_attr( $current_page )?>"
			data-id="<?php echo ( is_user_logged_in() ) ? esc_attr( $wishlist_meta['ID'] ) : '' ?>"
			data-token="<?php echo ( ! empty( $wishlist_meta['wishlist_token'] ) && is_user_logged_in() ) ? esc_attr( $wishlist_meta['wishlist_token'] ) : '' ?>"
			>

		<?php $column_count = 2; ?>

		<thead>
			<tr>
				<th class="product-thumbnail product_image_col"><?php esc_html_e('Product Image', 'shopme') ?></th>

				<th class="product-name product_title_col">
					<span class="nobr"><?php echo apply_filters( 'yith_wcwl_wishlist_view_name_heading', esc_html__( 'Product Name and Category', 'shopme' ) ) ?></span>
				</th>

				<?php if( $show_price ) : ?>

					<th class="product-price product_price_col">
						<span class="nobr">
							<?php echo apply_filters( 'yith_wcwl_wishlist_view_price_heading', esc_html__( 'Price', 'shopme' ) ) ?>
						</span>
					</th>

					<?php
					$column_count ++;
				endif;
				?>

				<?php if( $show_stock_status ) : ?>

					<th class="product-stock-stauts">
						<span class="nobr">
							<?php echo apply_filters( 'yith_wcwl_wishlist_view_stock_heading', esc_html__( 'Stock Status', 'shopme' ) ) ?>
						</span>
					</th>

					<?php
					$column_count ++;
				endif;
				?>

				<?php if( $show_last_column ) : ?>

					<th class="product-add-to-cart"><span class="nobr"><?php esc_html_e('Action', 'shopme') ?></span></th>

					<?php
					$column_count ++;
				endif;
				?>
			</tr>
		</thead>

		<tbody>
		<?php
		if( count( $wishlist_items ) > 0 ) :
			foreach( $wishlist_items as $item ) :
				global $product;
				if( function_exists( 'wc_get_product' ) ) {
					$product = wc_get_product( $item['prod_id'] );
				}
				else{
					$product = get_product( $item['prod_id'] );
				}

				if( $product !== false && $product->exists() ) :
					$availability = $product->get_availability();
					$stock_status = $availability['class'];
					?>
					<tr id="yith-wcwl-row-<?php echo $item['prod_id'] ?>" data-row-id="<?php echo $item['prod_id'] ?>">

						<td class="product-thumbnail" data-title="<?php esc_html_e('Product Image', 'shopme') ?>">
							<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>">
								<?php echo $product->get_image(array(83, 83)) ?>
							</a>
						</td>

						<td class="product-name" data-title="<?php esc_html_e('Product Name and Category', 'shopme') ?>">
							<a class="product_title" href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></a>
							<?php echo $product->get_categories(); ?>
						</td>

						<?php if( $show_price ) : ?>
							<td class="product-price" data-title="<?php esc_html_e('Price', 'shopme') ?>">
								<?php
								if( is_a( $product, 'WC_Product_Bundle' ) ){
									if( $product->min_price != $product->max_price ){
										echo sprintf( '%s - %s', wc_price( $product->min_price ), wc_price( $product->max_price ) );
									}
									else{
										echo wc_price( $product->min_price );
									}
								}
								elseif( $product->price != '0' ) {
									echo $product->get_price_html();
								}
								else {
									echo apply_filters( 'yith_free_text', esc_html__( 'Free!', 'shopme' ) );
								}
								?>
							</td>
						<?php endif ?>

						<?php if( $show_stock_status ) : ?>
							<td class="product-stock-status" data-title="<?php esc_html_e('Stock Status', 'shopme') ?>">
								<?php
								if( $stock_status == 'out-of-stock' ) {
									$stock_status = "Out";
									echo '<span class="wishlist-out-of-stock">' . esc_html__( 'Out of Stock', 'shopme' ) . '</span>';
								} else {
									$stock_status = "In";
									echo '<span class="wishlist-in-stock">' . esc_html__( 'In Stock', 'shopme' ) . '</span>';
								}
								?>
							</td>
						<?php endif ?>

						<?php if( $show_last_column ): ?>
							<td class="product-add-to-cart" data-title="<?php esc_html_e('Action', 'shopme') ?>">
								<!-- Date added -->
								<?php
								if( $show_dateadded && isset( $item['dateadded'] ) ):
									echo '<span class="dateadded">' . sprintf( esc_html__( 'Added on : %s', 'shopme' ), date_i18n( get_option( 'date_format' ), strtotime( $item['dateadded'] ) ) ) . '</span>';
								endif;
								?>

								<!-- Add to cart button -->
								<?php if( $show_add_to_cart && isset( $stock_status ) && $stock_status != 'Out' ): ?>
									<?php
										wc_get_template( 'loop/add-to-cart.php' );
									?>
								<?php endif ?>

								<!-- Change wishlist -->
								<?php if( $available_multi_wishlist && is_user_logged_in() && count( $users_wishlists ) > 1 && $move_to_another_wishlist ): ?>
									<select class="change-wishlist selectBox">
										<option value=""><?php esc_html_e( 'Move', 'shopme' ) ?></option>
										<?php
										foreach( $users_wishlists as $wl ):
											if( $wl['wishlist_token'] == $wishlist_meta['wishlist_token'] ){
												continue;
											}

											?>
											<option value="<?php echo esc_attr( $wl['wishlist_token'] ) ?>">
												<?php
												$wl_title = ! empty( $wl['wishlist_name'] ) ? esc_html( $wl['wishlist_name'] ) : esc_html( $default_wishlsit_title );
												if( $wl['wishlist_privacy'] == 1 ){
													$wl_privacy = esc_html__( 'Shared', 'shopme' );
												}
												elseif( $wl['wishlist_privacy'] == 2 ){
													$wl_privacy = esc_html__( 'Private', 'shopme' );
												}
												else{
													$wl_privacy = esc_html__( 'Public', 'shopme' );
												}

												echo sprintf( '%s - %s', $wl_title, $wl_privacy );
												?>
											</option>
										<?php
										endforeach;
										?>
									</select>
								<?php endif; ?>

								<div class="clear"></div>

								<!-- Remove from wishlist -->
								<?php if( $is_user_owner && $repeat_remove_button ): ?>
									<a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="remove_from_wishlist button_dark_grey" title="<?php esc_html_e( 'Remove this product', 'shopme' ) ?>"><?php _e( 'Remove', 'shopme' ) ?></a>
								<?php endif; ?>
							</td>
						<?php endif; ?>
					</tr>
				<?php
				endif;
			endforeach;
		else: ?>
			<tr>
				<td colspan="<?php echo esc_attr( $column_count ) ?>" class="wishlist-empty"><?php esc_html_e( 'No products were added to the wishlist', 'shopme' ) ?></td>
			</tr>
		<?php endif; ?>

		</tbody>

		<tfoot>
		<tr>
			<td colspan="<?php echo esc_attr( $column_count ) ?>">
				<?php if( $show_cb ) : ?>
					<div class="custom-add-to-cart-button-cotaniner">
						<a href="<?php echo esc_url( add_query_arg( array( 'wishlist_products_to_add_to_cart' => '', 'wishlist_token' => $wishlist_meta['wishlist_token'] ) ) ) ?>" class="button alt" id="custom_add_to_cart"><?php esc_html_e( 'Add the selected products to the cart', 'shopme' ) ?></a>
					</div>
				<?php endif; ?>

				<?php if ( $is_user_owner && $show_ask_estimate_button && $count > 0 ): ?>
					<div class="ask-an-estimate-button-container">
						<a href="<?php echo ( $additional_info ) ? '#ask_an_estimate_popup' : esc_url($ask_estimate_url) ?>" class="btn button ask-an-estimate-button" <?php echo ( $additional_info ) ? 'data-rel="prettyPhoto[ask_an_estimate]"' : '' ?> >
							<?php echo apply_filters( 'yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>' )?>
							<?php esc_html_e( 'Ask for an estimate', 'shopme' ) ?>
						</a>
					</div>
				<?php endif; ?>

				<?php
				do_action( 'yith_wcwl_before_wishlist_share' );

				if ( $is_user_owner && $wishlist_meta['wishlist_privacy'] != 2 && $share_enabled ){
					yith_wcwl_get_template( 'share.php', $share_atts );
				}

				do_action( 'yith_wcwl_after_wishlist_share' );
				?>
			</td>
		</tr>
		</tfoot>

		</table>

	</div><!--/ .table_wrap-->

    <?php wp_nonce_field( 'yith_wcwl_edit_wishlist_action', 'yith_wcwl_edit_wishlist' ); ?>

    <?php if( $wishlist_meta['is_default'] != 1 ): ?>
        <input type="hidden" value="<?php echo $wishlist_meta['wishlist_token'] ?>" name="wishlist_id" id="wishlist_id">
    <?php endif; ?>

    <?php do_action( 'yith_wcwl_after_wishlist' ); ?>

	<?php
	if ( $pagination == 'yes' && !empty( $page_links) ) : ?>

		<footer class="bottom_box on_the_sides">

			<div class="left_side v_centered"></div>

			<div class="right_side"><?php echo $page_links ?></div>

		</footer><!--/ .bottom_box-->

	<?php endif; ?>

</form>

<?php if( $additional_info ): ?>
	<div id="ask_an_estimate_popup">
		<form action="<?php echo $ask_estimate_url ?>" method="post" class="wishlist-ask-an-estimate-popup">
			<?php if( ! empty( $additional_info_label ) ):?>
				<label for="additional_notes"><?php echo esc_html( $additional_info_label ) ?></label>
			<?php endif; ?>
			<textarea id="additional_notes" name="additional_notes"></textarea>

			<button class="btn button ask-an-estimate-button ask-an-estimate-button-popup" >
				<?php echo apply_filters( 'yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>' )?>
				<?php esc_html_e( 'Ask for an estimate', 'shopme' ) ?>
			</button>
		</form>
	</div>
<?php endif; ?>