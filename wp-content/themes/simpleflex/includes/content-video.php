<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php $video = luxe_get_meta('post.video', '' , get_the_ID()); ?>

<?php if(is_home()): ?>
	<div class="video-wrapper">
		<?php echo apply_filters('the_content', $video); ?>
	</div>
<?php else: ?>
	<?php global $luxe_image_size; ?>
	<?php the_post_thumbnail($luxe_image_size); ?>
	<a href="<?php echo $video; ?>" rel="prettyPhoto" class="video-button">
	</a>
<?php endif; ?>