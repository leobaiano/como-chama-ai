<?php
/*
Welcome to the Theme Luxe framework.
If you are not a developer, please
don't edit any of the functions in this
file or your site my explode.  For reals.

Author: ThemeLuxe
Author URI: http://themeluxe.com

*/

/* ---------------------------------------------------------------------- */
/*	OPTIONS FRAMEWORK
/* ---------------------------------------------------------------------- */

if ( !class_exists( 'ReduxFramework' ) && file_exists( LUXE_FRAMEWORK_DIR . '/options/ReduxCore/framework.php' ) ) {
	require_once( LUXE_FRAMEWORK_DIR . '/options/ReduxCore/framework.php' );
}

/* ---------------------------------------------------------------------- */
/*	OPTIONS
/* ---------------------------------------------------------------------- */

if ( !isset( $luxe_options ) && file_exists( LUXE_INC_DIR . '/admin/luxe-options.php' ) ) {
	require_once( LUXE_INC_DIR . '/admin/luxe-options.php' );
}

/* ---------------------------------------------------------------------- */
/*	SHORTCODES AND METABOXES FRAMEWORK
/* ---------------------------------------------------------------------- */

require_once(LUXE_FRAMEWORK_DIR . 'metabox/bootstrap.php');


/* ---------------------------------------------------------------------- */
/*	TRANSLATION
/* ---------------------------------------------------------------------- */

require_once(LUXE_FRAMEWORK_DIR. 'translation/translation.php');

/* ---------------------------------------------------------------------- */
/*	PLUGIN ACTIVATION
/* ---------------------------------------------------------------------- */

require_once LUXE_FRAMEWORK_DIR . 'plugin-activation/class-tgm-plugin-activation.php';

/* ---------------------------------------------------------------------- */
/*	UPDATE NOTIFIER
/* ---------------------------------------------------------------------- */

global $luxe_options;
$username = (isset($luxe_options['envato-username']) ? $luxe_options['envato-username'] : '');
$apikey = (isset($luxe_options['envato-apikey']) ? $luxe_options['envato-apikey'] : '');

load_template( trailingslashit( LUXE_FRAMEWORK_DIR ) . 'theme-updater/envato-wp-theme-updater.php' );
Envato_WP_Theme_Updater::init( $username, $apikey, 'ThemeLuxe' );

/* ---------------------------------------------------------------------- */
/*	FRAMEWORK FUNCTIONS
/* ---------------------------------------------------------------------- */

include_once(LUXE_FRAMEWORK_DIR . '/luxe-functions.php');




?>
