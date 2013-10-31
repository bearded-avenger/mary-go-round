<?php
/**
 	* Registers Post Type for Mary Go ROund
 	*
 	* @package     Mary Go Round
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       0.1
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class baMaryGoRoundPostType {

	function __construct() {

       	add_action('init',array($this,'do_type'));

	}

	function do_type() {

		$labels = array(
			'name'                => _x( 'Carousels', 'Post Type General Name', 'mary-go-round' ),
			'singular_name'       => _x( 'Carousel', 'Post Type Singular Name', 'mary-go-round' ),
			'menu_name'           => __( 'Mary Go Round', 'mary-go-round' ),
			'parent_item_colon'   => __( 'Parent Carousel:', 'mary-go-round' ),
			'all_items'           => __( 'All Carousels', 'mary-go-round' ),
			'view_item'           => __( 'View Carousel', 'mary-go-round' ),
			'add_new_item'        => __( 'Add New Carousel', 'mary-go-round' ),
			'add_new'             => __( 'New Carousel', 'mary-go-round' ),
			'edit_item'           => __( 'Edit Carousel', 'mary-go-round' ),
			'update_item'         => __( 'Update Carousel', 'mary-go-round' ),
			'search_items'        => __( 'Search carousels', 'mary-go-round' ),
			'not_found'           => __( 'No carousels found', 'mary-go-round' ),
			'not_found_in_trash'  => __( 'No carousels found in Trash', 'mary-go-round' ),
		);
		$args = array(
			'label'               => __( 'Mary Go Round', 'mary-go-round' ),
			'description'         => __( 'Create responsive carousels', 'mary-go-round' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'rewrite'             => false,
			'capability_type'     => 'page',
		);
		register_post_type( 'mary_go_round', $args );

	}

}
new baMaryGoRoundPostType;