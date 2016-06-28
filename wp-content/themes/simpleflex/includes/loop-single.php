<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

	<header class="article-header">

		<h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		<p class="entry-meta"><?php
			printf( __( 'By <span class="author">%3$s</span> In %4$s Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'luxe_framework' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), luxe_get_the_author_posts_link(), get_the_category_list(', '));?>
			<?php
            $write_comments = '';
			if ( comments_open() ) {
				ob_start();
				  comments_number( 'No Comments', '1 Comment', '% Comments' );
				$comments = ob_get_clean();  
				$write_comments .= '<a href="' . get_comments_link() .'">'. $comments.'</a>';
			}
			?>
			<span class="post-comments"><?php echo $write_comments; ?></span>
		</p>

	</header>

	<div class="article-featured">
		<?php global $luxe_image_size; ?>
		<?php $luxe_image_size = 'blog'; ?>
		<?php get_template_part( 'includes/content', get_post_format() ); ?>
	</div>

	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div>

	<footer class="article-footer" style="border-color:<?php echo luxe_get_meta( 'post.border-color', '', get_the_ID() ); ?>;">
		<?php wp_link_pages(); ?>
		<p class="tags"><?php the_tags(  '', ', ', '' ); ?></p>

		<div class="social-share">
			<span class='st_facebook_hcount' displayText='Facebook'></span>
			<span class='st_twitter_hcount' displayText='Tweet'></span>
			<span class='st_googleplus_hcount' displayText='Google +'></span>
		</div>
		<div class="related-posts">
			<h4><?php _e('Related Posts', 'luxe_framework'); ?></h4>
			<?php $content = '[blog limit="3" special="related" columns="3" image_size="post-thumbnail"]'; ?>
			<?php echo do_shortcode($content); ?>
		</div>
	</footer>

	<?php  comments_template(); ?>

</div>

<?php endwhile; ?>


<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>