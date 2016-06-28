<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

    <section class="featured-content eightcol first" itemprop="articleBody">

        <?php if ( luxe_get_meta( 'post.custom-code', '', get_the_ID() ) ): ?>
            <?php echo apply_filters( 'the_content', do_shortcode( luxe_get_meta( 'post.custom-code',  '', get_the_ID() ) ) ); ?>
        <?php elseif ( has_post_thumbnail( get_the_ID() ) ): ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'portfolio-single' ); ?>
            <img class="featured-image" src="<?php echo $image[0]; ?>" />
        <?php endif; ?>

    </section> <!-- end article section -->

    <section class="entry-content project-content fourcol">
        <span class="project-details"><?php _e('Project Details', 'luxe_framework'); ?></span>
        <?php the_content(); ?>
        <div class="project-meta">
        <?php if ( luxe_get_meta( 'portfolio.skills', '', get_the_ID() ) ): ?>
            <span class="project-meta-skills">
                <span class="project-meta-label"><?php _e('Skills:', 'luxe_framework'); ?></span>
                <?php echo luxe_get_meta( 'portfolio.skills', '', get_the_ID() ); ?>
            </span>
        <?php endif; ?>
        <?php if ( luxe_get_meta( 'portfolio.client', '', get_the_ID() ) ): ?>
            <span class="project-meta-client">
                <span class="project-meta-label"><?php _e('Client:', 'luxe_framework'); ?></span>
                <?php echo luxe_get_meta( 'portfolio.client', '', get_the_ID() ); ?>
            </span>
        <?php endif; ?>
        <?php if ( luxe_get_meta( 'portfolio.location', '', get_the_ID() ) ): ?>
            <span class="project-meta-location">
                <span class="project-meta-label"><?php _e('Location:', 'luxe_framework'); ?></span>
                <?php echo luxe_get_meta( 'portfolio.location', '', get_the_ID() ); ?>
            </span>
        <?php endif; ?>
        <?php if ( luxe_get_meta( 'portfolio.project-link', '', get_the_ID() ) ): ?>
            <a class="button project-button" href="<?php echo luxe_get_meta( 'portfolio.project-link', '', get_the_ID() ); ?>">
                <?php _e('View Project', 'luxe_framework'); ?>
            </a>
        <?php endif; ?>
        </div>
    </section>


    <footer class="article-footer">

    </footer> <!-- end article footer -->

    <?php comments_template(); ?>

    </article> <!-- end article -->


<?php endwhile; ?>

<?php else : ?>

    <article id="post-not-found" class="hentry clearfix">
        <header class="article-header">
            <h1><?php _e( "Oops, Post Not Found!", "themeluxe" ); ?></h1>
        </header>
        <section class="entry-content">
            <p><?php _e( "Uh Oh. Something is missing. Try double checking things.", "themeluxe" ); ?></p>
        </section>
        <footer class="article-footer">
            <p><?php _e( "This is the error message in the single.php template.", "themeluxe" ); ?></p>
        </footer>
    </article>

<?php endif; ?>
