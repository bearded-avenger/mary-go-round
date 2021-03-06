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
			'margin'			=> '',
			'imgsize'			=> 'medium',
			'captions'			=> 'false',
			'linksnewwindow'	=> '',
			'lightbox'			=> '',
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

		// Enqueue styles and scripts
		wp_enqueue_script('mgr-script');
        wp_enqueue_style('mgr-style');

        // LB scripts on demand
        if($atts['lightbox']){
        	wp_enqueue_script('mgr-lb-script');
        	wp_enqueue_style('mgr-lb-style');
        }

		?>
			<!-- Mary Go Round Instantiation- by @nphaskins -->
			<script>
				jQuery(document).ready(function(){
					jQuery('#mgr-carousel-<?php echo $hash;?>').owlCarousel({
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
					<?php if($atts['lightbox']) { ?>
						jQuery('.mgr-group-<?php echo $hash;?>').colorbox({
							rel:'mgr-group',
							onClickNext: false,
						});
					<?php } ?>

				});

			</script>

			<!-- Margy Go Round Branding- by @nphaskins -->
			<?php if ( $atts['brand'] || $atts['color'] || $atts['margin'] ) { ?>
				<style>
					#mgr-carousel-<?php echo $hash;?> .owl-controls .owl-buttons div{
						background: <?php echo $atts['brand'];?>;
						color:<?php echo $atts['color'];?>;
					}
					#mgr-carousel-<?php echo $hash;?> .owl-controls .owl-page span{
						background: <?php echo $atts['brand'];?>;
					}
					<?php if($atts['margin']) {?>
					#mgr-carousel-<?php echo $hash;?> .owl-item .item{
						margin: 0 <?php echo $atts['margin'];?>;
					}
					<?php } ?>
				</style>
			<?php }

		do_action('mgr_before');

		$out = sprintf('<div id="mgr-carousel-%s" class="mgr-carousel">', $hash);

			do_action('mgr_inside_top');

			$images = get_field('mgr_gallery', $atts['id']);
			$target = $atts['linksnewwindow'] ? '_blank' : '_self';

			if ( $images ):

	            foreach( $images as $image ):

	            	$getlink  = $image['description'];
	            	$getimg	  = $image['sizes'][$atts['imgsize']];
	            	$getlbimg = $image['sizes']['large'];
	            	$getalt   = $image['alt'];
	            	$getcap   = $image['caption'];

	            	$caption = $getcap ? sprintf('<div class="mgr-caption">%s</div>', $getcap) : false;

	            	if ($atts['lightbox']){

		            	$theimage = sprintf('<a class="mgr-group-%s" rel="mgr-group" href="%s" target="%s">%s<img src="%s" alt="%s" /></a>',$hash,$getlbimg,$target,$caption,$getimg,$getalt);

		            } else {

		            	$theimage = ($image['description']) ?
		            				sprintf('<a href="%s" target="%s">%s<img src="%s" alt="%s" /></a>',$getlink,$target,$caption,$getimg,$getalt) 
		            				: sprintf('%s<img src="%s" alt="%s" />',$caption,$getimg,$getalt);
		            }

	               	$out .= apply_filters('mgr_item_output',sprintf('<div class="item">%s</div>',$theimage));

	          	 endforeach;

			endif;

			do_action('mgr_inside_bottom');

		$out .= sprintf('</div>');

		do_action('mgr_after');

		return apply_filters('mgr_output',$out);

	}

}
new baMaryGoRoundSC;

