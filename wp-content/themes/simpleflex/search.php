<?php 
global $luxe_options; 
$sidebar = luxe_get_meta('page-layout.sidebar-position'); 
$sidebar = ($sidebar == 'default' || $sidebar == '') ? $luxe_options['default-sidebar'] : $sidebar;

get_header(); 
?>

			<div id="content">

				<?php luxe_title(get_the_ID()); ?>

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="clearfix <?php echo $sidebar; ?>" role="main">

						<?php
							get_template_part( 'includes/loop', 'search' );
						?>

						</div>

						<?php get_sidebar(); ?>

					</div>

			</div>

<?php get_footer(); ?>
