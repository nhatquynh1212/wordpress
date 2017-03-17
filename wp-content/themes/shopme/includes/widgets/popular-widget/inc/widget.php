<?php
	global $wpdb;

	$lastdays = '';

	$this->args = $args;
	$this->instance = wp_parse_args($instance, $this->defaults);

	extract($this->args);
	extract($this->instance);

	$this->instance['number'] = $this->number;

	if (empty($this->instance['meta_key'])) {
		$this->instance['meta_key'] = '_popular_views';
	}

	$this->time = date('Y-m-d', strtotime( "-{$lastdays} days", current_time('timestamp')));

	//start widget
	$output = $before_widget ."\n";
	if ($title) {
		$output  .= $before_title. $title . $after_title . "\n";
	}

	$output .= '<ul class="list_of_entries">';
		switch ($type) {
			case 'popular':
				$output .= $this->get_most_viewed();
				break;
			case 'latest':
				$output .= $this->get_latest_posts();
				break;
		}
	$output .= '</ul>';
	echo $output .=  $after_widget . "\n";