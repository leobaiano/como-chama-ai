<?php 
global $luxe_options; 
$sidebar = luxe_get_meta('page-layout.sidebar-position'); 
$sidebar = ($sidebar == 'default' || $sidebar == '') ? $luxe_options['default-sidebar'] : $sidebar;

get_header(); 
?>

            <div id="content">

                <?php luxe_title(get_the_ID()); ?>  

                <div id="inner-content" class="wrap clearfix">

                    <div id="main" class="clearfix no-sidebar <?php //echo $sidebar; ?>" role="main">

                        <?php
                            get_template_part( 'includes/loop', 'single-portfolio' );
                        ?>

                    </div>


                    <?php //get_sidebar(); ?>

                </div>

            </div>

            <?php 
            if($luxe_options['portfolio-page']) {
                $page_id = $luxe_options['portfolio-page']; ?>

                <div class="portfolio-single-content">

                    <?php echo luxe_title($page_id); ?>

                    <div id="inner-content" class="wrap clearfix">

                    <?php 
                        $portfolio = get_post($page_id); 
                        echo apply_filters('the_content', $portfolio->post_content);
                    ?>

                </div>
                
            <?php } ?>

<?php get_footer(); ?>