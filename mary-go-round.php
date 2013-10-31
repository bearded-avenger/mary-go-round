<?php
/*
Author: Nick Haskins
Author URI: http://nickhaskins.com
Plugin Name: Mary Go Round by Bearded Avenger
Plugin URI: http://nickhaskins.com
Version: 0.9.3
Description: Responsive Wordpress carousel.
*/

class baMaryGoRound {

	const version = '0.9.3';

	function __construct() {

        $this->dir  = plugin_dir_path( __FILE__ );
        $this->url  = plugins_url( '', __FILE__ );

        include('type.php');
        include('shortcode.php');
        include('columns.php');
        include('updater.php');

        // hide acf UI
      	//define( 'ACF_LITE' , true );

      	// load acf
        if( !class_exists( 'Acf' ) ) {
			include_once('libs/advanced-custom-fields/acf.php' );
		}

		// load acf gallery
		if( !class_exists( 'acf_field_gallery' ) ){
			include_once('libs/acf-gallery/acf-gallery.php');
		}

		// Load Updater
		if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
			// load our custom updater
			include( 'EDD_SL_Plugin_Updater.php' );
		}

		// register ACF fields
		include('acf-register.php');

		// start the show
        $this->init();

	}

	function init(){
		add_action('wp_enqueue_scripts',array($this,'scripts'));

		// only load the less file if we're in dms
		add_action( 'template_redirect', array($this, 'dms_less' ));
	}

	function scripts(){
		wp_enqueue_script('jquery');

		wp_register_style( 'mgr-style',   $this->url.'/libs/carousel/mgr.carousel.min.css', self::version, true);
		wp_register_script('mgr-script',  $this->url.'/libs/carousel/mgr.carousel.min.js', array('jquery'), self::version, true);

		// colorbox
		wp_register_style( 'mgr-lb-style',   $this->url.'/libs/colorbox/colorbox.css', self::version, true);
		wp_register_script('mgr-lb-script',  $this->url.'/libs/colorbox/jquery.colorbox.js', array('jquery'), self::version, true);
	}

	// run dms less file
	function dms_less() {
		$file = sprintf( '%sstyle.less', $this->dir );
		if(function_exists('pagelines_insert_core_less') && function_exists('pl_has_editor'))
			pagelines_insert_core_less( $file );
	}

}
new baMaryGoRound;


