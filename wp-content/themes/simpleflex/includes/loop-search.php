<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

		<header class="article-header">

			<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
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

		<section class="entry-content">
				<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'luxe_framework' ) . '</span>' ); ?>

		</section>

		<footer class="article-footer">

		</footer>

	</article>

<?php endwhile; ?>

		<?php if (function_exists('luxe_page_navi')) { ?>
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

			<article id="post-not-found" class="hentry clearfix">
				<header class="article-header">
					<h1><?php _e( 'Sorry, No Results.', 'luxe_framework' ); ?></h1>
				</header>
				<section class="entry-content">
					<p><?php _e( 'Try your search again.', 'luxe_framework' ); ?></p>
				</section>
			</article>

	<?php endif; ?>