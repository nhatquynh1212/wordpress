			<?php $shopme_sidebar_position = SHOPME_HELPER::template_layout_class('sidebar_position'); ?>

			<?php if ($shopme_sidebar_position != 'no_sidebar'): ?>

				</main><!--/ #main-->

				<?php if (shopme_custom_get_option('position_sidebar_mobile') == 'bottom'): ?>

					<?php get_sidebar(); ?>

				<?php endif; ?>

					</div><!--/ .row-->
				</div><!--/ .container-->

			<?php else: ?>

						</div><!--/ .col-sm-12-->
					</div><!--/ .row-->
				</div><!--/ .container-->

			<?php endif; ?>

		</div><!--/ .page_wrapper -->

		<!-- - - - - - - - - - - -/ Page Content - - - - - - - - - - - - - - -->

			<?php
				/**
				 * shopme_after_content hook
				 *
				 * @hooked shopme_after_content - 10
				 */
				do_action('shopme_after_content');
			?>

		<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

		<footer id="footer">

			<?php
			/**
			 * shopme_footer_in_top_part hook
			 *
			 * @hooked footer_in_top_part_widgets - 10
			 */

			do_action('shopme_footer_in_top_part');
			?>

			<?php
			/**
			 * shopme_footer_in_bottom_part hook
			 *
			 * @hooked footer_in_bottom_part - 10
			 */

			do_action('shopme_footer_in_bottom_part');
			?>

		</footer><!--/ #footer-->

		<!-- - - - - - - - - - - - - -/ Footer - - - - - - - - - - - - - - - - -->

	</div><!--/ [layout]-->

</div><!--/ #theme-wrapper-->

<?php wp_footer(); ?>

</body>
</html>