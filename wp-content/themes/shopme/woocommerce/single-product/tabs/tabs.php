<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<section class="section_offset">

		<div class="mad-tabs type_2">

			<ul class="tabs_nav clearfix">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<li class="<?php echo $key ?>_tab">
						<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="tab_containers_wrap">

				<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

				<?php foreach ( $tabs as $key => $tab ) : ?>

					<div class="tab_container" id="tab-<?php echo $key ?>">
						<?php call_user_func( $tab['callback'], $key, $tab ) ?>
					</div>

				<?php endforeach; ?>

			</div><!--/ .tab_containers_wrap-->

		</div><!--/ .mad-tabs-->

	</section><!--/ .section_offset-->

<?php endif; ?>