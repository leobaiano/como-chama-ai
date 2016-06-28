<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

	<div class="article-featured">
		<?php global $luxe_image_size; ?>
		<?php $luxe_image_size = 'blog-full'; ?>
		<?php get_template_part( 'includes/content', get_post_format() ); ?>
	</div>

	<header class="article-header">

		<h2 class="h4 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
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

	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div>

	<footer class="article-footer" style="border-color:<?php echo luxe_get_meta( 'post.border-color', '', get_the_ID() ); ?>;">
		<p class="tags"><?php the_tags(  '', ', ', '' ); ?></p>

	</footer>

	<?php // comments_template(); // uncomment if you want to use them ?>

</div>

<?php endwhile; ?>

		<?php if ( function_exists( 'luxe_page_navi' ) ) { ?>
				<?php luxe_page_navi(); ?>
		<?php } else { ?>
				<nav class="wp-prev-next">
						<ul class="clearfix">
							<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'luxe_framework' )) ?></li>
							<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'luxe_framework' )) ?></li>
						</ul>
				</nav>
		<?php } ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>