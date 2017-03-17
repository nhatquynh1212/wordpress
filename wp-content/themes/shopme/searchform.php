<form method="get" role="search" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<p>
		<label for="s"><?php esc_html_e('Search for:', 'shopme'); ?></label>
		<input type="text" autocomplete="off" name="s" id="s" placeholder="<?php esc_attr_e( 'Type text and hit enter', 'shopme' ) ?>"  value="<?php echo get_search_query(); ?>" />
		<button type="submit" class="submit-search" id="searchsubmit"><?php esc_attr_e( 'Search', 'shopme' ); ?></button>
	</p>
</form>