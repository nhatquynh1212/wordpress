<?php

$shopme_include_plugins = array(
	'post-ratings'
);

foreach ($shopme_include_plugins as $inc) {
	require_once ( SHOPME_INC_PLUGINS_PATH . trailingslashit($inc) . 'init' . '.php' );
}