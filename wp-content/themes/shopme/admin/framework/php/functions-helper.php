<?php

/*  Write To File
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_write_to_file')) {
	function shopme_write_to_file($file, $content = '', $verify = true) {
		$handle = @fopen( $file, 'w' );

		if ($handle) {
			$create = fwrite( $handle, $content );
			fclose( $handle );

			if ($verify === true) {
				$handle = fopen($file, "r");
				$filecontent = fread($handle, filesize($file));
				$create = ($filecontent == $content) ? true : false;
				fclose( $handle );
			}
		} else {
			$create  = false;
		}

		if ($create !== false) {
			$create = true;
		}
		return $create;
	}

}

/*  Create folder
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_backend_create_folder')) {
	function shopme_backend_create_folder(&$folder, $addindex = true) {
		if (is_dir($folder) && $addindex == false) {
			return true;
		}
		$created = wp_mkdir_p(trailingslashit($folder));
		@chmod($folder, 0777);

		if ($addindex == false) return $created;

		$index_file = trailingslashit($folder) . 'index.php';
		if (file_exists($index_file)) {
			return $created;
		}

		$handle = @fopen($index_file, 'w');
		if ($handle) {
			fwrite( $handle, "<?php\r\necho 'Browsing the directory is not allowed!';\r\n?>" );
			fclose( $handle );
		}
		return $created;
	}
}

/*  Elements decode
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_deep_decode')) {

	function shopme_deep_decode($elements) {
		if (is_array($elements) || is_object($elements)) {
			foreach ($elements as $key=>$element) {
				$elements[$key] = shopme_deep_decode($element);
			}
		} else {
			$elements = html_entity_decode($elements, ENT_COMPAT, get_bloginfo('charset'));
		}
		return $elements;
	}

}

/*  Get Option
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_custom_get_option')) {
	function shopme_custom_get_option($key = false, $default = "", $decode = false) {
		global $shopme_global_data;

		$result = $shopme_global_data->options;

		if (is_array($key)) {
			$result = $result[$key[0]];
		} else {
			$result = $result['shopme'];
		}

		if ($key === false) {
		} else if(isset($result[$key])) {
			$result = $result[$key];
		} else {
			$result = $default;
		}

		if ($decode) { $result = shopme_deep_decode($result); }
		if ($result == "") { $result = $default; }
		return $result;
	}
}

if (!function_exists('shopme_flush_rewrites')) {

	function shopme_flush_rewrites() {
		if (get_option('shopme_rewrite_flush')) {
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
			delete_option('shopme_rewrite_flush');
		}
	}

	add_action('wp_loaded', 'shopme_flush_rewrites');

}


