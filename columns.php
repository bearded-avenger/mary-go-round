<?php

class mgrColumns {

	function __construct(){
		add_filter('manage_mary_go_round_posts_columns', array($this,'col_head'));
		add_action('manage_mary_go_round_posts_custom_column', array($this,'col_content'), 10, 2);
	}

	function col_head($defaults) {
	    $defaults['mgr_shortcode'] = __('Carousel Shortcode','mary-go-round');
	    return $defaults;
	}

	function col_content($column_name, $post_ID) {
	    if ($column_name == 'mgr_shortcode') {
	        printf('[mary_go_round id="%s"]',$post_ID);
	    }
	}
}

new mgrColumns;

