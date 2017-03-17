<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
<head>

	<!-- Basic Page Needs
    ==================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- Favicons
	==================================================== -->
	<?php if (function_exists('wp_site_icon') && has_site_icon()): ?>
		<?php wp_site_icon(); ?>
	<?php else: ?>
		<?php shopme_wp_site_icon(); ?>
	<?php endif; ?>

	<!-- Mobile Specific Metas
	==================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php wp_head(); ?>

</head>

<?php $shopme_post_id = shopme_post_id(); ?>

<body data-spy="scroll" data-target="#navigation" <?php body_class(); ?>>

<?php do_action('shopme_body_append'); ?>

<!-- - - - - - - - - - - - - - Theme Wrapper - - - - - - - - - - - - - - - - -->

<div id="theme-wrapper">

	<!-- - - - - - - - - - - - - Mobile Menu - - - - - - - - - - - - - - -->

	<nav id="mobile-advanced" class="mobile-advanced"></nav>

	<!-- - - - - - - - - - - - / Mobile Menu - - - - - - - - - - - - - -->

	<!-- - - - - - - - - - - - - - Layout - - - - - - - - - - - - - - - - -->

	<div class="<?php echo esc_attr(SHOPME_HELPER::page_layout()) ?>">

		<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

		<?php
			$shopme_header_layout = mad_meta('shopme_header_layout', '', $shopme_post_id);

			if (empty($shopme_header_layout)) {
				$shopme_header_layout = shopme_custom_get_option('header_layout', 'type_6');
			}
		?>

		<header id="header" data-shrink="<?php echo shopme_custom_get_option('sticky_navigation') ?>" class="<?php echo esc_attr($shopme_header_layout); ?>">
			<?php do_action('shopme_header_layout', $shopme_header_layout); ?>
		</header><!--/ #header -->

		<!-- - - - - - - - - - - - - - / Header - - - - - - - - - - - - - - -->

		<?php
			/**
			 * shopme_header_after hook
			 *
			 * @hooked shopme_header_after_breadcrumbs - 10
			 */

			do_action('shopme_header_after');
		?>

		<!-- - - - - - - - - - - - - Page Content - - - - - - - - - - - - - -->

		<?php $shopme_sidebar_position = SHOPME_HELPER::template_layout_class('sidebar_position'); ?>

		<div class="page_wrapper <?php echo esc_attr($shopme_sidebar_position); ?>">

			<?php if ($shopme_sidebar_position != 'no_sidebar'): ?>

				<div class="container">

					<?php
						/**
						 * shopme_before_content hook
						 *
						 * @hooked shopme_before_content - 10
						 */
						do_action('shopme_before_content');
					?>

					<div class="row">

						<?php if (shopme_custom_get_option('position_sidebar_mobile') == 'top'): ?>

							<?php get_sidebar(); ?>

						<?php endif; ?>

						<main id="main" class="col-sm-8 col-md-9 content-holder">

			<?php else: ?>

				<div class="container content-holder">

					<div class="row">

						<div class="col-sm-12">

			<?php endif; ?>