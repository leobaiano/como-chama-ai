<?php 
/*
Author: ThemeLuxe
URL: htp://themeluxe.com
*/

/* ---------------------------------------------------------------------- */
/*	INIT META BOXES
/* ---------------------------------------------------------------------- */

$metapath1  = LUXE_INC_DIR . '/admin/metaboxes/page-layout.php';
$metapath2  = LUXE_INC_DIR . '/admin/metaboxes/page-background.php';
$metapath3  = LUXE_INC_DIR . '/admin/metaboxes/team.php';
$metapath4  = LUXE_INC_DIR . '/admin/metaboxes/post.php';
$metapath5  = LUXE_INC_DIR . '/admin/metaboxes/portfolio.php';

$mb1 = new VP_Metabox($metapath1);
$mb2 = new VP_Metabox($metapath2);
$mb3 = new VP_Metabox($metapath3);
$mb4 = new VP_Metabox($metapath4); 
$mb5 = new VP_Metabox($metapath5); 


/* ---------------------------------------------------------------------- */
/*	METABOX CUSTOM CSS
/* ---------------------------------------------------------------------- */

function luxe_metabox_css() {

	if ( get_post() )
	{
		// get current page ID (if set to "posts" page or "home")
		if ( is_home() || is_singular('post') ) {
			$page_id = get_option('page_for_posts');
		}
		else {
			$page_id = get_the_ID();
		}

		// page background 
		$background_color = luxe_get_meta('page-background.background-color', '' , $page_id);
		$background_image = luxe_get_meta('page-background.background-image', '' , $page_id);
		$background_repeat = luxe_get_meta('page-background.background-repeat', '' , $page_id);
		$background_attachment = luxe_get_meta('page-background.background-attachment', '' , $page_id);
		$background_position = luxe_get_meta('page-background.background-position', '' , $page_id);
		$background_shadow = luxe_get_meta('page-background.background-shadow', '' , $page_id);
		$padding_top = luxe_get_meta('page-layout.padding-top', '' , $page_id);
		$padding_bottom = luxe_get_meta('page-layout.padding-bottom', '' , $page_id);
	 	?>
	 	<style type="text/css" class="metabox-css">

		body { background-color: <?php echo $background_color; ?>; }
		body { background-image: url('<?php echo $background_image; ?>'); }
		<?php if($background_repeat == 'cover'): ?>
			body {   -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; }
		<?php else: ?>
			body { background-repeat: <?php echo $background_repeat; ?>; }
		<?php endif; ?>
		body { background-attachment: <?php echo $background_attachment; ?>; }
		body { background-position: <?php echo $background_position; ?>; }
		#content { padding-top: <?php echo $padding_top; ?>px; padding-bottom: <?php echo $padding_bottom; ?>px; }
		<?php if($background_shadow): ?>
			#content:before {
				display: block;
				position: absolute;
				content: "";
				width: 50%;
				height: 100%;
				right: 0;
				top: 0;
				background-color: rgba(0,0,0,0.02);
				z-index: 0;
			}
		<?php endif; ?>

		<?php 
		global $luxe_options;
		// portfolio single content
		if ( 'portfolio' == get_post_type() && $luxe_options['portfolio-page']) {

            $page_id = $luxe_options['portfolio-page'];

			// page background 
			$background_color = luxe_get_meta('page-background.background-color', '' , $page_id);
			$background_image = luxe_get_meta('page-background.background-image', '' , $page_id);
			$background_repeat = luxe_get_meta('page-background.background-repeat', '' , $page_id);
			$background_attachment = luxe_get_meta('page-background.background-attachment', '' , $page_id);
			$background_position = luxe_get_meta('page-background.background-position', '' , $page_id);
			$background_shadow = luxe_get_meta('page-background.background-shadow', '' , $page_id);
			$padding_top = luxe_get_meta('page-layout.padding-top', '' , $page_id);
			$padding_bottom = luxe_get_meta('page-layout.padding-bottom', '' , $page_id);
		 	?>

			.portfolio-single-content { background-color: <?php echo $background_color; ?>; }
			.portfolio-single-content { background-image: url('<?php echo $background_image; ?>'); }
			<?php if($background_repeat == 'cover'): ?>
				.portfolio-single-content {   -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; }
			<?php else: ?>
				.portfolio-single-content { background-repeat: <?php echo $background_repeat; ?>; }
			<?php endif; ?>
			.portfolio-single-content { background-attachment: <?php echo $background_attachment; ?>; }
			.portfolio-single-content { background-position: <?php echo $background_position; ?>; }
			.portfolio-single-content { padding-top: <?php echo $padding_top; ?>px; padding-bottom: <?php echo $padding_bottom; ?>px; }
			<?php if($background_shadow): ?>
				.portfolio-single-content:before {
					display: block;
					position: absolute;
					content: "";
					width: 50%;
					height: 100%;
					right: 0;
					top: 0;
					background-color: rgba(0,0,0,0.02);
					z-index: 0;
				}
			<?php endif; ?>
		<?php } ?>


		<?php
		// one page styles
		if (get_post_meta(get_the_ID(), '_wp_page_template', true) == 'page-onepage.php') {

			$parent_id = get_the_ID();
			$args = array(
				'child_of' => $parent_id,
				'post_type' => 'page',
				'post_status' => 'publish'
			);

			$pages = get_pages($args);

		    foreach($pages as $child) {
		    	$child_id = $child->ID;

		    	$child_background_color = luxe_get_meta('page-background.background-color', '', $child_id);
		    	$child_background_image = luxe_get_meta('page-background.background-image', '', $child_id);
		    	$child_background_repeat = luxe_get_meta('page-background.background-repeat', '', $child_id);
		    	$child_background_attachment = luxe_get_meta('page-background.background-attachment', '', $child_id);
		    	$child_background_position = luxe_get_meta('page-background.background-position', '', $child_id);
		    	$child_background_shadow = luxe_get_meta('page-background.background-shadow', '', $child_id);
				$child_padding_top = luxe_get_meta('page-layout.padding-top', '', $child_id);
				$child_padding_bottom = luxe_get_meta('page-layout.padding-bottom', '', $child_id);
				$child_arrow = luxe_get_meta('page-background.container-arrow', '', $child_id);
		    	?>

		    	#container-<?php echo $child_id; ?> { background-color: <?php echo $child_background_color; ?>; }
		    	#container-<?php echo $child_id; ?>:after { border-top-color: <?php echo $child_background_color; ?>; }
		    	#container-<?php echo $child_id; ?> { background-image: url('<?php echo $child_background_image; ?>'); }
				<?php if($child_background_repeat == 'cover'): ?>
				#container-<?php echo $child_id; ?> {   -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; }
				<?php else: ?>
				#container-<?php echo $child_id; ?> { background-repeat: <?php echo $child_background_repeat; ?>; }
				<?php endif; ?>
		    	#container-<?php echo $child_id; ?> { background-attachment: <?php echo $child_background_attachment; ?>; }
		    	#container-<?php echo $child_id; ?> { background-position: <?php echo $child_background_position; ?>; }
		    	#container-<?php echo $child_id; ?> { padding-top: <?php echo $child_padding_top; ?>px; padding-bottom: <?php echo $child_padding_bottom; ?>px; }
		    	<?php if (!$child_arrow): ?>
		    		#container-<?php echo $child_id; ?>:after { display: none; }
					#container-<?php echo $child_id; ?>-background:before { display: none; }
	    		<?php endif; ?>
		    	<?php if (!$child_background_shadow): ?>
					#container-<?php echo $child_id; ?>-background:before { display: none; }
	    		<?php endif; ?>
				<?php if($child_background_shadow): ?>
					#container-<?php echo $child_id; ?>:before {
						display: block;
						position: absolute;
						content: "";
						width: 50%;
						height: 100%;
						right: 0;
						top: 0;
						background-color: rgba(0,0,0,0.02);
						z-index: 0;
					}	
				<?php endif; ?>
	    		<?php 
			}
		} 
	}

	?>
	</style>

	<?php 

}

add_action( 'wp_head', 'luxe_metabox_css', 151);


?>