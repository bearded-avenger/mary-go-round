<?php
if(function_exists("register_field_group")){

	register_field_group(array (
		'id' => 'acf_mgr-gallery',
		'title' => 'MGR Gallery',
		'fields' => array (
			array (
				'key' => 'field_527185e3d1924',
				'label' => 'Mary Go Round Images',
				'name' => 'mgr_gallery',
				'type' => 'gallery',
				'instructions' => 'Upload some images',
				'required' => 1,
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5271a92ff6ccc',
				'label' => 'Gallery Instructions',
				'name' => '',
				'type' => 'message',
				'message' => '<h4>Instructions</h4>
	1. Upload some images!
	2. Publish the post
	3. Take note of the post ID above in the browser address bar. It reads <code>post=53</code>.
	4. Enter the ID into the id attribute of the shortcode. The ID is the only required attribute.
	5. Use the shortcode on your site such as in posts or pages.
	6. Extend the shortcode with any available shortcode attributes below.
	
	<h4>The Shortcode</h4>
	<code>[mary_go_round id=""]</code>
	
	<h4>Available Shortcode Attributes</h4>
	id - carousel ID
	brand - specify a background color for the prev/next buttons and nav circles. use a value like <code>#07a1cd</code>
	color - specify a color for the prev/next buttons and nav circles. use a value like <code>#777</code>
	items - items to show
	slidespeed - speed of slideshow. enter a value like 200
	autoplay - true or false
	autoheight - helps when using images with different heights
	navigation - true or false
	pagination - true or false
	paginationnumbers - show numbers intead of the circles if using navigation
	singleitem - shows one item at a time like a rotating banner. true or false
	itemsdesktop - how many items to show at a specific resolution. enter a value like <code>1199,3</code> , which means, show 3 items on 1199px resolution and up.
	itemsdesktopsmall - see above - default is <code>979,3</code>
	itemstablet - see above - default is <code>768,2</code>
	itemsmobile - see above - default is <code>479,1</code>',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'mary_go_round',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'slug',
				7 => 'author',
				8 => 'format',
			),
		),
		'menu_order' => 0,
	));
}