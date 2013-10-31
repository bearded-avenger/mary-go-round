<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class baMaryGoRoundSC {

	function __construct() {

       	add_shortcode('mary_go_round', array($this,'mgr_sc'));

	}

	function mgr_sc($atts, $content = null){

		// globals
		global $post;
		$hash = rand();

		// sc defaults
		$defaults = array(
			'id'				=> '',
			'brand'				=> '',
			'color'				=> '',
			'items'				=> 4,
			'slidespeed' 		=> 200,
			'autoplay'			=> 'false',
			'autoheight'		=> 'false',
			'navigation' 		=> 'false',
			'pagination'		=> 'true',
			'paginationnumbers'	=> 'false',
			'singleitem'		=> 'false',
			'itemsdesktop'		=> '1199,3',
			'itemsdesktopsmall'	=> '979,3',
			'itemstablet'		=> '768,2',
			'itemsmobile'		=> '479,1'
		);
		$atts = shortcode_atts($defaults, $atts);
		
		wp_enqueue_script('mgr-script');

        // dont load the style in pagelines it uses less
        if(!function_exists('pl_has_editor')) {
            wp_enqueue_style('mgr-style');
        }


		?>
			<!-- Mary Go Round Instantiation- by @nphaskins -->
			<script>
				jQuery(document).ready(function(){
					jQuery("#mgr-carousel-<?php echo $hash;?>").owlCarousel({
						baseClass: 'mgr-carousel',
					    items: <?php echo $atts['items'];?>,
					    singleItem: <?php echo $atts['singleitem'];?>,
					    slideSpeed: <?php echo $atts['slidespeed'];?>,
					    autoPlay: <?php echo $atts['autoplay'];?>,
					    autoHeight: <?php echo $atts['autoheight'];?>,
					    navigation: <?php echo $atts['navigation'];?>,
					    pagination: <?php echo $atts['pagination'];?>,
					    paginationNumbers: <?php echo $atts['paginationnumbers'];?>,
					    <?php if(!$atts['singleitem']) { ?>
					    itemsDesktop: [<?php echo $atts['itemsdesktop'];?>],
					    itemsDesktopSmall: [<?php echo $atts['itemsdesktopsmall'];?>],
					    itemsTablet: [<?php echo $atts['itemstablet'];?>],
					    itemsMobile: [<?php echo $atts['itemsmobile'];?>]
					    <?php } ?>
					});

				});
			</script>

			<!-- Margy Go Round Branding- by @nphaskins -->
			<?php if ( $atts['brand'] || $atts['color'] ) { ?>
				<style>
					#mgr-carousel-<?php echo $hash;?> .owl-controls .owl-buttons div{
						background: <?php echo $atts['brand'];?>;
						color:<?php echo $atts['color'];?>;
					}
					#mgr-carousel-<?php echo $hash;?> .owl-controls .owl-page span{
						background: <?php echo $atts['brand'];?>;
					}
				</style>
			<?php }


		$out = sprintf('<div id="mgr-carousel-%s" class="mgr-carousel">', $hash);

		$images = get_field('mgr_gallery', $atts['id']);

		if( $images ):

            foreach( $images as $image ):
                $out .= sprintf('<img src="%s" alt="%s" />',$image['url'],$image['alt']);
          	 endforeach;

		endif;

		$out .= sprintf('</div>');

		return $out;

	}

}
new baMaryGoRoundSC;

