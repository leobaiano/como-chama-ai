<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<div class="entry-content clearfix" itemprop="articleBody">
		<?php the_content(); ?>
	</div>

	<footer class="article-footer">
		<?php wp_link_pages(); ?>
		<?php the_tags( '<span class="tags">' . __( 'Tags:', 'luxe_framework' ) . '</span> ', ', ', '' ); ?>
	</footer>

</div>

<?php endwhile; else : ?>

		<article id="post-not-found" class="hentry clearfix">
			<header class="article-header">
				<h1><?php _e( 'Oops, Post Not Found!', 'luxe_framework' ); ?></h1>
			</header>
			<section class="entry-content">
				<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'luxe_framework' ); ?></p>
			</section>
		</article>

<?php endif; ?>

