<?php

if (!class_exists('SHOPME_WOO_TEMPLATES_HOOKS')) {

	class SHOPME_WOO_TEMPLATES_HOOKS {

		function __construct() {
			$this->add_hooks();
		}

		public function init() { }

		public function add_hooks() {

			add_action('woocommerce_before_main_content', 'shopme_woocommerce_content_top');

		}


	}

	new SHOPME_WOO_TEMPLATES_HOOKS();
}
