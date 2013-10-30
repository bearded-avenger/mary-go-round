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
			'items'				=> 4,
			'slideSpeed' 		=> 200,
			'autoplay'			=> 'false',
			'navigation' 		=> 'false',
			'pagination'		=> 'true',
			'singleItem'		=> 'false',
			'itemsDesktop'		=> '1199,3',
			'itemsDesktopSmall'	=> '979,3',
			'itemsTablet'		=> '768,2',
			'itemsMobile'		=> '479,1'
		);
		$atts = shortcode_atts($defaults, $atts);

		wp_enqueue_script('mgr-script');

		if(!function_exists('pl_has_editor')) {
			wp_enqueue_style('mgr-style');
		}

		?>
			<!-- Mary Go Round - by @nphaskins -->
			<script>
				jQuery(document).ready(function(){
					jQuery("#mgr-carousel-<?php echo $hash;?>").owlCarousel({
						baseClass: 'mgr-carousel',
					    items: <?php echo $atts['items'];?>,
					    singleItem: <?php echo $atts['singleItem'];?>,
					    slideSpeed: <?php echo $atts['slideSpeed'];?>,
					    autoPlay: <?php echo $atts['autoplay'];?>,
					    navigation: <?php echo $atts['navigation'];?>,
					    pagination: <?php echo $atts['pagination'];?>,
					    <?php if(!$atts['singleItem']) { ?>
					    itemsDesktop: [<?php echo $atts['itemsDesktop'];?>],
					    itemsDesktopSmall: [<?php echo $atts['itemsDesktopSmall'];?>],
					    itemsTablet: [<?php echo $atts['itemsTablet'];?>],
					    itemsMobile: [<?php echo $atts['itemsMobile'];?>]
					    <?php } ?>
					});
				});
			</script>
		<?php

		$out = sprintf('<div id="mgr-carousel-%s" class="mgr-carousel">', $hash);

			$query = new WP_Query( array( 'post_type' => 'mary_go_round', 'posts_per_page' => -1 ) );

			if( $query->have_posts() ){
			    while($query->have_posts()){
			        $query->the_post();
			        $image_query = new WP_Query( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image', 'posts_per_page' => -1, 'post_parent' => get_the_ID(), 'order' => 'ASC', 'orderby' => 'name' ) );
			        while( $image_query->have_posts() ) {

			            $image_query->the_post();

			            $img = wp_get_attachment_image_src( get_the_ID(),'medium' );

			            $out .= sprintf('<img src="%s" alt="">', $img[0]);
					}

			    }
			}

		$out .= sprintf('</div>');

		return $out;

	}

}
new baMaryGoRoundSC;

