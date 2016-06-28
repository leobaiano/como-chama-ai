<?php
/*
  Template Name: One Page Holder
 */
?>

<?php get_header(); ?>

    <div id="content">

        <?php
            get_template_part( 'includes/loop', 'onepage' );
        ?>

    </div> <!-- end #content -->

<?php get_footer(); ?>
