<?php 
global $luxe_options; 
$sidebar = luxe_get_meta('page-layout.sidebar-position'); 
$sidebar = ($sidebar == 'default' || $sidebar == '') ? $luxe_options['default-sidebar'] : $sidebar;

if($sidebar == 'no-sidebar')
	return;
?>
<div id="sidebar" class="sidebar fourcol clearfix <?php echo $sidebar; ?>" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar1' ); ?>

	<?php else : ?>

		<div class="alert alert-help">
			<p><?php _e( 'Please activate some Widgets.', 'luxe_framework' );  ?></p>
		</div>

	<?php endif; ?>

</div>