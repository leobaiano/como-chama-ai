<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<?php global $luxe_options; ?>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>
		<?php
        /*
         * Print the <title> tag based on what is being viewed.
         */
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : false;
        wp_title( '-', true, 'right' );
        // Add the blog name.
        bloginfo( 'name' );
        // Add a page number if necessary:
        if ( $paged >= 2 )
            echo ' - ' . sprintf( __( 'Page %s', 'qs_framework' ), $paged  );
        ?>
		</title>

		<?php // mobile meta  ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons  ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-touch.png">
        <?php if ( isset($luxe_options['favicon']['url'] )): ?>
            <link rel="icon" type="image/png" href="<?php echo $luxe_options['favicon']['url']; ?>">
        <?php else: ?>
            <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
        <?php endif; ?>
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>


	</head>

	<body <?php body_class(); ?>>

		<?php if($luxe_options['preloader'] == 1) : ?>
		<!-- Preloader -->
		<div id="preloader">
			<div id="status">
			</div>
		</div>
		<?php endif; ?>

		<div id="container">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<div id="logo" class="h1">
						<a href="<?php echo home_url(); ?>" rel="nofollow">
							<?php 	
							if(isset($luxe_options['logo']['url'])) :
								echo "<img src='".$luxe_options['logo']['url']."'' >";
							else: 
								bloginfo('name');
							endif;
							?>
						</a>
					</div>

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>


					<nav role="navigation">
						<div id="mobile-nav-button"><span></span><span></span><span></span></div>
						<div id="main-nav-wrapper">
							<?php luxe_main_nav(); ?>
						</div>
					</nav>

				</div>

			</header>
