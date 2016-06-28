<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php global $luxe_image_size; ?>
<?php $images = luxe_get_meta('post.gallery-images', '' , get_the_ID()); ?>


<div id="post-carousel-<?php the_ID(); ?>" class="post-carousel flexslider  luxe-flexslider">
	<ul class="slides">
	<?php 
	if($images):
		foreach($images as $image):
			
			$image_id = luxe_get_attachment_id_from_src($image["gallery-image"]);
			echo '<li>';
			$image_src = wp_get_attachment_image_src($image_id, $luxe_image_size);
			echo '<div><img src="'.$image_src[0].'" ></div>';
			echo '</li>';
		endforeach;
	endif;
	?>
	</ul>
</div>
